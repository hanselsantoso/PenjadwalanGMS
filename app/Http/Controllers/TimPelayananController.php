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
        $users = User::where('status_user', 1)->where('role',1)->get();
        // $users = User::where('status_user', 1)->get();
        $cabang = Cabang::where('status_cabang', 1)->get();

        return view('timPelayanan', [
            'teams' => $teams,
            'cabangs' => $cabang,
            'users' => $users,
        ]);
    }

    function store(Request $request) {
        $request->validate([
            'nama_tim_pelayanan_h' => 'required|string|max:255',
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

                return redirect()->route('tim_index')->with('success', 'Tim created.');
            });

        }

        catch (\Exception $e) {
            return redirect()->route('tim_index')->with('error', 'Failed to create Tim: ' . $e->getMessage());
        }


        return redirect()->route('tim_index')->with('success', 'Tim created.');
    }

    function update(Request $request) {
        //update dulu role pic lama dengan 1, yang baru diganti 2
        // update id_user baru
        $request->validate([
            'id_bagian' => 'required|integer',
            'nama_bagian' => 'required|string|max:255',
        ]);

        // $bagian = Bagian::findOrFail($request->id_bagian);
        // $bagian->nama_bagian = $request->nama_bagian;
        // $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian updated.');
    }

    function deactivate($id) {
        // $bagian = Bagian::findOrFail($id);
        // $bagian->status_bagian = false;
        // $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian deactivated.');
    }

    function activate($id) {
        // $bagian = Bagian::findOrFail($id);
        // $bagian->status_bagian = true;
        // $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian activated.');
    }
}
