<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    function bagian() {
        $bagian = Bagian::where('status_bagian', 1)->get();
        return view('bagian', compact('bagian'));
    }

    function store(Request $request) {
        $request->validate([
            'nama_bagian' => 'required|string|max:255',
        ]);

        $bagian = new Bagian();
        $bagian->nama_bagian = $request->nama_bagian;
        $bagian->status_bagian = 1;
        $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian created.');
    }

    function update(Request $request) {
        $request->validate([
            'id_bagian' => 'required|integer',
            'nama_bagian' => 'required|string|max:255',
        ]);

        $bagian = Bagian::findOrFail($request->id_bagian);
        $bagian->nama_bagian = $request->nama_bagian;
        $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian updated.');
    }

    function deactivate($id) {
        $bagian = Bagian::findOrFail($id);
        $bagian->status_bagian = false;
        $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian deactivated.');
    }

    function activate($id) {
        $bagian = Bagian::findOrFail($id);
        $bagian->status_bagian = true;
        $bagian->save();

        return redirect()->route('bagian_index')->with('success', 'Bagian activated.');
    }
}
