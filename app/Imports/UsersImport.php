<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new User([
            'nij' => $row['nij'],
            'nama_lengkap' => $row['nama_lengkap'],
            'email' => $row['email'],
            'alamat' => $row['alamat'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => Carbon::createFromFormat('d-m-Y', $row['tanggal_lahir'])->format('Y-m-d'),
            'telp' => $row['telp'],
            'kesibukan' => $row['kesibukan'],
            'nomor_cg' => $row['nomor_cg'],
            'posisi_cg' => $row['posisi_cg'],
            'nama_pemimpin' => $row['nama_pemimpin'],
            'telp_pemimpin' => $row['telp_pemimpin'],
            'password' => Hash::make('abcde12345'), // default password
            'status_user' => 1, // default status
            'role' => 1, // default role
        ]);
    }
}
