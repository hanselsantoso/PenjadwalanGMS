<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add this import
use Illuminate\Support\Facades\Log; // Add this import
use Carbon\Carbon;
use App\Models\Jadwal_H;
use App\Models\Jadwal_D;
use App\Models\TimPelayanan_H;
use App\Models\Bagian;
use App\Models\User;

class JadwalDetailController extends Controller
{
    public function jadwal_detail($id)
    {
        // Order By Bagian ID
        $detail = Jadwal_H::with(['detail' => function($query) {
            $query->join('bagian', 'jadwal_d.id_bagian', '=', 'bagian.id_bagian')
                ->orderBy('bagian.id_bagian');
        }])->find($id);

        $bagian = Bagian::where('status_bagian', 1)->get();
        $user = User::where('status_user', 1)->where('role', '!=', 0)->get();
        $id_H = $id;

        return view ('jadwal_detail', compact('detail', 'bagian', 'user', 'id_H'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bagian' => 'required|integer',
            'user' => 'required|integer',
            'jadwal' => 'required|integer',
        ]);

        // Check for existing schedule with same jadwal_h and user
        $existingJadwal = Jadwal_D::where('id_jadwal_h', $request->jadwal)
            ->where('id_user', $request->user)
            ->first();

        if ($existingJadwal) {
            return redirect()->route('jadwal_detail_index', $request->jadwal)->with('error', 'User sudah ada di jadwal.');
        }

        $jadwal = new Jadwal_D();
        $jadwal->id_jadwal_h = $request->jadwal;
        $jadwal->id_bagian = $request->bagian;
        $jadwal->id_user = $request->user;
        $jadwal->status_jadwal_d = 1;
        $jadwal->save();
        return redirect()->route('jadwal_detail_index', $request->jadwal)->with('success', 'Jadwal berhasil dibuat.');
    }

