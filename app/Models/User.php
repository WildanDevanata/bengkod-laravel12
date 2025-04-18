<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama',           // Add 'nama' here
        'alamat',
        'no_hp',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function periksasAsPatient()
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    public function periksasAsDoctor()
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }
}

