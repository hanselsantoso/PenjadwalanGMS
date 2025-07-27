<?php

namespace App\Http\Controllers\JadwalIbadah;

use App\Http\Controllers\Controller;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class JadwalIbadahController extends Controller
{
    public function index()
    {
        $jadwal = JadwalIbadah::get();
        $jadwalActive = $jadwal->where('status_jadwal_ibadah', 1);
        $jadwalInactive = $jadwal->where('status_jadwal_ibadah', 0);

        return view('jadwal_ibadah.index', compact('jadwalActive', 'jadwalInactive'));
    }

    public function store(Request $request)
    {
        $this->doValidate($request);

        $jadwalIbadah = new JadwalIbadah();
        $jadwalIbadah->nama_ibadah = $request->nama_ibadah;
        $jadwalIbadah->alias_ibadah = $request->alias_ibadah;
        $jadwalIbadah->jam_stand_by = $request->jam_stand_by;
        $jadwalIbadah->jam_mulai = $request->jam_mulai;
        $jadwalIbadah->jam_akhir = $request->jam_akhir;
        $jadwalIbadah->status_jadwal_ibadah = 1;
        $jadwalIbadah->save();
        return redirect()->route('jadwal_ibadah.index')->with('success', 'Jadwal Ibadah berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $this->doValidate($request);
        $request->validate([
            'id_jadwal_ibadah' => 'required'
        ], [
            'id_jadwal_ibadah.required' => 'ID Jadwal Ibadah harus diisi.'
        ]);

        $jadwalIbadah = JadwalIbadah::find($request->id_jadwal_ibadah);
        $jadwalIbadah->nama_ibadah = $request->nama_ibadah;
        $jadwalIbadah->alias_ibadah = $request->alias_ibadah;
        $jadwalIbadah->jam_stand_by = $request->jam_stand_by;
        $jadwalIbadah->jam_mulai = $request->jam_mulai;
        $jadwalIbadah->jam_akhir = $request->jam_akhir;
        $jadwalIbadah->save();
        return redirect()->route('jadwal_ibadah.index')->with('success', 'Jadwal Ibadah berhasil diperbarui.');
    }

    private function doValidate(Request $request) {
        $request->validate([
            'nama_ibadah' => 'required|string|max:255',
            'alias_ibadah' => 'required|string|max:255',
            'jam_stand_by' => 'required|string',
            'jam_mulai' => 'required|string',
            'jam_akhir' => ['required', 'string', function($attribute, $value, $fail) use($request) {
                $jamMulai = strtotime($request->jam_mulai);
                $jamAkhir = strtotime($value);
                if ($jamAkhir < $jamMulai) {
                    $fail('Jam akhir harus lebih besar atau sama dengan jam mulai.');
                }
            }],
        ], [
            'nama_ibadah.required' => 'Nama Ibadah harus diisi.',
            'nama_ibadah.max' => 'Nama Ibadah tidak boleh lebih dari 255 karakter.',
            'alias_ibadah.required' => 'Alias Ibadah harus diisi.',
            'alias_ibadah.max' => 'Alias Ibadah tidak boleh lebih dari 255 karakter.',
        ]);
    }

    public function activate($id)
    {
        $jadwalIbadah = JadwalIbadah::find($id);
        $jadwalIbadah->status_jadwal_ibadah = 1;
        $jadwalIbadah->save();
        return redirect()->route('jadwal_ibadah.index')->with('success', 'Jadwal Ibadah berhasil diaktifkan.');
    }

    public function deactivate($id)
    {
        $jadwalIbadah = JadwalIbadah::find($id);
        $jadwalIbadah->status_jadwal_ibadah = 0;
        $jadwalIbadah->save();
        return redirect()->route('jadwal_ibadah.index')->with('success', 'Jadwal Ibadah berhasil dinonaktifkan.');
    }
}
