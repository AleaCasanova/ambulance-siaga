<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemesanan';

    protected $fillable = [
        'kode_order',
        'user_id',
        'supir_id',
        'ambulans_id',
        'rumah_sakit_id',
        'dispatcher_id',
        'nama_pasien',
        'kondisi_pasien',
        'lokasi_jemput',
        'jemput_lat',
        'jemput_lng',
        'tujuan_lokasi',
        'tujuan_lat',
        'tujuan_lng',
        'status',
        'catatan_tambahan',
        'waktu_pesan',
        'waktu_respon',
        'waktu_jemput',
        'waktu_selesai',
    ];

    protected function casts(): array
    {
        return [
            'jemput_lat' => 'decimal:8',
            'jemput_lng' => 'decimal:8',
            'tujuan_lat' => 'decimal:8',
            'tujuan_lng' => 'decimal:8',
            'waktu_pesan' => 'datetime',
            'waktu_respon' => 'datetime',
            'waktu_jemput' => 'datetime',
            'waktu_selesai' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function supir()
    {
        return $this->belongsTo(Supir::class, 'supir_id');
    }

    public function ambulans()
    {
        return $this->belongsTo(Ambulans::class, 'ambulans_id');
    }

    public function rumahSakit()
    {
        return $this->belongsTo(RumahSakit::class, 'rumah_sakit_id');
    }

    public function dispatcher()
    {
        return $this->belongsTo(User::class, 'dispatcher_id');
    }

    public function trackingGps()
    {
        return $this->hasMany(TrackingGps::class, 'pemesanan_id')->orderBy('recorded_at', 'desc');
    }

    public function latestTracking()
    {
        return $this->hasOne(TrackingGps::class, 'pemesanan_id')->latestOfMany('recorded_at');
    }

    public function statusPerjalanan()
    {
        return $this->hasMany(StatusPerjalanan::class, 'pemesanan_id')->orderBy('created_at', 'asc');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'pemesanan_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'pemesanan_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu' => 'Menunggu Dispatcher',
            'diproses' => 'Ambulans Ditugaskan',
            'menuju_lokasi' => 'Menuju Lokasi Jemput',
            'membawa_pasien' => 'Membawa Pasien ke RS',
            'selesai' => 'Selesai / Terlayani',
            'dibatalkan' => 'Dibatalkan',
            default => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'menunggu' => 'amber',
            'diproses' => 'blue',
            'menuju_lokasi' => 'indigo',
            'membawa_pasien' => 'purple',
            'selesai' => 'emerald',
            'dibatalkan' => 'rose',
            default => 'slate',
        };
    }
}
