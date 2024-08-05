<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal_D extends Model
{
    use HasFactory;

    protected $table = 'jadwal_d';
    protected $primaryKey = 'id_jadwal_d';
    protected $fillable = [
        'id_jadwal_h',
        'id_bagian',
        'id_user',
        'status_jadwal_d',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

     public function detail()
    {
        return $this->belongsTo(Jadwal_H::class, 'id_jadwal_h', 'id_jadwal_h');
    }

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'id_bagian', 'id_bagian');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
