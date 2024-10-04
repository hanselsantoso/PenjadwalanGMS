<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimPelayanan_D extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tim_pelayanan_d';
    protected $primaryKey = 'id_pelayanan_d';
    protected $fillable = [
        'id_pelayanan_h',
        'id_user',
        'status_tim_pelayanan_d',
    ];

    public function tim_pelayanan_h() {
        return $this->belongsTo(TimPelayanan_H::class, 'id_pelayanan_h', 'id_pelayanan_h');
    }

    public function bagian() {
        return $this->belongsTo(Bagian::class, 'id_bagian', 'id_bagian');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
