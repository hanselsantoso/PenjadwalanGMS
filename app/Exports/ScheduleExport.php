<?php

namespace App\Exports;

use App\Models\Bagian;
use App\Models\Jadwal_H;
use App\Models\JadwalIbadah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduleExport implements FromCollection, WithHeadings, WithStyles
{
    protected $startDate;
    protected $endDate;
    protected $positions;
    protected $timeSlots;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate);
        $this->endDate = Carbon::parse($endDate);

        // Fetch positions and time slots dynamically based on the status
        $this->positions = Bagian::where('status_bagian', 1)->get();
        $this->timeSlots = JadwalIbadah::where('status_jadwal_ibadah', 1)->get();
    }

    public function collection()
    {
        $rows = collect();

        // Retrieve jadwal_h entries within the date range and group by tanggal_ibadah
        $schedules = Jadwal_H::whereBetween('tanggal_jadwal', [$this->startDate, $this->endDate])
            ->where('status_jadwal_h', 1)
            ->with(['detail' => function ($query) {
                $query->with('bagian', 'user');
            }, 'jadwalIbadah'])
            ->get()
            ->groupBy('tanggal_jadwal');
        foreach ($schedules as $date => $dateSchedules) {
            // Initialize a row with the date label
            $row = [
                'Date' => Carbon::parse($date)->isoFormat('dddd, D MMMM YYYY')
            ];

            foreach ($this->timeSlots as $slot) {
                foreach ($this->positions as $position) {
                    // Collect volunteers for each time slot and position on the same date
                    $volunteers = $dateSchedules
                        ->where('id_jadwal_ibadah', $slot->id_jadwal_ibadah)
                        ->pluck('detail')
                        ->flatten()
                        ->where('id_bagian', $position->id_bagian)
                        ->map(function ($detail) {
                            return $detail->user->nama_lengkap ?? ''; // Assuming user relation has name
                        })
                        ->implode(', ');
                    $row["$position->nama_bagian - $slot->jam_mulai - $slot->jam_akhir"] = $volunteers;
                }
            }

            // Add the grouped row to the collection
            $rows->push($row);
        }
        return $rows;
    }

    public function headings(): array
    {
        // Set up headings with dynamic columns based on positions and time slots
        $headings = ['Date'];
        foreach ($this->timeSlots as $slot) {
            foreach ($this->positions as $position) {
                $headings[] = "$position->nama_bagian - $slot->jam_mulai - $slot->jam_akhir";
            }
        }

        return $headings;
    }

    public function styles(Worksheet $sheet)
    {
        // Apply styles for the header row
        return [
            1 => ['font' => ['bold' => true]],
            'A' => ['font' => ['bold' => true]]
        ];
    }
}

