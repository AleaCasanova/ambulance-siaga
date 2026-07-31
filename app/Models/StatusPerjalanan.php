<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPerjalanan extends Model
{
    use HasFactory;

    protected $table = 'status_perjalanan';

    protected $fillable = [
        'pemesanan_id',
        'status',
        'keterangan',
        'created_by',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
