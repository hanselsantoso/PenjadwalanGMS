<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimPelayanan_D extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tim_pelayanan_d';
    protected $primaryKey = 'id_tim_pelayanan_d';
    protected $fillable = [
        'id_tim_pelayanan_h',
        'id_bagian',
        'id_user',
        'status_tim_pelayanan_d',
    ];
}
