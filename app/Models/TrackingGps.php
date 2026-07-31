<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingGps extends Model
{
    use HasFactory;

    protected $table = 'tracking_gps';

    protected $fillable = [
        'pemesanan_id',
        'supir_id',
        'lat',
        'lng',
        'kecepatan',
        'heading',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'lat' => 'decimal:8',
            'lng' => 'decimal:8',
            'recorded_at' => 'datetime',
        ];
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function supir()
    {
        return $this->belongsTo(Supir::class);
    }
}
