<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TimPelayanan;
use App\Models\TimPelayanan_H;
use Illuminate\Http\Request;

class TimPelayananController extends Controller
{
    function tim() {
        // $bagian = Bagian::where('status_bagian', 1)->get();
        $tim = TimPelayanan_H::all();
        return view('tim', compact('tim'));
    }

    function store(Request $request) {
        // $request->validate([
        //     'nama_bagian' => 'required|string|max:255',
        // ]);

        // $bagian = new TimPelayanan();
        // $bagian->nama_bagian = $request->nama_bagian;
        // $bagian->status_bagian = 1;
        // $bagian->save();

        return redirect()->route('tim_index')->with('success', 'Tim created.');
    }

    function update(Request $request) {
        $request->validate([
            'id_bagian' => 'required|integer',
            'nama_bagian' => 'required|string|max:255',
        ]);

        // $bagian = Bagian::findOrFail($request->id_bagian);
        // $bagian->nama_bagian = $request->nama_bagian;
        // $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian updated.');
    }

    function deactivate($id) {
        // $bagian = Bagian::findOrFail($id);
        // $bagian->status_bagian = false;
        // $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian deactivated.');
    }

    function activate($id) {
        // $bagian = Bagian::findOrFail($id);
        // $bagian->status_bagian = true;
        // $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian activated.');
    }
}
