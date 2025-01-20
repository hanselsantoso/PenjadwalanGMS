<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function cabang()
    {
        $cabang = Cabang::all();
        return view('cabang', compact('cabang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cabang' => 'required|string|max:255',
        ]);

        $cabang = new Cabang();
        $cabang->nama_cabang = $request->nama_cabang;
        $cabang->status_cabang = 1;
        $cabang->save();

        return redirect()->route('cabang_index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_cabang' => 'required|integer',
            'nama_cabang' => 'required|string|max:255',
        ]);

        $cabang = Cabang::findOrFail($request->id_cabang);
        $cabang->nama_cabang = $request->nama_cabang;
        $cabang->save();

        return redirect()->route('cabang_index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function deactivate($id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->status_cabang = false;
        $cabang->save();

        return redirect()->route('cabang_index')->with('success', 'Lokasi berhasil dinonaktifkan.');
    }

    public function activate($id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->status_cabang = true;
        $cabang->save();

        return redirect()->route('cabang_index')->with('success', 'Lokasi berhasil diaktifkan.');
    }
}
