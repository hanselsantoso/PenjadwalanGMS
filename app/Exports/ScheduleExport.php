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
    protected $headings;
    protected $rows;

    public function __construct($startDate, $endDate, $idCabang)
    {
        $this->startDate = Carbon::parse($startDate);
        $this->endDate = Carbon::parse($endDate);
        $this->positions = Bagian::where('status_bagian', 1)->get();

        $this->generateData($idCabang);
    }

    private function generateData($idCabang)
    {
        $headings = ['Position'];
        $rows = collect();

        $schedules = $this->getSchedules($idCabang);
        $datePairs = $this->getDatePairs($schedules);

        $row = [];
        foreach ($this->positions as $position) {
            // Assign nama_bagian to column "Position"
            $row[$headings[0]] = $position->nama_bagian;

            // Iterate over each Saturday+Sunday date pair
            foreach ($datePairs as $startDate) {
                $saturdayDate = $startDate->toDateString();
                $sundayDate = $startDate->copy()->addDay()->toDateString();

                $saturdaySchedules = $schedules[$saturdayDate] ?? null;
                $sundaySchedules = $schedules[$sundayDate] ?? null;

                // Saturday data
                if ($saturdaySchedules) {
                    $saturdaySchedules = $this->sortSchedulesByJamMulai($saturdaySchedules);
                    
                    $this->fillRowAndHeader(
                        $saturdaySchedules, 
                        $saturdayDate, 
                        $position,
                        $headings,
                        $row
                    );
                }

                // Sunday data
                if ($sundaySchedules) {
                    $sundaySchedules = $this->sortSchedulesByJamMulai($sundaySchedules);

                    $this->fillRowAndHeader(
                        $sundaySchedules, 
                        $sundayDate, 
                        $position,
                        $headings,
                        $row
                    );
                }
            }

            $rows->push($row);
        }

        $this->headings = $headings;
        $this->rows = $rows;
    }

    private function getSchedules($idCabang)
    {
        // Retrieve jadwal_h entries within the date range and group by date and time slot
        $query = Jadwal_H::whereBetween('tanggal_jadwal', [$this->startDate, $this->endDate])
            ->where('status_jadwal_h', 1);

        if ($idCabang !== null) {
            $query->where('id_cabang', $idCabang);
        }

        return $query->with(['detail' => function ($query) {
                                $query->with('bagian', 'user');
                            }, 'jadwalIbadah'])
                                ->get()
                                ->groupBy(['tanggal_jadwal', 'id_jadwal_ibadah'])
                                ->sortBy('tanggal_jadwal');
    }
    
    private function getDatePairs($schedules)
    {
        // Get Saturday and Sunday date pair from schedules
        return $schedules
                    ->keys()
                    ->map(function ($date) {
                        return Carbon::parse($date)->startOfWeek(Carbon::SATURDAY);
                    })
                    ->unique()
                    ->values();
    }

    private function sortSchedulesByJamMulai($schedules)
    {
        // Sort by start time
        return $schedules->sortBy(function ($dateSchedules) {
            return $dateSchedules->first()->jadwalIbadah->jam_mulai; 
        });
    }

    private function fillRowAndHeader($schedules, $jadwalDate, $position, &$headings, &$row)
    {
        // dump($schedules);
        foreach ($schedules as $scheduleId => $schedule) {
            $jadwalIbadah = $schedule->first()->jadwalIbadah;
            
            $aliasIbadah = $jadwalIbadah->alias_ibadah;
            $tanggalIbadah = Carbon::parse($jadwalDate)->isoFormat('ddd, DD MMM YYYY');
            $jamIbadah = "($jadwalIbadah->jam_mulai - $jadwalIbadah->jam_akhir)";
            
            $headingKey = "$tanggalIbadah \n$aliasIbadah \n$jamIbadah";
            if (!in_array($headingKey, $headings)) {
                $headings[] = $headingKey;
            }

            $volunteers = $schedule
                ->pluck('detail')
                ->flatten()
                ->where('id_bagian', $position->id_bagian)
                ->map(function ($detail) {
                    return $detail->user->nama_lengkap ?? '-';
                })
                ->filter()
                ->implode(" & ");
            // dump($headingKey." ;;; ".$volunteers);
            
            $row[$headingKey] = $volunteers ?: '-';
        }
    }

    public function collection()
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return $this->headings;
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
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
                'wrapText' => true
            ],
        ]);

        // Style for alternating colors on Saturday and Sunday columns
        $columnIndex = 'B';
        foreach ($this->headings() as $heading) {
            // Style center and wrap text for the whole column
            $sheet->getStyle($columnIndex.':'.$columnIndex)->applyFromArray([
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                    'wrapText' => true
                ],
            ]);

            // if (str_contains(strtolower($heading), 'sun')) {
            //     // Light blue bgc for Sunday
            //     $columnName = $columnIndex.'1';
            //     $sheet->getStyle($columnIndex.'1')
            //             ->getFill()
            //             ->setFillType('solid')
            //             ->getStartColor()
            //             ->setRGB('D1E8FF');
            // }
            $columnIndex++;
        }

        return [];
    }
}
