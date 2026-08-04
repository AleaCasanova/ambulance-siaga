<?php

namespace Database\Seeders;

use App\Models\Ambulans;
use Illuminate\Database\Seeder;

class AmbulansSeeder extends Seeder
{
    public function run(): void
    {
        $ambulances = [
            [
                'kode_ambulans' => 'AMB-01',
                'plat_nomor' => 'R 1890 SC',
                'jenis_ambulans' => 'Emergency Medis (VIP)',
                'status' => 'Tersedia',
                'kapasitas_medis' => '1 Pasien + 2 Pendamping + Medis',
                'perlengkapan_medis' => 'Tabung Oksigen, AED, Tandu Stretcher, P3K Darurat, Infus Set, Suction Unit',
                'catatan' => 'Armada utama siaga darurat 24 jam wilayah Cilacap Kota',
            ],
            [
                'kode_ambulans' => 'AMB-02',
                'plat_nomor' => 'R 1722 TC',
                'jenis_ambulans' => 'Transport Medis / Pasien',
                'status' => 'Tersedia',
                'kapasitas_medis' => '1 Pasien + 2 Pendamping',
                'perlengkapan_medis' => 'Tabung Oksigen, Tandu Lipat, P3K Lengkap, Kursi Roda',
                'catatan' => 'Armada pengantaran pasien rutin dan kontrol RS',
            ],
            [
                'kode_ambulans' => 'AMB-03',
                'plat_nomor' => 'R 1554 BC',
                'jenis_ambulans' => 'Darurat & Jenazah',
                'status' => 'Tersedia',
                'kapasitas_medis' => '1 Jenazah / 1 Pasien',
                'perlengkapan_medis' => 'Keranda Stainless, Oksigen Darurat, P3K Dasar',
                'catatan' => 'Siaga wilayah Cilacap Timur dan sekitarnya',
            ],
        ];

        foreach ($ambulances as $amb) {
            Ambulans::updateOrCreate(['kode_ambulans' => $amb['kode_ambulans']], $amb);
        }
    }
}
