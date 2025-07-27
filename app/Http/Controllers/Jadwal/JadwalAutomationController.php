<?php

namespace App\Http\Controllers\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Jadwal_H;
use App\Models\Jadwal_D;
use App\Models\TimPelayanan_H;
use App\Models\Bagian;
use App\Models\User;

class JadwalAutomationController extends Controller
{
    // FOR DEBUGGING PURPOSE, TURN TRUE
    private $VERBOSE = false;
    private $ROLE_REQUIREMENTS_BY_DAY = [
        'saturday' => [
            'F.O.H' => ['slots' => 1, 'minGrade' => 10],
            'Monitor' => ['slots' => 2, 'minGrade' => 6, 'maxGrade' => 9],
            'Stage' => ['slots' => 2, 'minGrade' => 3, 'maxGrade' => 5],
        ],
        'sunday' => [
            'F.O.H' => ['slots' => 1, 'minGrade' => 10],
            'B.C' => ['slots' => 1, 'minGrade' => 6, 'maxGrade' => 9],
            'Monitor' => ['slots' => 1, 'minGrade' => 6, 'maxGrade' => 9],
            'Stage' => ['slots' => 2, 'minGrade' => 3, 'maxGrade' => 5],
            'Super Trooper' => ['slots' => 1, 'minGrade' => 1, 'maxGrade' => 5],
            'All star dan Little Eagle' => ['slots' => 1, 'minGrade' => 1, 'maxGrade' => 5],
        ]
    ];

    // =======================
    // Jadwal Automation Notes
    // =======================
    // - Sebuah jadwal akan di-assign volunteers di 1 cabang jadwal itu (e.g. Voltage Timur berarti hanya cabang PCM Timur)
    // 
    // - Seorang Volunteer hanya akan di-assign di 1 cabang Tim Pelayanan nya saja
    // - Seorang Volunteer hanya bisa ditugaskan 1x dalam 1 minggu (kecuali Full Timer)
    // - Seorang Volunteer akan di-assign maksimal 4x pelayanan dalam 1 bulan
    // - Seorang Volunteer akan di-assign di Bagian/Role sesuai dengan Gradingnya
    // - Seorang Volunteer dengan jumlah pelayanan paling sedikit akan didahulukan di sesama role yang sama
    // 
    // - Value-value ROLE_REQUIREMENTS_BY_DAY bisa diubah sesuai kebutuhan
    // - EK AS dan EK LE tidak ada jadwalnya saat Ibadah Umum 1
    // 

    public function automation(Request $request)
    {
        $jadwalHeader = Jadwal_H::findOrFail($request->jadwal);
        $date = Carbon::parse($jadwalHeader->tanggal_jadwal);
        
        try {
            // Get Role Requirements based on day
            $roleRequirements = $this->getRoleRequirements($date);
            if (empty($roleRequirements)) {
                return $this->redirectWithError($jadwalHeader->id_jadwal_h, 'Tidak ada jadwal yang ditentukan untuk hari tersebut');
            }

            // Update requirement based on existing assignments
            $roleRequirements = $this->updateRequirementsFromExistingJadwal($roleRequirements, $request->jadwal);
            if (empty($roleRequirements)) {
                return $this->redirectWithError($jadwalHeader->id_jadwal_h, 'Semua bagian jadwal sudah penuh');
            }

            // Remove EK slots for Ibadah Umum 1
            if (str_contains(strtolower($jadwalHeader->jadwalIbadah->nama_ibadah), 'umum 1')) {
                $roleRequirements = array_filter($roleRequirements, fn($bagianName) => 
                    !in_array($bagianName, ['Super Trooper', 'All star dan Little Eagle']), 
                    ARRAY_FILTER_USE_KEY
                );
            }

            // Get available team members and assigned users
            $teamMembersId = $this->getTeamMembersFromCabang($jadwalHeader->id_cabang);
            $assignedUsers = $this->getAssignedUsersInThisWeek($jadwalHeader, $date);
            $bagianIds = Bagian::where('status_bagian', 1)->pluck('id_bagian', 'nama_bagian');

            // Process assignments
            return $this->processAssignments($roleRequirements, $jadwalHeader, $teamMembersId, $assignedUsers, $bagianIds);

        } catch (\Exception $e) {
            DB::rollBack();
            if ($this->VERBOSE) dd("Error: " . $e->getMessage());
            return $this->redirectWithError($jadwalHeader->id_jadwal_h, 'Penugasan volunteer secara otomatis gagal.');
        }
    }

