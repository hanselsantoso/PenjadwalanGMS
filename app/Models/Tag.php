<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'tag';


    protected $fillable = [
        'id_tag',
        'nama_tag',
        'status_tag',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_tag';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status_tag' => 'boolean',
    ];

    /**
     * Check if the tag is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->status_tag === 1;
    }

    public function tags()
    {
        return $this->hasMany(UserTag::class);
    }
}
