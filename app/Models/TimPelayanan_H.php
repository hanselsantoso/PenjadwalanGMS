<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimPelayanan_H extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tim_pelayanan_h';
    protected $primaryKey = 'id_tim_pelayanan_h';
    protected $fillable = [
        'nama_tim_pelayanan_h',
        'id_user',
        'status_tim_pelayanan_h',
    ];
}
