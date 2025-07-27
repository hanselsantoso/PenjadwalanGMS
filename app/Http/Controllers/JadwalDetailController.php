<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal_H;
use App\Models\Jadwal_D;
use App\Models\Bagian;
use App\Models\User;

class JadwalDetailController extends Controller
{
    public function index($id)
    {
        // Order By Bagian ID
        $jadwal = Jadwal_H::with(['detail' => function($query) {
            $query->join('bagian', 'jadwal_d.id_bagian', '=', 'bagian.id_bagian')
                ->orderBy('bagian.id_bagian');
        }])->find($id);

        $bagian = Bagian::where('status_bagian', 1)->get();
        $user = User::where('status_user', 1)->where('role', '!=', 0)->get();
        $id_H = $id;

        return view ('jadwal_detail', compact('jadwal', 'bagian', 'user', 'id_H'));
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
            return redirect()->route('jadwal_detail.index', $request->jadwal)->with('error', 'User sudah ada di jadwal.');
        }

        $jadwal = new Jadwal_D();
        $jadwal->id_jadwal_h = $request->jadwal;
        $jadwal->id_bagian = $request->bagian;
        $jadwal->id_user = $request->user;
        $jadwal->status_jadwal_d = 1;
        $jadwal->save();
        return redirect()->route('jadwal_detail.index', $request->jadwal)->with('success', 'Jadwal berhasil dibuat.');
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

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function activate($id)
    {
        $jadwal = Jadwal_D::find($id);
        $jadwal->status_jadwal_d = 1;
        $jadwal->save();

        return redirect()->route('jadwal_detail.index', $jadwal->id_jadwal_h)->with('success', 'Jadwal berhasil diaktifkan.');
    }

    public function deactivate($id)
    {
        $jadwal = Jadwal_D::find($id);
        $jadwal->status_jadwal_d = 0;
        $jadwal->save();

        return redirect()->route('jadwal_detail.index', $jadwal->id_jadwal_h)->with('success', 'Jadwal berhasil dinonaktifkan.');
    }

    public function delete($id)
    {
        $jadwal = Jadwal_D::find($id);
        $jadwalId = $jadwal->id_jadwal_h;
        $jadwal->delete();

        return redirect()->route('jadwal_detail.index', $jadwalId)->with('success', 'Jadwal berhasil dihapus.');
    }
}
