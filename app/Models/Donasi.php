<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Donasi extends Model
{
    use HasUuids;

    protected $fillable = [
        'nama',
        'is_anonim',
        'email',
        'whatsapp',
        'pesan',
        'nominal',
        'status',
        'snap_token',
    ];
}
