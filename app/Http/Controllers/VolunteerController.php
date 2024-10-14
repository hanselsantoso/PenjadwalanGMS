<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_H;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function detail($id) {
        $jadwal = Jadwal_H::where('id_jadwal_h', $id)->first();
        return view('Volunteer.detail', with([
            'jadwal' => $jadwal,
        ]));
    }
}
