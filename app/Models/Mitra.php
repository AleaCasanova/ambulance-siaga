<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mitra extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mitras';

    protected $fillable = [
        'user_id',
        'nama_mitra',
        'penanggung_jawab',
        'nik_pj',
        'foto_ktp_pj',
        'no_telp',
        'alamat',
        'nomor_legalitas',
        'foto_legalitas',
        'plat_nomor_unit',
        'merk_kendaraan',
        'foto_ambulans',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supirs()
    {
        return $this->hasMany(Supir::class, 'mitra_id');
    }

    public function ambulans()
    {
        return $this->hasMany(Ambulans::class, 'mitra_id');
    }
}
