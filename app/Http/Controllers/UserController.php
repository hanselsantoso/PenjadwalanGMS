<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman_H;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        // dd($info);
        return view('User.index',with([
            // 'user'=> $user,
            // 'info'=> $info,
        ]));
    }
}
