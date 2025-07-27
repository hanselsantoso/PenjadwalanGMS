<?php

namespace App\Http\Controllers\Grading;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GradingController extends Controller
{
    public function index() {
        $user = User::where('status_user', 1)
            ->where('role', '!=', 0)
            ->with(['tim_pelayanan_d.tim_pelayanan_h'])
            ->get()
            ->map(function($user) {
                if (isset($user->tim_pelayanan_d)) {
                    $user->team_name = $user->tim_pelayanan_d->tim_pelayanan_h->nama_tim_pelayanan_h;
                } else {
                    $user->team_name = '-';
                }
                return $user;
            })
            ->groupBy('team_name')
            ->flatten();

        return view('grading.index', compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'idUser' => 'required|integer',
            'grade' => 'required|integer',
        ]);

        $user = User::findOrFail($request->idUser);
        $user->grade = $request->grade;
        $user->save();

        return redirect()->route('grading.index')->with('success', 'Grade user berhasil diperbarui.');
    }
}
