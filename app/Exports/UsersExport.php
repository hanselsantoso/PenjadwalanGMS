<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('nij', 'nama_lengkap', 'email', 'alamat', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'telp', 'kesibukan', 'nomor_cg', 'posisi_cg', 'nama_pemimpin', 'telp_pemimpin', 'status_user', 'role')->get();
    }

    public function headings(): array
    {
        return [
            'NIJ',
            'Nama Lengkap',
            'Email',
            'Alamat',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'No. Telp',
            'Kesibukan',
            'Nomor CG',
            'Posisi CG',
            'Nama Pemimpin',
            'Telp Pemimpin',
            'Status User',
            'Role',
        ];
    }
} 