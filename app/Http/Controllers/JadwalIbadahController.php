<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class JadwalIbadahController extends Controller
{
    public function jadwalIbadah()
    {
        // TODO: IDK WHY KOK CUMA STATUS 1 YG DIMUNCULIN
        $jadwal = JadwalIbadah::where('status_jadwal_ibadah', 1)->get();
        return view('jadwal_ibadah', compact('jadwal'));
    }

    public function store(Request $request)
    {
        //TODO: PENGECEKAN SEMUA JAM
        $jadwalIbadah = new JadwalIbadah();
        $jadwalIbadah->nama_ibadah = $request->nama_ibadah;
        $jadwalIbadah->jam_stand_by = $request->jam_stand_by;
        $jadwalIbadah->jam_mulai = $request->jam_mulai;
        $jadwalIbadah->jam_akhir = $request->jam_akhir;
        $jadwalIbadah->status_jadwal_ibadah = 1;
        $jadwalIbadah->save();
        return redirect()->route('jadwal_ibadah_index')->with('success', 'Jadwal Ibadah berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        //TODO: PENGECEKAN SEMUA JAM
        $jadwalIbadah = JadwalIbadah::find($request->id_jadwal_ibadah);
        $jadwalIbadah->nama_ibadah = $request->nama_ibadah;
        $jadwalIbadah->jam_stand_by = $request->jam_stand_by;
        $jadwalIbadah->jam_mulai = $request->jam_mulai;
        $jadwalIbadah->jam_akhir = $request->jam_akhir;
        $jadwalIbadah->save();
        return redirect()->route('jadwal_ibadah_index')->with('success', 'Jadwal Ibadah berhasil diperbarui.');
    }

    public function deactivate($id)
    {
        $jadwalIbadah = JadwalIbadah::find($id);
        $jadwalIbadah->status_jadwal_ibadah = 0;
        $jadwalIbadah->save();
        return redirect()->route('jadwal_ibadah_index')->with('success', 'Jadwal Ibadah berhasil dinonaktifkan.');
    }

    public function activate($id)
    {
        $jadwalIbadah = JadwalIbadah::find($id);
        $jadwalIbadah->status_jadwal_ibadah = 1;
        $jadwalIbadah->save();
        return redirect()->route('jadwal_ibadah_index')->with('success', 'Jadwal Ibadah berhasil diaktifkan.');
    }
}
