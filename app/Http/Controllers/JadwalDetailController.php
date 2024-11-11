<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Jadwal_D;
use App\Models\Jadwal_H;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $jadwal = new Jadwal_D();
        $jadwal->id_jadwal_h = $request->jadwal;
        $jadwal->id_bagian = $request->bagian;
        $jadwal->id_user = $request->user;
        $jadwal->status_jadwal_d = 1;
        $jadwal->save();

        return redirect()->route('jadwal_detail_index', $request->jadwal)->with('success', 'Jadwal created.');
    }

    public function update(Request $request)
    {
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

        return redirect()->back()->with('success', 'Jadwal updated.');
    }

    public function activate($id)
    {
        $jadwal = Jadwal_D::find($id);
        $jadwal->status_jadwal_d = 1;
        $jadwal->save();

        return redirect()->route('jadwal_detail_index', $jadwal->id_jadwal_h)->with('success', 'Jadwal activated.');
    }

    public function deactivate($id)
    {
        $jadwal = Jadwal_D::find($id);
        $jadwal->status_jadwal_d = 0;
        $jadwal->save();

        return redirect()->route('jadwal_detail_index', $jadwal->id_jadwal_h)->with('success', 'Jadwal deactivated.');
    }

    public function automation(Request $request)
    {
        // Retrieve necessary data from the request
        $jadwalId = $request->jadwal;
        $jadwalHeader = Jadwal_H::findOrFail($jadwalId);
        dd($jadwalHeader);
        // Define the slots needed for each day
        $slots = [];
        if (Carbon::parse($jadwalHeader->tanggal_ibadah)->isSaturday()) {
            // Saturday schedule
            $slots = [
                'F.O.H' => 1,
                'Monitor' => 2,
                'Stage' => 2,
            ];
        } elseif (Carbon::parse($jadwalHeader->tanggal_ibadah)->isSunday()) {
            // Sunday schedule
            $slots = [
                'F.O.H' => 2,
                'B.C' => 2,
                'Monitor' => 2,
                'Stage' => 2,
                'Super Trooper' => 2,
                'All Star dan Little Eagle' => 1,
            ];
        }

        // Get volunteers grouped by grade
        $grade1to4 = User::whereBetween('grade', [1, 4])->get()->shuffle();
        $grade5to7 = User::whereBetween('grade', [5, 7])->get()->shuffle();
        $gradeAbove7 = User::where('grade', '>=', 10)->get()->shuffle();

        // Retrieve `Bagian` IDs based on names
        $bagianIds = Bagian::whereIn('nama_bagian', ['Stage', 'All Star dan Little Eagle', 'Super Trooper', 'Monitor', 'B.C', 'F.O.H'])
                        ->pluck('id_bagian', 'nama_bagian');

        // Track assigned users for each slot
        $assignedUsers = collect();

        // Loop through the slots and assign volunteers
        foreach ($slots as $bagianName => $numSlots) {
            $bagianId = $bagianIds[$bagianName];

            for ($i = 0; $i < $numSlots; $i++) {
                $user = null;

                // Choose volunteers based on grade and section requirements
                if (in_array($bagianName, ['Stage', 'All Star and Little Eagle', 'Super Trooper'])) {
                    $user = $grade1to4->pop();
                } elseif (in_array($bagianName, ['Monitor', 'BC'])) {
                    $user = $grade5to7->pop();
                } elseif ($bagianName === 'FOH') {
                    $user = $gradeAbove7->pop();
                }

                // Skip if no volunteer is available for the slot
                if (!$user) continue;

                // Prevent double-scheduling the same user on the same day
                if ($assignedUsers->contains($user->id)) continue;

                // Create new detail schedule entry
                Jadwal_D::create([
                    'id_jadwal_h' => $jadwalId,
                    'id_bagian' => $bagianId,
                    'id_user' => $user->id,
                    'status_jadwal_d' => 1,
                ]);

                // Track assigned user
                $assignedUsers->push($user->id);
            }
        }

        return redirect()->route('jadwal_detail_index', $jadwalId)->with('success', 'Schedule automated with random assignments.');
    }



}
