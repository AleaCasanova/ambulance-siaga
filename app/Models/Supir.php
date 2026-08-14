<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supir extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'supir';

    protected $fillable = [
        'user_id',
        'mitra_id',
        'no_wa',
        'merk_kendaraan',
        'plat_nomor',
        'nomor_sim',
        'nomor_stnk',
        'status_online',
        'lokasi_terakhir_lat',
        'lokasi_terakhir_lng',
        'rating_rata_rata',
        'total_perjalanan',
    ];

    protected function casts(): array
    {
        return [
            'status_online' => 'boolean',
            'lokasi_terakhir_lat' => 'decimal:8',
            'lokasi_terakhir_lng' => 'decimal:8',
            'rating_rata_rata' => 'decimal:2',
            'total_perjalanan' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'supir_id');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalSupir::class, 'supir_id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'supir_id');
    }

    public function getAmbulansAttribute()
    {
        $lastOrder = $this->pemesanan()->with('ambulans')->latest()->first();
        if ($lastOrder && $lastOrder->ambulans) {
            return $lastOrder->ambulans;
        }

        $jadwal = $this->jadwal()->with('ambulans')->latest()->first();
        if ($jadwal && $jadwal->ambulans) {
            return $jadwal->ambulans;
        }

        return \App\Models\Ambulans::first();
    }
}
