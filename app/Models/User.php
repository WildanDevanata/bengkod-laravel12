<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama', 'alamat', 'no_hp', 'email', 'email_verified_at',
        'password', 'role', 'remember_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi: User (Pasien) memiliki banyak Periksa
     */
    public function periksasAsPatient(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    /**
     * Relasi: User (Dokter) memiliki banyak Periksa
     */
    public function periksasAsDoctor(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }
}
