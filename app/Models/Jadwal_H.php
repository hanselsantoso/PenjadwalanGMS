<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal_H extends Model
{
    use HasFactory;

    protected $table = 'jadwal_h';
    protected $primaryKey = 'id_jadwal_h';
    protected $fillable = [
        'id_cabang',
        'id_jadwal_ibadah',
        'pic',
        'status_jadwal_h',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

     public function detail()
    {
        return $this->hasMany(Jadwal_D::class);
    }
}