    private function getRoleRequirements(Carbon $date): array
    {
        return $date->isSaturday() ? $this->ROLE_REQUIREMENTS_BY_DAY['saturday'] : 
               ($date->isSunday() ? $this->ROLE_REQUIREMENTS_BY_DAY['sunday'] : []);
    }

    private function updateRequirementsFromExistingJadwal(array $roleRequirements, $jadwalId): array
    {
        $filledRoles = Jadwal_D::where('id_jadwal_h', $jadwalId)
            ->where('status_jadwal_d', 1)
            ->get()
            ->groupBy('id_bagian')
            ->map->count();

        foreach ($roleRequirements as $bagianName => $requirements) {
            $roleId = Bagian::where('nama_bagian', $bagianName)->value('id_bagian');
            $filledRoleCount = $filledRoles[$roleId] ?? 0;

            if ($roleId) {
                if ($filledRoleCount >= $requirements['slots']) {
                    unset($roleRequirements[$bagianName]);
                } else {
                    $roleRequirements[$bagianName]['slots'] -= $filledRoleCount;
                }
            }
        }

        return $roleRequirements;
    }

    private function getTeamMembersFromCabang($cabangId): \Illuminate\Support\Collection
    {
        return TimPelayanan_H::where('id_cabang', $cabangId)
            ->get()
            ->flatMap(fn($team) => $team->tim_pelayanan_d->pluck('id_user')->push($team->id_user))
            ->unique();
    }

    private function getAssignedUsersInThisWeek(Jadwal_H $jadwalHeader, Carbon $date): \Illuminate\Support\Collection
    {
        $assignedUsers = Jadwal_D::whereHas('detail', function ($query) use ($jadwalHeader) {
                $query->whereDate('tanggal_jadwal', $jadwalHeader->tanggal_jadwal);
            })
            // Filter out users with grade >= 10
            ->whereHas('user', function($query) {
                $query->where('grade', '<', 10);
            })
            ->pluck('id_user')
            ->unique();

        // Get users from other weekend day
        $otherWeekendDate = $this->getOtherWeekendDate($date);
        if ($otherWeekendDate) {
            $otherWeekendUsers = Jadwal_D::whereHas('detail', function ($query) use ($otherWeekendDate) {
                    $query->whereDate('tanggal_jadwal', $otherWeekendDate);
                })
                // Filter out users with grade >= 10
                ->whereHas('user', function($query) {
                    $query->where('grade', '<', 10);
                })
                ->pluck('id_user');
            
            $assignedUsers = $assignedUsers->concat($otherWeekendUsers)->unique();
        }

        return $assignedUsers;
    }

    private function getOtherWeekendDate(Carbon $date): ?Carbon
    {
        if ($date->isSunday()) {
            return $date->copy()->subDay(); // Saturday
        } else if ($date->isSaturday()) {
            return $date->copy()->addDay(); // Sunday
        }
        return null;
    }

