<?php

namespace App\Http\Controllers;

use App\Exports\ScheduleExport;
use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Cabang;
use App\Models\Jadwal_H;
use App\Models\JadwalIbadah;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JadwalController extends Controller
{
    public function jadwal()
    {
        $jadwalIbadah = JadwalIbadah::where('status_jadwal_ibadah', 1)->get();
        $cabang = Cabang::where('status_cabang', 1)->get();
        $user = User::where('status_user', 1)->where('role', '!=', 0)->get();

        // Get jadwal with order by latest date and the earliest stand by time
        $jadwal = Jadwal_H::join('jadwal_ibadah', 'jadwal_h.id_jadwal_ibadah', '=', 'jadwal_ibadah.id_jadwal_ibadah')
            ->orderBy('tanggal_jadwal', 'desc')
            ->orderBy('jadwal_ibadah.jam_stand_by', 'asc')
            ->select('jadwal_h.*')
            ->get();
        // Split into active and inactive jadwal
        $jadwalActive = $jadwal->where('status_jadwal_h', 1);
        $jadwalDeactive = $jadwal->where('status_jadwal_h', 0);

        return view('jadwal', compact('jadwalActive', 'jadwalDeactive', 'jadwalIbadah', 'cabang', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cabang' => 'required|integer',
            'user' => 'required|integer',
            'jadwal_ibadah' => 'required|integer',
        ]);

        // Check for existing schedule with same cabang, jadwal_ibadah and date
        $existingJadwal = Jadwal_H::where('id_cabang', $request->cabang)
            ->where('id_jadwal_ibadah', $request->jadwal_ibadah)
            ->where('tanggal_jadwal', date('Y-m-d', strtotime($request->tanggal_jadwal)))
            ->where('status_jadwal_h', 1)
            ->first();

        if ($existingJadwal) {
            return redirect()->route('jadwal_index')
                ->with('error', 'Jadwal untuk cabang, slot waktu dan tanggal tersebut sudah ada.');
        }

        $jadwal = new Jadwal_H();
        $jadwal->id_cabang = $request->cabang;
        $jadwal->pic = $request->user;
        $jadwal->id_jadwal_ibadah = $request->jadwal_ibadah;
        $jadwal->tanggal_jadwal = date('Y-m-d', strtotime($request->tanggal_jadwal));
        $jadwal->status_jadwal_h = 1;
        $jadwal->save();

        return redirect()->route('jadwal_index')->with('success', 'Jadwal berhasil dibuat.');
    }

    // TODO: Add Update, Activate & Deactivate function 
    public function activate($id)
    {
        $jadwal = Jadwal_H::find($id);
        $jadwal->status_jadwal_h = 1;
        $jadwal->save();

        return redirect()->route('jadwal_index')->with('success', 'Jadwal berhasil diaktifkan.');
    }

    public function deactivate($id)
    {
        $jadwal = Jadwal_H::find($id);
        $jadwal->status_jadwal_h = 0;
        $jadwal->save();

        return redirect()->route('jadwal_index')->with('success', 'Jadwal berhasil dinonaktifkan.');
    }

    public function downloadSchedule(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Trigger the download
        return Excel::download(new ScheduleExport($startDate, $endDate), 'schedule.xlsx');
    }
}
