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
    public function index() {
        $teams = TimPelayanan_H::all();
        $users = User::where('status_user', 1)->where('role', '!=', 0)->get();
        $cabang = Cabang::where('status_cabang', 1)->get();

        return view('tim_pelayanan', [
            'teams' => $teams,
            'cabangs' => $cabang,
            'users' => $users,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'nama_tim_pelayanan_h' => 'required|string|max:255',
            'cabang' => 'required',
            'user' => 'required',
            'pic' => 'required',
        ], [
            'nama_tim_pelayanan_h.required' => 'Nama tim pelayanan wajib diisi',
            'nama_tim_pelayanan_h.string' => 'Nama tim pelayanan harus berupa teks',
            'nama_tim_pelayanan_h.max' => 'Nama tim pelayanan maksimal 255 karakter',
            'user.required' => 'Anggota tim wajib diisi'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $timPelayananH = new TimPelayanan_H();
                $timPelayananH->nama_tim_pelayanan_h = $request->nama_tim_pelayanan_h;
                $timPelayananH->id_cabang = $request->cabang;
                $timPelayananH->id_user = $request->pic;
                $timPelayananH->save();

                User::where('id', $request->pic)->update(['role' => 2]);

                foreach ($request->user as $item) {
                    User::where('id', $item)->update(['role' => 3]);
                    $timPelayananD = new TimPelayanan_D();
                    $timPelayananD->id_pelayanan_h = $timPelayananH->id_pelayanan_h;
                    $timPelayananD->id_user = $item;
                    $timPelayananD->save();
                }

                return redirect()->route('tim_pelayanan.index')->with('success', 'Tim berhasil dibuat.');
            });

        }

        catch (\Exception $e) {
            return redirect()->route('tim_pelayanan.index')->with('error', 'Gagal membuat Tim: ' . $e->getMessage());
        }


        return redirect()->route('tim_pelayanan.index')->with('success', 'Tim berhasil dibuat.');
    }

    public function storeMember(Request $request) {
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
            return redirect()->route('tim_pelayanan.index')->with('error', 'Gagal membuat Tim: ' . $e->getMessage());
        }


        return redirect()->route('tim_pelayanan.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function updateMember(Request $request) {
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

        return redirect()->route('tim_pelayanan.index')->with('success', 'Header berhasil diperbarui.');
    }

    public function updateTim(Request $request) {
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

        $timData = TimPelayanan_H::find($request->id_pelayanan_h);
        $timData->nama_tim_pelayanan_h = $request->nama_tim_pelayanan_h;
        $timData->id_cabang = $request->cabang;
        $timData->id_user = $picBaru;
        $timData->save();

        User::where('id', $picLama)->update(['role' => 3]);
        User::where('id', $picBaru)->update(['role' => 2]);

        return redirect()->route('tim_pelayanan.index')->with('success', 'Header berhasil diperbarui.');
    }

    public function activate($id) {
        // $bagian = Bagian::findOrFail($id);
        // $bagian->status_bagian = true;
        // $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian berhasil diaktifkan.');
    }

    public function deactivate($id, $id_user) {
        TimPelayanan_D::where('id_pelayanan_d', $id)->delete();
        User::where('id', $id_user)->update(['role' => 1]);

        return redirect()->route('tim_pelayanan.index')->with('success', 'Anggota berhasil dinonaktifkan.');
    }
}
