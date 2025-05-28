<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    protected $table = "periksas";

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'id_janji_periksa'
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter')->where('role', 'dokter');
    }

    public function janjiPeriksa()
    {
        return $this->belongsTo(JanjiPeriksa::class, 'id_janji_periksa');
    }

    public function getTglPeriksaFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tgl_periksa)->format('d M Y H:i');
    }

    public function obat()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksas', 'id_periksa', 'id_obat');
    }

    public function detailPeriksas()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    public static function getPeriksaByDokterId($dokterId)
    {
        return self::where('id_dokter', $dokterId)
            ->with(['dokter', 'pasien'])
            ->get();
    }
}
