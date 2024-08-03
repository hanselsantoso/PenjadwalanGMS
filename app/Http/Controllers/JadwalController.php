<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Cabang;
use App\Models\Jadwal_H;
use App\Models\JadwalIbadah;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function jadwal()
    {
        $jadwalIbadah = JadwalIbadah::where('status_jadwal_ibadah', 1)->get();
        $cabang = Cabang::where('status_cabang', 1)->get();
        $user = User::where('status_user', 1)->where('role', 1)->get();
        $jadwal = Jadwal_H::where('status_jadwal_h', 1)->get();

        return view('jadwal', compact('jadwal','jadwalIbadah', 'cabang', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cabang' => 'required|integer',
            'user' => 'required|integer',
            'jadwal_ibadah' => 'required|integer',
        ]);

        $jadwal = new Jadwal_H();
        $jadwal->id_cabang = $request->cabang;
        $jadwal->pic = $request->user;
        $jadwal->id_jadwal_ibadah = $request->jadwal_ibadah;
        $jadwal->tanggal_jadwal = date('Y-m-d', strtotime($request->tanggal_jadwal));
        $jadwal->status_jadwal_h = 1;
        $jadwal->save();

        return redirect()->route('jadwal_index')->with('success', 'Jadwal created.');
    }
}
