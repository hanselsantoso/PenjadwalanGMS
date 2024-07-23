<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function cabang()
    {
        return view('cabang');
    }
}
