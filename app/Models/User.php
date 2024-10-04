<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nij',
        'nama_lengkap',
        'email',
        'alamat',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'telp',
        'kesibukan',
        'nomor_cg',
        'posisi_cg',
        'status_user',
        'nama_pemimpin',
        'telp_pemipin',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getTanggal($value)
    {
        return $value ? $this->asDateTime($value)->format('d-m-Y') : null;
    }

    public function isAdmin(){
        return $this->role === 1;
    }

    public function isUser(){
        return $this->role === 2;
    }

    public function tags()
    {
        return $this->hasMany(UserTag::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal_H::class, 'pic', 'id');
    }

    public function jadwalDetail()
    {
        return $this->hasMany(Jadwal_D::class, 'id_user', 'id');
    }

    public function tim_pelayanan_h() {
        return $this->hasOne(TimPelayanan_H::class, 'id_user', 'id');
    }

    public function tim_pelayanan_d() {
        return $this->hasOne(TimPelayanan_D::class, 'id_user', 'id');
    }
}
