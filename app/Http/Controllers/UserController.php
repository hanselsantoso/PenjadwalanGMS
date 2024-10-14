<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman_H;
use App\Models\TimPelayanan_H;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function pic(){

        $jadwal = Jadwal_D::where('id_user',auth()->user()->id)->get();
        $team = TimPelayanan_H::where('id_user', auth()->user()->id)->first();
        dd($team->tim_pelayanan_d);
        return view('Pic.index',with([
            'jadwals'=> $jadwal,
            'team' => $team,
        ]));
    }

    public function volunteer(Request $request, ){

        // dd($info);
        return view('Volunteer.index',with([
            'jadwal'=> $jadwal,
        ]));
    }

    public function servo(){

        // dd($info);
        return view('Servo.index',with([
            // 'user'=> $user,
            // 'info'=> $info,
        ]));
    }
}
