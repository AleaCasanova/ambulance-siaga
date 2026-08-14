<?php

namespace Database\Seeders;

use App\Models\Ambulans;
use App\Models\Mitra;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'mitra@ambulansiaga.com'],
            [
                'name' => 'PMI Kabupaten Cilacap',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'phone' => '081234567899',
                'email_verified_at' => now(),
            ]
        );

        $mitra = Mitra::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama_mitra' => 'PMI Kabupaten Cilacap',
                'penanggung_jawab' => 'Dr. Budi Santoso, M.Kes',
                'no_telp' => '081234567899',
                'alamat' => 'Jl. Gatot Subroto No. 45, Cilacap Tengah',
                'is_active' => true,
            ]
        );

        // Assign first 2 ambulans and supirs to this mitra for demo
        Ambulans::take(2)->update(['mitra_id' => $mitra->id]);
        Supir::take(2)->update(['mitra_id' => $mitra->id]);
    }
}