    public function update(Request $request)
    {
        // TODO: PENGECEKAN NULLABLE
        $request->validate([
            'bagian' => 'required|integer',
            'user' => 'required|integer',
            'jadwal' => 'required|integer',
        ]);

        $jadwal = Jadwal_D::find($request->jadwal);
        $jadwal->id_jadwal_h = $request->id_jadwal_h;
        $jadwal->id_bagian = $request->bagian;
        $jadwal->id_user = $request->user;
        $jadwal->save();

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function activate($id)
    {
        $jadwal = Jadwal_D::find($id);
        $jadwal->status_jadwal_d = 1;
        $jadwal->save();

        return redirect()->route('jadwal_detail_index', $jadwal->id_jadwal_h)->with('success', 'Jadwal berhasil diaktifkan.');
    }

    public function deactivate($id)
    {
        $jadwal = Jadwal_D::find($id);
        $jadwal->status_jadwal_d = 0;
        $jadwal->save();

        return redirect()->route('jadwal_detail_index', $jadwal->id_jadwal_h)->with('success', 'Jadwal berhasil dinonaktifkan.');
    }

    public function delete($id)
    {
        $jadwal = Jadwal_D::find($id);
        $jadwalId = $jadwal->id_jadwal_h;
        $jadwal->delete();

        return redirect()->route('jadwal_detail_index', $jadwalId)->with('success', 'Jadwal berhasil dihapus.');
    }

    private function printVolunteer($volunteers) {
        foreach($volunteers as $volunteer) {
            dump($volunteer->nama_lengkap." - ".$volunteer->total_monthly_assignments);
        }
    }

    public function automation(Request $request)
    {
        // Constants for slot requirements
        $slotRequirements = [
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

        // Get schedule and determine day type
        $jadwalHeader = Jadwal_H::findOrFail($request->jadwal);
        $date = Carbon::parse($jadwalHeader->tanggal_jadwal);
        $slots = $date->isSaturday() ? $slotRequirements['saturday'] : 
            ($date->isSunday() ? $slotRequirements['sunday'] : []);
        
        if (empty($slots)) {
            return redirect()->route('jadwal_detail_index', $jadwalHeader->id_jadwal_h)->with('error', 'Tidak ada slot yang ditentukan untuk hari ini');
        } else {
            // Check if a bagian are already filled and remove filled slots from requirements
            $existingAssignments = Jadwal_D::where('id_jadwal_h', $request->jadwal)
                ->where('status_jadwal_d', 1)
                ->get()
                ->groupBy('id_bagian')
                ->map->count();

            $slotsToRemove = [];
            foreach ($slots as $bagianName => $requirements) {
                $bagianId = Bagian::where('nama_bagian', $bagianName)->value('id_bagian');
                $existingAssignmentsCount = $existingAssignments[$bagianId] ?? 0;

                if ($bagianId && isset($existingAssignmentsCount)) {
                    if ($existingAssignmentsCount >= $requirements['slots']) {
                        // Remove filled bagian from requirements
                        unset($slots[$bagianName]);
                    } else {
                        // Update bagian slots remaining
                        $slots[$bagianName]['slots'] = $requirements['slots'] - $existingAssignmentsCount;
                    }
                }
            }
            
            if (empty($slots)) {
                return redirect()->route('jadwal_detail_index', $jadwalHeader->id_jadwal_h)->with('error', 'Semua slot sudah penuh');
            }
        }

        // Remove AS & ST if it's Ibadah Umum 1
        if (str_contains(strtolower($jadwalHeader->jadwalIbadah->nama_ibadah), 'umum 1')) {
            $slots = array_filter($slots, function($bagianName) {
                return !in_array($bagianName, ['Super Trooper', 'All star dan Little Eagle']);
            }, ARRAY_FILTER_USE_KEY);
        }

        // Get all team members from the same branch
        $teamMembers = TimPelayanan_H::where('id_cabang', $jadwalHeader->id_cabang)
            ->get()
            ->flatMap(function ($team) {
                return $team->tim_pelayanan_d->pluck('id_user')->push($team->id_user);
            })
            ->unique();
        dump("ALL TEAM MEMBERS ON CABANG: ".$teamMembers);

        // Get all users already assigned on the same day except F.O.H Users
        $assignedUsers = Jadwal_D::whereHas('detail', function ($query) use ($jadwalHeader) {
                $query->whereDate('tanggal_jadwal', $jadwalHeader->tanggal_jadwal);
            })
            ->whereHas('user', function($query) {
                $query->where('grade', '<', 10);
            })
            ->pluck('id_user')
            ->unique();

        // Get users assigned on the other weekend day if applicable except F.O.H Users
        $otherWeekendDayDate = $date->copy();
        if ($date->isSunday()) {
            $otherWeekendDayDate->subDay(); 
        } else if ($date->isSaturday()) {
            $otherWeekendDayDate->addDay();
        } else {
            $otherWeekendDayDate = null;
        }

        $otherWeekendDayAssignedUsers = Jadwal_D::whereHas('detail', function ($query) use ($otherWeekendDayDate) {
                $query->whereDate('tanggal_jadwal', $otherWeekendDayDate);
            })
            ->whereHas('user', function($query) {
                $query->where('grade', '<', 10);
            })
            ->pluck('id_user')
            ->unique();
        
        dump("ASSIGNED USERS: ".$assignedUsers);
        dump("OTHER WEEKEND DAY ASSIGNED USERS: ".$otherWeekendDayAssignedUsers);

        // Get active sections
        $bagianIds = Bagian::where('status_bagian', 1)->pluck('id_bagian', 'nama_bagian');

        // Start transaction
        DB::beginTransaction();
        try {
            foreach ($slots as $bagianName => $requirements) {
                dump("Bagian Name: ".$bagianName);
                dump($requirements);
                // Get available volunteers for this section based on grade requirements
                $availableVolunteers = User::whereIn('id', $teamMembers)
                    ->when(isset($requirements['maxGrade']), function ($query) use ($requirements) {
                        return $query->whereBetween('grade', [$requirements['minGrade'], $requirements['maxGrade']]);
                    })
                    ->when(!isset($requirements['maxGrade']), function ($query) use ($requirements) {
                        return $query->where('grade', '>=', $requirements['minGrade']);
                    })
                    ->whereNotIn('id', $assignedUsers)
                    ->whereNotIn('id', $otherWeekendDayAssignedUsers)
                    ->get()
                    ->map(function ($user) use ($jadwalHeader) {
                        // Get start and end of month for the jadwal date
                        $startOfMonth = Carbon::parse($jadwalHeader->tanggal_jadwal)->startOfMonth();
                        $endOfMonth = Carbon::parse($jadwalHeader->tanggal_jadwal)->endOfMonth();
                        
                        // Count assignments for this user in the same month
                        $totalMonthlyAssignments = Jadwal_D::whereHas('detail', function ($query) use ($startOfMonth, $endOfMonth) {
                            $query->whereBetween('tanggal_jadwal', [$startOfMonth, $endOfMonth]);
                        })
                        ->where('id_user', $user->id)
                        ->count();

                        $user->total_monthly_assignments = $totalMonthlyAssignments;
                        return $user;
                    })
                    ->filter(function($user) {
                        return $user->total_monthly_assignments < 4;
                    })
                    ->values();
                dump("AVAILABLE VOLUNTEERS");
                $this->printVolunteer($availableVolunteers);
            
                if (empty($availableVolunteers)) {
                    return redirect()
                        ->route('jadwal_detail_index', $jadwalHeader->id_jadwal_h)
                        ->with('error', "Tidak ada volunteer {$bagianName} tersedia minggu ini.");
                }

                
                // Group volunteers by total monthly assignments
                $shuffledVolunteers = collect();
                foreach (
                    $availableVolunteers->groupBy('total_monthly_assignments')->sortKeys() as 
                    $assignmentCount => $volunteers
                ) {
                    $shuffledVolunteers = $shuffledVolunteers->concat($volunteers->shuffle());
                }
                $availableVolunteers = $shuffledVolunteers;
                dump("AFTER VOLUNTEERS");
                $this->printVolunteer($availableVolunteers);

                // Assign volunteers to slots
                $warningMessages = [];
                for ($i = 0; $i < $requirements['slots']; $i++) {
                    $volunteer = $availableVolunteers->shift();
                    if (!$volunteer) {
                        $warningMessage = "Ada volunteer yang tidak tersedia untuk bagian {$bagianName}.";
                        if (!in_array($warningMessage, $warningMessages)) {
                            $warningMessages[] = $warningMessage;
                        }
                        continue;
                    }
                    dump("Selected: ".$volunteer->nama_lengkap);
                    
                    Jadwal_D::create([
                        'id_jadwal_h' => $jadwalHeader->id_jadwal_h,
                        'id_bagian' => $bagianIds[$bagianName],
                        'id_user' => $volunteer->id,
                        'status_jadwal_d' => 1,
                    ]);

                    $assignedUsers->push($volunteer->id);
                }
            }
            dd("    ");

            DB::commit();
            return redirect()->route('jadwal_detail_index', $jadwalHeader->id_jadwal_h)
                ->with('success', 'Penugasan volunteer berhasil secara otomatis berhasil.')
                ->with('warning', isset($warningMessages) ? $warningMessages : []);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error penugasan volunteer: ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->route('jadwal_detail_index', $jadwalHeader->id_jadwal_h)->with('error', 'Penugasan volunteer secara otomatis gagal.');
        }
    }
}
