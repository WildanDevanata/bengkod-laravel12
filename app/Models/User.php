<?php

// Model: User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['nama', 'alamat', 'no_hp', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function periksasAsPatient(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    public function periksasAsDoctor(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }
}
