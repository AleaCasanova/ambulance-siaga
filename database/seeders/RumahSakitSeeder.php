<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Seeder;

class RumahSakitSeeder extends Seeder
{
    public function run(): void
    {
        $hospitals = [
            [
                'nama' => 'RSUD Cilacap',
                'alamat' => 'Jl. Gatot Subroto No.28, Sidanegara, Kec. Cilacap Tengah, Kabupaten Cilacap',
                'telepon' => '(0282) 533010',
                'lat' => -7.7289,
                'lng' => 109.0094,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Pertamina Cilacap',
                'alamat' => 'Jl. Setia Budi No.1, Tegalkamulyan, Kec. Cilacap Sel., Kabupaten Cilacap',
                'telepon' => '(0282) 520202',
                'lat' => -7.7315,
                'lng' => 109.0042,
                'kapasitas_igd' => 'Tersedia',
            ],
            [
                'nama' => 'RSI Fatimah Cilacap',
                'alamat' => 'Jl. Ir. H. Juanda No.20, Kebonmanis, Kec. Cilacap Utara, Kabupaten Cilacap',
                'telepon' => '(0282) 542396',
                'lat' => -7.6974,
                'lng' => 109.0435,
                'kapasitas_igd' => 'Tersedia',
            ],
            [
                'nama' => 'RS Santa Maria Cilacap',
                'alamat' => 'Jl. A. Yani No.38, Sidakaya, Kec. Cilacap Sel., Kabupaten Cilacap',
                'telepon' => '(0282) 534859',
                'lat' => -7.7265,
                'lng' => 109.0118,
                'kapasitas_igd' => 'Terbatas',
            ],
        ];

        foreach ($hospitals as $rs) {
            RumahSakit::updateOrCreate(['nama' => $rs['nama']], $rs);
        }
    }
}
