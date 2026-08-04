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
                'value' => 'Ambulance Siaga',
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
                'value' => 'info@ambulancesiaga.org',
                'type' => 'string',
                'description' => 'Email resmi pusat koordinasi Ambulance Siaga',
            ],
            [
                'key' => 'alamat_kantor',
                'value' => 'Pusat Koordinasi Layanan Ambulance Siaga',
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
                'value' => 'Ambulance Siaga adalah platform digital layanan darurat medis dan transportasi kemanusiaan yang terintegrasi dengan berbagai mitra penyedia ambulans, rumah sakit, dan lembaga kemanusiaan untuk melayani masyarakat secara gratis, cepat, dan profesional 24 Jam.',
                'type' => 'string',
                'description' => 'Deskripsi tentang sistem Ambulance Siaga',
            ],
        ];

        foreach ($settings as $setting) {
            SettingAplikasi::setVal($setting['key'], $setting['value'], $setting['type'], $setting['description']);
        }
    }
}
