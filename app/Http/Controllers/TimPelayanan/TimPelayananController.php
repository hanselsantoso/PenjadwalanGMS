<?php

namespace App\Http\Controllers\TimPelayanan;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\TimPelayanan_D;
use App\Models\TimPelayanan_H;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimPelayananController extends Controller
{
    public function index() {
        $teams = TimPelayanan_H::all();
        $usersAll = User::where('status_user', 1)->get();
        $usersWithoutTL = User::where('status_user', 1)->where('role', '!=', 0)->get();
        // TODO: Return user that is not already in TL/Anggota (to be used in Tambah Anggota Modal)
        $cabang = Cabang::where('status_cabang', 1)->get();

        return view('tim_pelayanan.index', [
            'teams' => $teams,
            'cabangs' => $cabang,
            'usersWithoutTL' => $usersWithoutTL,
            'usersAll' => $usersAll
        ]);
    }

    public function storeTim(Request $request) {
        $request->validate([
            'nama_tim_pelayanan_h' => 'required|string|max:255',
            'cabang' => 'required',
            'team_leader' => 'required',
            'user' => 'required',
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
                $timPelayananH->id_user = $request->team_leader;
                $timPelayananH->save();

                User::where('id', $request->team_leader)->update(['role' => 2]);
                $timPelayananD = new TimPelayanan_D();
                $timPelayananD->id_pelayanan_h = $timPelayananH->id_pelayanan_h;
                $timPelayananD->id_user = $request->team_leader;
                $timPelayananD->save();

                foreach ($request->user as $item) {
                    User::where('id', $item)->update(['role' => 3]);
                    $timPelayananD = new TimPelayanan_D();
                    $timPelayananD->id_pelayanan_h = $timPelayananH->id_pelayanan_h;
                    $timPelayananD->id_user = $item;
                    $timPelayananD->save();
                }

                return redirect()->route('tim_pelayanan.index')->with('success', 'Tim berhasil dibuat.');
            });
        } catch (\Exception $e) {
            return redirect()->route('tim_pelayanan.index')->with('error', 'Gagal membuat Tim: ' . $e->getMessage());
        }

        return redirect()->route('tim_pelayanan.index')->with('success', 'Tim berhasil dibuat.');
    }

    public function updateTim(Request $request) {
        // dd($request->all());
        //update dulu role pic lama dengan 1, yang baru diganti 2
        // update id_user baru
        $request->validate([
            'id_pelayanan_h' => 'required',
            'nama_tim_pelayanan_h' => 'required',
            'cabang' => 'required',
            'team_leader_old' => 'required|integer',
            'team_leader' => 'required|integer'
        ]);

        $picLama = $request->id_user;
        $picBaru = $request->team_leader;

        $timData = TimPelayanan_H::find($request->id_pelayanan_h);
        $timData->nama_tim_pelayanan_h = $request->nama_tim_pelayanan_h;
        $timData->id_cabang = $request->cabang;
        $timData->id_user = $picBaru;
        $timData->save();

        User::where('id', $picLama)->update(['role' => 3]);
        User::where('id', $picBaru)->update(['role' => 2]);

        return redirect()->route('tim_pelayanan.index')->with('success', 'Tim berhasil diperbarui.');
    }

    public function activate($id) {
        // TODO: add functionality

        return redirect()->route('tim_pelayanan.index')->with('success', 'Tim berhasil diaktifkan.');
    }

    public function deactivate($id, $id_user) {
        // TODO: add functionality
        
        return redirect()->route('tim_pelayanan.index')->with('success', 'Tim berhasil dinonaktifkan.');
    }

    public function storeMember(Request $request) {
        $request->validate([
            'volunteer' => 'required',
            'id_header' => 'required',
        ]);

        try {
            $timPelayananD = new TimPelayanan_D();
            $timPelayananD->id_pelayanan_h = $request->id_header;
            $timPelayananD->id_user = $request->volunteer;
            $timPelayananD->save();

            User::where('id', $request->volunteer)->update(['role' => 3]);
        } catch (\Exception $e) {
            return redirect()->route('tim_pelayanan.index')->with('error', 'Gagal membuat Tim: ' . $e->getMessage());
        }

        return redirect()->route('tim_pelayanan.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function updateMember(Request $request) {
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

    public function removeMember($id, $id_user) {
        TimPelayanan_D::where('id_pelayanan_d', $id)->delete();
        User::where('id', $id_user)->update(['role' => 1]);

        return redirect()->route('tim_pelayanan.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
