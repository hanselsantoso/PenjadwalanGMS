<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_H;
use App\Models\TimPelayanan_H;
use Illuminate\Http\Request;

class PicController extends Controller
{
    public function detail($id) {
        $jadwal = Jadwal_H::where('id_jadwal_h', $id)->first();

        return view('Pic.detail', with([
            'jadwal' => $jadwal,
        ]));
    }
}
