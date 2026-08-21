<?php

namespace Database\Seeders;

use App\Models\SettingAplikasi;
use Illuminate\Database\Seeder;

class SettingAplikasiSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'nama_organisasi',
                'value' => 'Ambulans Siaga',
                'type' => 'string',
                'description' => 'Nama sistem platform layanan ambulans multi-mitra',
            ],
            [
                'key' => 'telepon_darurat',
                'value' => '0812-3456-7890',
                'type' => 'string',
                'description' => 'Nomor telepon hotline darurat siaga 24 jam',
            ],
            [
                'key' => 'email_organisasi',
                'value' => 'info@ambulansiaga.org',
                'type' => 'string',
                'description' => 'Email resmi pusat koordinasi Ambulans Siaga',
            ],
            [
                'key' => 'alamat_kantor',
                'value' => 'Pusat Koordinasi Layanan Ambulans Siaga',
                'type' => 'string',
                'description' => 'Alamat pusat koordinasi operasional ambulans',
            ],
            [
                'key' => 'default_lat',
                'value' => '-7.7188',
                'type' => 'string',
                'description' => 'Latitude default pusat layanan darurat',
            ],
            [
                'key' => 'default_lng',
                'value' => '109.0159',
                'type' => 'string',
                'description' => 'Longitude default pusat layanan darurat',
            ],
            [
                'key' => 'jam_operasional',
                'value' => '24 Jam Siaga Darurat',
                'type' => 'string',
                'description' => 'Jam operasional layanan ambulans mitra',
            ],
            [
                'key' => 'tentang_gsc',
                'value' => 'Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis, rujukan, dan gawat darurat secara cepat dan transparan.',
                'type' => 'string',
                'description' => 'Deskripsi tentang sistem Ambulans Siaga',
            ],
        ];

        foreach ($settings as $setting) {
            SettingAplikasi::setVal($setting['key'], $setting['value'], $setting['type'], $setting['description']);
        }
    }
}
