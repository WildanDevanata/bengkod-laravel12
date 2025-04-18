<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_periksa',
        'id_obat',
        // Add any other fields that might be required
    ];
    
    /**
     * Get the periksa record that owns this detail
     */
    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }
    
    /**
     * Get the obat associated with this detail
     */
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}