<?php

namespace App\Http\Controllers;

use App\Models\Jadwal_D;
use App\Models\Pinjaman_H;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function pic(){

        // dd($info);
        return view('Pic.index',with([
            // 'user'=> $user,
            // 'info'=> $info,
        ]));
    }

    public function volunteer(Request $request, ){

        $jadwal = Jadwal_D::where('id_user',Auth::user()->id_user);
        dd($jadwal);
        return view('Volunteer.index',with([
            // 'user'=> $user,
            // 'info'=> $info,
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
