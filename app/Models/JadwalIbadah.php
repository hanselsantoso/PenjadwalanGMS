<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ibadah';

    protected $primaryKey = 'id_jadwal_ibadah';

    protected $fillable = [
        'id_cabang',
        'jam_stand_by',
        'jam_mulai',
        'jam_akhir',
        'status_jadwal_ibadah',
    ];
}
