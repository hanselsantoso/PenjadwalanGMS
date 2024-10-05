<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman_H;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function pic(){

        // dd($info);
        return view('Pic.index',with([
            // 'user'=> $user,
            // 'info'=> $info,
        ]));
    }

    public function volunteer(){

        // dd($info);
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
