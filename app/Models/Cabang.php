<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $table = 'cabang';

    protected $fillable = [
        'id_cabang',
        'nama_cabang',
        'status_cabang',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_cabang';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status_cabang' => 'boolean',
    ];

    /**
     * Check if the cabang is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->status_cabang === 1;
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal_H::class, 'id_cabang', 'id_cabang');
    }
}
