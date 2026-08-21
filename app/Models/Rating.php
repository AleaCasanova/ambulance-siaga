<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating';

    protected $fillable = [
        'pemesanan_id',
        'user_id',
        'supir_id',
        'nama_pengirim',
        'peran_pengirim',
        'asal_kota',
        'skor',
        'ulasan',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supir()
    {
        return $this->belongsTo(Supir::class);
    }

    public function getNamaTampilAttribute()
    {
        if (!empty($this->nama_pengirim)) {
            return $this->nama_pengirim;
        }
        return $this->user ? $this->user->name : 'Masyarakat / Pasien';
    }

    public function getPeranTampilAttribute()
    {
        if (!empty($this->peran_pengirim)) {
            return $this->peran_pengirim . ($this->asal_kota ? ', ' . $this->asal_kota : '');
        }
        return 'Keluarga Pasien' . ($this->asal_kota ? ', ' . $this->asal_kota : '');
    }
}
