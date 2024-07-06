<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function resetPassword()
    {
        return view('auth.reset');
    }

    public function doResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'passwordBaru' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email does not exist.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password reset successfully.');

        $user = User::find($request->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password reset successfully.');
    }
}