    private function processAssignments(array $slots, Jadwal_H $jadwalHeader, $teamMembersId, $assignedUsers, $bagianIds)
    {
        DB::beginTransaction();
        $warningMessages = [];

        // Foreach bagian/role, search for available volunteers in that week
        foreach ($slots as $bagianName => $requirements) {
            if ($this->VERBOSE) dump("=== {$bagianName} ===");
            $availableVolunteers = $this->getAvailableVolunteers($teamMembersId, $requirements, $assignedUsers, $jadwalHeader);
            
            if ($availableVolunteers->isEmpty()) {
                return $this->redirectWithError(
                    $jadwalHeader->id_jadwal_h, 
                    "Tidak ada volunteer {$bagianName} tersedia minggu ini."
                );
            }
            if ($this->VERBOSE) {
                dump("== Available Volunteers ==");
                $this->printVolunteerData($availableVolunteers);
            }

            // Shuffle available volunteers
            $availableVolunteers = $this->shuffleAvailableVolunteers($availableVolunteers);
            if ($this->VERBOSE) {
                dump("== Shuffled Volunteers ==");
                $this->printVolunteerData($availableVolunteers);
            }

            // Foreach needed slot, assign volunteers
            for ($i = 0; $i < $requirements['slots']; $i++) {
                $volunteer = $availableVolunteers->shift();
                if (!$volunteer) {
                    $warningMessage = "Ada volunteer yang tidak tersedia untuk bagian {$bagianName}.";
                    if (!in_array($warningMessage, $warningMessages)) {
                        $warningMessages[] = $warningMessage;
                    }
                    continue;
                }
                if ($this->VERBOSE) dump("Selected {$bagianName} Volunteer: ".$volunteer->nama_lengkap);

                Jadwal_D::create([
                    'id_jadwal_h' => $jadwalHeader->id_jadwal_h,
                    'id_bagian' => $bagianIds[$bagianName],
                    'id_user' => $volunteer->id,
                    'status_jadwal_d' => 1,
                ]);

                $assignedUsers->push($volunteer->id);
            }
        }
        if ($this->VERBOSE) dd("ASSIGNED VOLUNTEERS");

        DB::commit();
        return redirect()
            ->route('jadwal_detail.index', $jadwalHeader->id_jadwal_h)
            ->with('success', 'Penugasan volunteer berhasil secara otomatis berhasil.')
            ->with('warning', $warningMessages);
    }

    // Get available volunteers based on requirements (Grade, Total Monthly Assignments)
    private function getAvailableVolunteers($teamMembersId, $requirement, $assignedUsers, $jadwalHeader)
    {
        return User::whereIn('id', $teamMembersId)
            ->when(isset($requirement['maxGrade']), 
                fn($query) => $query->whereBetween('grade', [$requirement['minGrade'], $requirement['maxGrade']]),
                fn($query) => $query->where('grade', '>=', $requirement['minGrade'])
            )
            ->whereNotIn('id', $assignedUsers)
            ->get()
            // Get total monthly assignments per user
            ->map(function ($user) use ($jadwalHeader) {
                $startOfMonth = Carbon::parse($jadwalHeader->tanggal_jadwal)->startOfMonth();
                $endOfMonth = Carbon::parse($jadwalHeader->tanggal_jadwal)->endOfMonth();
                
                $user->total_monthly_assignments = Jadwal_D::whereHas('detail', function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('tanggal_jadwal', [$startOfMonth, $endOfMonth]);
                })
                ->where('id_user', $user->id)
                ->count();
                
                return $user;
            })
            ->filter(fn($user) => $user->total_monthly_assignments < 4)
            ->values();
    }

    private function shuffleAvailableVolunteers($availableVolunteers) {
        $shuffledVolunteers = collect();
        
        // Group by total monthly assignments and sort by key
        $groupedVolunteers = $availableVolunteers->groupBy('total_monthly_assignments')->sortKeys();
        foreach ($groupedVolunteers as $assignmentCount => $volunteers) {
            $shuffledVolunteers = $shuffledVolunteers->concat($volunteers->shuffle());
        }

        return $shuffledVolunteers;
    }

    private function redirectWithError($jadwalId, $message)
    {
        return redirect()
            ->route('jadwal_detail.index', $jadwalId)
            ->with('error', $message);
    }

    private function printVolunteerData($volunteers) {
        foreach($volunteers as $volunteer) {
            dump("{$volunteer->nama_lengkap} (Grade: {$volunteer->grade}): {$volunteer->total_monthly_assignments}x pelayanan");
        }
    }
}
