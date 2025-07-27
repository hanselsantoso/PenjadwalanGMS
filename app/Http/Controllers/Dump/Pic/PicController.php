<?php

namespace App\Http\Controllers\Dump\Pic;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_H;
use App\Models\TimPelayanan_H;

class PicController extends Controller
{
    public function index(){

        $jadwal = Jadwal_D::where('id_user',auth()->user()->id)->get();
        $team = TimPelayanan_H::where('id_user', auth()->user()->id)->first();
        // dd($team->tim_pelayanan_d);
        return view('dump.pic.index',with([
            'jadwals'=> $jadwal,
            'team' => $team,
        ]));
    }

    public function detail($id) {
        $jadwal = Jadwal_H::where('id_jadwal_h', $id)->first();

        return view('dump.pic.detail', with([
            'jadwal' => $jadwal,
        ]));
    }
}
