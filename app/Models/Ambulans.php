<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ambulans extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ambulans';

    protected $fillable = [
        'mitra_id',
        'kode_ambulans',
        'plat_nomor',
        'jenis_ambulans',
        'status',
        'kapasitas_medis',
        'perlengkapan_medis',
        'catatan',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'ambulans_id');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalSupir::class, 'ambulans_id');
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'Tersedia' => 'emerald',
            'Ditugaskan' => 'blue',
            'Perawatan' => 'amber',
            'Tidak Aktif' => 'rose',
            default => 'slate',
        };
    }
}
