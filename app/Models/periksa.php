<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'id_obat', // Pastikan kolom ini ada di tabel
    ];

    /**
     * Relasi: Periksa milik seorang Pasien (User)
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    /**
     * Relasi: Periksa milik seorang Dokter (User)
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    /**
     * Relasi: Periksa memiliki banyak DetailPeriksa
     */
    public function detailPeriksas(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    /**
     * Relasi: Periksa memiliki satu Obat
     */
    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
    /**
 * Get the main obat for this periksa
 */
public function getObatAttribute()
{
    if ($this->detailPeriksas->isNotEmpty() && $this->detailPeriksas->first()->obat) {
        return $this->detailPeriksas->first()->obat;
    }
    return null;
}
}
