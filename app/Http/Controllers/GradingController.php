<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GradingController extends Controller
{
    function grading() {
        $user = User::where('status_user', 1)->where('role','!=',0)->get();
        return view('grading', compact('user'));
    }

    function update(Request $request) {
        $request->validate([
            'idUser' => 'required|integer',
            'grade' => 'required|integer',
        ]);

        $user = User::findOrFail($request->idUser);
        $user->grade = $request->grade;
        $user->save();

        return redirect()->route('grading_index')->with('success', 'User grade updated.');
    }
}
