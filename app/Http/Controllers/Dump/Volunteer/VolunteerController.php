<?php

namespace App\Http\Controllers\Dump\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_H;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(Request $request, ){

        $jadwal = Jadwal_D::where('id_user',auth()->user()->id)->get();
        return view('dump.volunteer.index',with([
            'jadwal'=> $jadwal,
        ]));
    }

    public function detail($id) {
        $jadwal = Jadwal_H::where('id_jadwal_h', $id)->first();
        return view('dump.volunteer.detail', with([
            'jadwal' => $jadwal,
        ]));
    }
}
