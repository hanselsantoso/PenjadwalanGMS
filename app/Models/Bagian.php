<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;

    protected $table = 'bagian';
    protected $primaryKey = 'id_bagian';
    protected $fillable = [
        'nama_bagian',
        'status_bagian',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

     public function detail()
    {
        return $this->hasOne(Jadwal_D::class, 'id_bagian', 'id_bagian');
    }
}
