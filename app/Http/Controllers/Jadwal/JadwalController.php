<?php

namespace App\Http\Controllers\Jadwal;

use App\Exports\ScheduleExport;
use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Jadwal_H;
use App\Models\JadwalIbadah;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwalIbadah = JadwalIbadah::where('status_jadwal_ibadah', 1)->get();
        $cabang = Cabang::where('status_cabang', 1)->get();
        $user = User::join('user_tag', 'users.id', '=', 'user_tag.id_user')
                    ->join('tag', 'user_tag.id_tag', '=', 'tag.id_tag')
                    ->join('tim_pelayanan_d', 'tim_pelayanan_d.id_user', '=', 'users.id')
                    ->join('tim_pelayanan_h', 'tim_pelayanan_h.id_pelayanan_h', '=', 'tim_pelayanan_d.id_pelayanan_h')
                    ->where('status_user', 1)
                    ->where('role', '!=', 0)
                    ->where('tag.nama_tag', 'PIC')
                    ->get();

        // Get jadwal with order by latest date and the earliest stand by time
        $jadwal = Jadwal_H::join('jadwal_ibadah', 'jadwal_h.id_jadwal_ibadah', '=', 'jadwal_ibadah.id_jadwal_ibadah')
            ->orderBy('tanggal_jadwal', 'desc')
            ->orderBy('jadwal_ibadah.jam_stand_by', 'asc')
            ->select('jadwal_h.*')
            ->get();
        // Split into active and inactive jadwal
        $jadwalActive = $jadwal->where('status_jadwal_h', 1);
        $jadwalInactive = $jadwal->where('status_jadwal_h', 0);

        return view('jadwal.index', compact('jadwalActive', 'jadwalInactive', 'jadwalIbadah', 'cabang', 'user'));
    }

    private function checkJadwalExists(Request $request)
    {
        // Check for existing schedule with same cabang, jadwal_ibadah and date
        $existingJadwal = Jadwal_H::where('id_cabang', $request->cabang)
            ->where('id_jadwal_ibadah', $request->jadwal_ibadah)
            ->where('tanggal_jadwal', date('Y-m-d', strtotime($request->tanggal_jadwal)))
            ->where('status_jadwal_h', 1)
            ->first();
        return $existingJadwal;
    }

    public function store(Request $request)
    {
        $request->validate([
            'cabang' => 'required|integer',
            'tanggal_jadwal' => 'required',
            'jadwal_ibadah' => 'required|integer',
            'pic_user' => 'required|integer',
        ]);

        $existingJadwal = $this->checkJadwalExists($request);
        if ($existingJadwal) {
            return redirect()->route('jadwal.index')
                ->with('error', 'Jadwal untuk cabang, slot waktu dan tanggal tersebut sudah ada.');
        }

        $jadwal = new Jadwal_H();
        $jadwal->id_cabang = $request->cabang;
        $jadwal->pic = $request->pic_user;
        $jadwal->id_jadwal_ibadah = $request->jadwal_ibadah;
        $jadwal->tanggal_jadwal = date('Y-m-d', strtotime($request->tanggal_jadwal));
        $jadwal->status_jadwal_h = 1;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dibuat.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_jadwal_h' => 'required|integer',
            'cabang' => 'required|integer',
            'tanggal_jadwal' => 'required',
            'jadwal_ibadah' => 'required|integer',
            'pic_user' => 'required|integer',
        ]);

        $existingJadwal = $this->checkJadwalExists($request);
        if ($existingJadwal) {
            return redirect()->route('jadwal.index')
                ->with('error', 'Jadwal untuk cabang, slot waktu dan tanggal tersebut sudah ada.');
        }

        $jadwal = Jadwal_H::find($request->id_jadwal_h);
        $jadwal->pic = $request->pic_user;
        $jadwal->tanggal_jadwal = date('Y-m-d', strtotime($request->tanggal_jadwal));
        $jadwal->save();

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function activate($id)
    {
        $jadwal = Jadwal_H::find($id);
        $jadwal->status_jadwal_h = 1;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diaktifkan.');
    }

    public function deactivate($id)
    {
        $jadwal = Jadwal_H::find($id);
        $jadwal->status_jadwal_h = 0;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dinonaktifkan.');
    }

    public function download(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $idCabang = $request->id_cabang;
        $cabang = Cabang::find($idCabang);
        
        // Format dates for filename
        $startDateFormatted = date('d-m-Y', strtotime($startDate));
        $endDateFormatted = date('d-m-Y', strtotime($endDate));
        $filename = "GMS_Sound_Schedule_{$cabang->nama_cabang}_{$startDateFormatted}_to_{$endDateFormatted}.xlsx";

        // Trigger the download
        return Excel::download(
            new ScheduleExport($startDate, $endDate, $idCabang), 
            $filename
        );
    }
}
