<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RumahSakit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rumah_sakit';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'lat',
        'lng',
        'kapasitas_igd',
    ];

    protected function casts(): array
    {
        return [
            'lat' => 'decimal:8',
            'lng' => 'decimal:8',
        ];
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'rumah_sakit_id');
    }
}
