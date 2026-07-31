<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalSupir extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_supir';

    protected $fillable = [
        'supir_id',
        'ambulans_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function supir()
    {
        return $this->belongsTo(Supir::class);
    }

    public function ambulans()
    {
        return $this->belongsTo(Ambulans::class);
    }
}
