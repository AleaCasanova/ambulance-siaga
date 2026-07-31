<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Masyarakat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'masyarakat';

    protected $fillable = [
        'user_id',
        'nik',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'kontak_darurat',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
