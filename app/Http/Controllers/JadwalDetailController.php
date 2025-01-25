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
        $detail = Jadwal_H::find($id);
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

    public function automation(Request $request)
    {
        // Constants for slot requirements
        $slotRequirements = [
            'saturday' => [
                'F.O.H' => ['slots' => 1, 'minGrade' => 10],
                'Monitor' => ['slots' => 2, 'minGrade' => 5, 'maxGrade' => 7],
                'Stage' => ['slots' => 2, 'minGrade' => 1, 'maxGrade' => 4],
            ],
            'sunday' => [
                'F.O.H' => ['slots' => 2, 'minGrade' => 10],
                'B.C' => ['slots' => 2, 'minGrade' => 5, 'maxGrade' => 7],
                'Monitor' => ['slots' => 2, 'minGrade' => 5, 'maxGrade' => 7],
                'Stage' => ['slots' => 2, 'minGrade' => 1, 'maxGrade' => 4],
                'Super Trooper' => ['slots' => 2, 'minGrade' => 1, 'maxGrade' => 4],
                'All star dan Little Eagle' => ['slots' => 1, 'minGrade' => 1, 'maxGrade' => 4],
            ]
        ];

        // TODO: ADD CHECK IF THIS JADWAL_H IS FULL OR NOT FROM THE SLOT REQUIREMENT

        // Get schedule and determine day type
        $jadwalHeader = Jadwal_H::findOrFail($request->jadwal);
        $date = Carbon::parse($jadwalHeader->tanggal_jadwal);
        $slots = $date->isSaturday() ? $slotRequirements['saturday'] : 
            ($date->isSunday() ? $slotRequirements['sunday'] : []);

        if (empty($slots)) {
            return redirect()->route('jadwal_detail_index', $jadwalHeader->id_jadwal_h)->with('error', 'Tidak ada slot yang ditentukan untuk hari ini');
        }

        // Get all team members from the same branch
        $teamMembers = TimPelayanan_H::where('id_cabang', $jadwalHeader->id_cabang)
            ->get()
            ->flatMap(function ($team) {
                return $team->tim_pelayanan_d->pluck('id_user')->push($team->id_user);
            })
            ->unique();
        // dump("ALL TEAM MEMBERS ON CABANG: ".$teamMembers);

        // Get all users already assigned on the same day
        $assignedUsers = Jadwal_D::whereHas('detail', function ($query) use ($jadwalHeader) {
                $query->whereDate('tanggal_jadwal', $jadwalHeader->tanggal_jadwal);
            })
            ->pluck('id_user')
            ->unique();
        // dump("ASSIGNED USERS: ".$assignedUsers);

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
                    ->inRandomOrder()
                    ->get();

                // dump("AVAILABLE VOLUNTEERS");
                // foreach($availableVolunteers as $volunteer) {
                //     dump($volunteer->nama_lengkap);
                // }

                // Assign volunteers to slots
                for ($i = 0; $i < $requirements['slots']; $i++) {
                    $volunteer = $availableVolunteers->shift();
                    // dump("Selected: ".$volunteer->nama_lengkap);
                    
                    if (!$volunteer) {
                        Log::warning("Tidak ada volunteer yang tersedia untuk bagian {$bagianName} slot ke-" . ($i + 1));
                        continue;
                    }

                    Jadwal_D::create([
                        'id_jadwal_h' => $jadwalHeader->id_jadwal_h,
                        'id_bagian' => $bagianIds[$bagianName],
                        'id_user' => $volunteer->id,
                        'status_jadwal_d' => 1,
                    ]);

                    $assignedUsers->push($volunteer->id);
                }
            }

            DB::commit();
            return redirect()->route('jadwal_detail_index', $jadwalHeader->id_jadwal_h)->with('success', 'Penugasan volunteer berhasil secara otomatis berhasil.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error penugasan volunteer: ' . $e->getMessage());
            return redirect()->route('jadwal_detail_index', $jadwalHeader->id_jadwal_h)->with('error', 'Penugasan volunteer secara otomatis gagal.');
        }
    }

    // public function automation(Request $request)
    // {
    //     // Retrieve necessary data from the request
    //     $jadwalId = $request->jadwal;
    //     $jadwalHeader = Jadwal_H::findOrFail($jadwalId);

    //     // Define the slots needed for each day
    //     $slots = [];
    //     if (Carbon::parse($jadwalHeader->tanggal_jadwal)->isSaturday()) {
    //         // Saturday schedule
    //         $slots = [
    //             'F.O.H' => 1,
    //             'Monitor' => 2,
    //             'Stage' => 2,
    //         ];
    //     } elseif (Carbon::parse($jadwalHeader->tanggal_jadwal)->isSunday()) {
    //         // Sunday schedule
    //         $slots = [
    //             'F.O.H' => 2,
    //             'B.C' => 2,
    //             'Monitor' => 2,
    //             'Stage' => 2,
    //             'Super Trooper' => 2,
    //             'All star dan Little Eagle' => 1,
    //         ];
    //     }

    //     // Get volunteers on the same cabang
    //     $teamMembersOnCabang = TimPelayanan_H::where('id_cabang', $jadwalHeader->id_cabang)->get();
    //     $teamMembers = collect();
    //     foreach($teamMembersOnCabang as $team) {
    //         // Get team leader ID
    //         $teamMembers->push($team->id_user);
            
    //         // Get team member IDs from tim_pelayanan_d
    //         $memberIds = $team->tim_pelayanan_d->pluck('id_user');
    //         $teamMembers = $teamMembers->concat($memberIds);
    //     }
    //     $teamMembers = $teamMembers->unique();

    //     // Get volunteers grouped by grade
    //     $grade1to4 = User::whereIn('id', $teamMembers)
    //         ->whereBetween('grade', [1, 4])
    //         ->get()
    //         ->shuffle();
    //     $grade5to7 = User::whereIn('id', $teamMembers)
    //         ->whereBetween('grade', [5, 7])
    //         ->get()
    //         ->shuffle();
    //     $gradeAbove7 = User::whereIn('id', $teamMembers)
    //         ->where('grade', 10)
    //         ->get()
    //         ->shuffle();

    //     // Retrieve `Bagian` IDs based on names
    //     $bagianIds = Bagian::where('status_bagian', 1)
    //                     ->pluck('id_bagian', 'nama_bagian');

    //     // Get all user IDs already assigned on the same day
    //     $assignedUserIds = Jadwal_D::whereHas('detail', function ($query) use ($jadwalHeader) {
    //             $query->whereDate('tanggal_jadwal', $jadwalHeader->tanggal_jadwal);
    //         })
    //         ->pluck('id_user')
    //         ->unique();
            
    //     // Track assigned users for each slot
    //     $assignedUsers = collect($assignedUserIds); // Start with users already assigned
    //     dd($assignedUsers);

    //     // Loop through the slots and assign volunteers
    //     foreach ($slots as $bagianName => $numSlots) {
    //         $bagianId = $bagianIds[$bagianName];

    //         for ($i = 0; $i < $numSlots; $i++) {
    //             $user = null;

    //             // Choose volunteers based on grade and section requirements
    //             if (in_array($bagianName, ['Stage', 'All star dan Little Eagle', 'Super Trooper'])) {
    //                 $user = $grade1to4->reject(function ($u) use ($assignedUsers) {
    //                     return $assignedUsers->contains($u->id);
    //                 })->pop();
    //             } elseif (in_array($bagianName, ['Monitor', 'B.C'])) {
    //                 $user = $grade5to7->reject(function ($u) use ($assignedUsers) {
    //                     return $assignedUsers->contains($u->id);
    //                 })->pop();
    //             } elseif ($bagianName === 'F.O.H') {
    //                 $user = $gradeAbove7->reject(function ($u) use ($assignedUsers) {
    //                     return $assignedUsers->contains($u->id);
    //                 })->pop();
    //             }

    //             // Skip if no volunteer is available for the slot or already assigned
    //             if (!$user) continue;

    //             // Create new detail schedule entry
    //             Jadwal_D::create([
    //                 'id_jadwal_h' => $jadwalId,
    //                 'id_bagian' => $bagianId,
    //                 'id_user' => $user->id,
    //                 'status_jadwal_d' => 1,
    //             ]);

    //             // Track assigned user
    //             $assignedUsers->push($user->id);
    //         }
    //     }
    //     return redirect()->route('jadwal_detail_index', $jadwalId)->with('success', 'Jadwal telah dibuat secara otomatis dengan penugasan acak.');
    // }




}
