<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Cabang;
use App\Models\TimPelayanan;
use App\Models\TimPelayanan_D;
use App\Models\TimPelayanan_H;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimPelayananController extends Controller
{
    function tim() {
        // $bagian = Bagian::where('status_bagian', 1)->get();
        $teams = TimPelayanan_H::all();
        $users = User::where('status_user', 1)->where('role', '!=', 0)->get();
        // $users = User::where('status_user', 1)->get();
        $cabang = Cabang::where('status_cabang', 1)->get();

        return view('tim_pelayanan', [
            'teams' => $teams,
            'cabangs' => $cabang,
            'users' => $users,
        ]);
    }

    function store(Request $request) {
        $request->validate([
            'nama_tim_pelayanan_h' => 'required|string|max:255',
            'user' => 'required',
        ], [
            'nama_tim_pelayanan_h.required' => 'Nama tim pelayanan wajib diisi',
            'nama_tim_pelayanan_h.string' => 'Nama tim pelayanan harus berupa teks',
            'nama_tim_pelayanan_h.max' => 'Nama tim pelayanan maksimal 255 karakter',
            'user.required' => 'Anggota tim wajib diisi'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $timPelayananH = TimPelayanan_H::create([
                    'nama_tim_pelayanan_h' => $request->nama_tim_pelayanan_h,
                    'id_cabang' => $request->cabang,
                    'id_user' => $request->pic,
                ]);

                User::where('id', $request->pic)->update(['role' => 2]);
                // dd($timPelayananH);

                foreach ($request->user as $item) {
                    User::where('id', $item)->update(['role' => 3]);
                    TimPelayanan_D::create([
                        'id_pelayanan_h' => $timPelayananH->id_pelayanan_h,
                        'id_user' => $item,
                    ]);
                }

                return redirect()->route('tim_index')->with('success', 'Tim berhasil dibuat.');
            });

        }

        catch (\Exception $e) {
            return redirect()->route('tim_index')->with('error', 'Gagal membuat Tim: ' . $e->getMessage());
        }


        return redirect()->route('tim_index')->with('success', 'Tim berhasil dibuat.');
    }

    function store_member(Request $request) {
        $request->validate([
            'volunteer' => 'required',
            'id_header' => 'required',
        ]);

        try {
            $timPelayananD = TimPelayanan_D::create([
                'id_pelayanan_h' => $request->id_header,
                'id_user' => $request->volunteer,
            ]);

            User::where('id', $request->volunteer)->update(['role' => 3]);
        }

        catch (\Exception $e) {
            return redirect()->route('tim_index')->with('error', 'Gagal membuat Tim: ' . $e->getMessage());
        }


        return redirect()->route('tim_index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    function updateMember(Request $request) {
        // dd($request->all());
        //update dulu role pic lama dengan 1, yang baru diganti 2
        // update id_user baru
        $request->validate([
            'id_user' => 'required|integer',
        ]);

        $volunteerLama = $request->id_user;
        $volunteerBaru = $request->volunteer;

        $data = TimPelayanan_D::find($request->id_pelayanan_d)
        ->update([
            'id_user' => $request->volunteer,
        ]);

        User::where('id', $volunteerLama)->update(['role' => 1]);
        User::where('id', $volunteerBaru)->update(['role' => 3]);

        return redirect()->route('tim_index')->with('success', 'Header berhasil diperbarui.');
    }

    function updatePIC(Request $request) {
        // dd($request->all());
        //update dulu role pic lama dengan 1, yang baru diganti 2
        // update id_user baru
        $request->validate([
            'nama_tim_pelayanan_h' => 'required',
            'id_user' => 'required|integer',
            'cabang' => 'required',
        ]);

        $picLama = $request->id_user;
        $picBaru = $request->pic;

        $data = TimPelayanan_H::find($request->id_pelayanan_h)
        ->update([
            'nama_tim_pelayanan_h' => $request->nama_tim_pelayanan_h,
            'id_cabang' => $request->cabang,
            'id_user' => $request->pic,
        ]);

        User::where('id', $picLama)->update(['role' => 3]);
        User::where('id', $picBaru)->update(['role' => 2]);

        return redirect()->route('tim_index')->with('success', 'Header berhasil diperbarui.');
    }

    function deactivate($id, $id_user) {
        TimPelayanan_D::where('id_pelayanan_d', $id)->delete();
        User::where('id', $id_user)->update(['role' => 1]);

        return redirect()->route('tim_index')->with('success', 'Anggota berhasil dinonaktifkan.');
    }

    function activate($id) {
        // $bagian = Bagian::findOrFail($id);
        // $bagian->status_bagian = true;
        // $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian berhasil diaktifkan.');
    }
}
