<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'user_tag';

    protected $primaryKey = 'id_user_tag';

    protected $fillable = [
        'id_user_tag',
        'id_user',
        'id_tag',
        'status_user_tag',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }


    public function tag()
    {
        return $this->belongsTo(Tag::class, 'id_tag', 'id_tag');
    }
}
