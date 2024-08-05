<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Jadwal_D;
use App\Models\Jadwal_H;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalDetailController extends Controller
{
    public function jadwal_detail($id)
    {
        $detail = Jadwal_H::find($id);
        $bagian = Bagian::where('status_bagian', 1)->get();
        $user = User::where('status_user', 1)->where('role',1)->get();
        return view ('jadwal_detail', compact('detail', 'bagian', 'user'));
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
}
