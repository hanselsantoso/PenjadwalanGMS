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

class ScheduleExport implements FromCollection, WithHeadings, WithStyles
{
    protected $startDate;
    protected $endDate;
    protected $positions;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate);
        $this->endDate = Carbon::parse($endDate);

        // Fetch active positions dynamically
        $this->positions = Bagian::where('status_bagian', 1)->get();
    }

    public function collection()
    {
        $rows = collect();

        // Retrieve jadwal_h entries within the date range and group by date and time slot
        $schedules = Jadwal_H::whereBetween('tanggal_jadwal', [$this->startDate, $this->endDate])
            ->where('status_jadwal_h', 1)
            ->with(['detail' => function ($query) {
                $query->with('bagian', 'user');
            }, 'jadwalIbadah'])
            ->get()
            ->groupBy(['tanggal_jadwal', 'id_jadwal_ibadah']);

        $datePairs = $schedules->keys()
            ->map(function ($date) {
                return Carbon::parse($date)->startOfWeek(Carbon::SATURDAY);
            })
            ->unique()
            ->values();

        // Iterate over each position
        foreach ($this->positions as $position) {
            $row = ['Position' => $position->nama_bagian];

            foreach ($datePairs as $startDate) {
                $saturdayDate = $startDate->toDateString();
                $sundayDate = $startDate->copy()->addDay()->toDateString();

                // Saturday data
                if (isset($schedules[$saturdayDate])) {
                    $timeSlots = $schedules[$saturdayDate]->sortBy(function ($dateSchedules) {
                        return $dateSchedules->first()->jadwalIbadah->jam_mulai; // Sort by start time
                    });

                    foreach ($timeSlots as $timeSlotId => $dateSchedules) {
                        $timeSlot = $dateSchedules->first()->jadwalIbadah;
                        $formattedDate = Carbon::parse($saturdayDate)->isoFormat('D MMM');
                        $timeRange = "($timeSlot->jam_mulai - $timeSlot->jam_akhir)";
                        $headerKey = "$formattedDate $timeRange";

                        $volunteers = $dateSchedules
                            ->pluck('detail')
                            ->flatten()
                            ->where('id_bagian', $position->id_bagian)
                            ->map(function ($detail) {
                                return $detail->user->nama_lengkap ?? '';
                            })
                            ->filter()
                            ->implode("\n");

                        $row[$headerKey] = $volunteers;
                    }
                }

                // Sunday data
                if (isset($schedules[$sundayDate])) {
                    $timeSlots = $schedules[$sundayDate]->sortBy(function ($dateSchedules) {
                        return $dateSchedules->first()->jadwalIbadah->jam_mulai; // Sort by start time
                    });

                    foreach ($timeSlots as $timeSlotId => $dateSchedules) {
                        $timeSlot = $dateSchedules->first()->jadwalIbadah;
                        $formattedDate = Carbon::parse($sundayDate)->isoFormat('D MMM');
                        $timeRange = "($timeSlot->jam_mulai - $timeSlot->jam_akhir)";
                        $headerKey = "$formattedDate $timeRange";

                        $volunteers = $dateSchedules
                            ->pluck('detail')
                            ->flatten()
                            ->where('id_bagian', $position->id_bagian)
                            ->map(function ($detail) {
                                return $detail->user->nama_lengkap ?? '';
                            })
                            ->filter()
                            ->implode("\n");

                        $row[$headerKey] = $volunteers;
                    }
                }
            }

            $rows->push($row);
        }

        return $rows;
    }


    public function headings(): array
    {
        // Initialize the header with "Position"
        $headings = ['Position'];

        // Retrieve schedules within the date range and group by date and time slot
        $existingSchedules = Jadwal_H::whereBetween('tanggal_jadwal', [$this->startDate, $this->endDate])
            ->where('status_jadwal_h', 1)
            ->with('jadwalIbadah')
            ->get()
            ->groupBy(['tanggal_jadwal', 'id_jadwal_ibadah']);

        $datePairs = $existingSchedules->keys()
            ->map(function ($date) {
                return Carbon::parse($date)->startOfWeek(Carbon::SATURDAY);
            })
            ->unique()
            ->values();

        foreach ($datePairs as $startDate) {
            $saturdayDate = $startDate->toDateString();
            $sundayDate = $startDate->copy()->addDay()->toDateString();

            // Saturday headers
            if (isset($existingSchedules[$saturdayDate])) {
                $timeSlots = $existingSchedules[$saturdayDate]->sortBy(function ($dateSchedules) {
                    return $dateSchedules->first()->jadwalIbadah->jam_mulai; // Sort by start time
                });

                foreach ($timeSlots as $timeSlotId => $dateSchedules) {
                    $timeSlot = $dateSchedules->first()->jadwalIbadah;
                    $formattedDate = Carbon::parse($saturdayDate)->isoFormat('D MMM');
                    $timeRange = "($timeSlot->jam_mulai - $timeSlot->jam_akhir)";
                    $headings[] = "$formattedDate $timeRange $timeSlot->nama_ibadah";
                }
            }

            // Sunday headers
            if (isset($existingSchedules[$sundayDate])) {
                $timeSlots = $existingSchedules[$sundayDate]->sortBy(function ($dateSchedules) {
                    return $dateSchedules->first()->jadwalIbadah->jam_mulai; // Sort by start time
                });

                foreach ($timeSlots as $timeSlotId => $dateSchedules) {
                    $timeSlot = $dateSchedules->first()->jadwalIbadah;
                    $formattedDate = Carbon::parse($sundayDate)->isoFormat('D MMM');
                    $timeRange = "($timeSlot->jam_mulai - $timeSlot->jam_akhir)";
                    $headings[] = "$formattedDate $timeRange $timeSlot->nama_ibadah";
                }
            }
        }

        return $headings;
    }


    public function styles(Worksheet $sheet)
    {
        // Style the header row
        $sheet->getStyle('1:1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '4CAF50']
            ]
        ]);

        // Style the "Position" column for clarity
        $sheet->getStyle('A')->applyFromArray([
            'font' => ['bold' => true]
        ]);

        // Style for alternating colors on Saturday and Sunday columns
        $columnIndex = 'B';
        foreach ($this->headings() as $heading) {
            if (strpos($heading, 'Sun') !== false) {
                $sheet->getStyle($columnIndex)->getFill()->setFillType('solid')->getStartColor()->setRGB('D1E8FF'); // Light blue for Sunday
            }
            $columnIndex++;
        }

        return [];
    }
}
