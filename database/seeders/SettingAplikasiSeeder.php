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
                'value' => 'Yayasan Gerak Sedekah Cilacap (GSC)',
                'type' => 'string',
                'description' => 'Nama resmi yayasan penyedia layanan ambulans',
            ],
            [
                'key' => 'telepon_darurat',
                'value' => '0812-3456-7890',
                'type' => 'string',
                'description' => 'Nomor telepon darurat siaga 24 jam GSC',
            ],
            [
                'key' => 'email_organisasi',
                'value' => 'info@gsc-cilacap.org',
                'type' => 'string',
                'description' => 'Email resmi yayasan',
            ],
            [
                'key' => 'alamat_kantor',
                'value' => 'Jl. Raya Cilacap No. 10, Sidanegara, Cilacap Tengah, Jawa Tengah',
                'type' => 'string',
                'description' => 'Alamat markas operasional ambulans GSC',
            ],
            [
                'key' => 'default_lat',
                'value' => '-7.7188',
                'type' => 'string',
                'description' => 'Latitude default pusat Kabupaten Cilacap',
            ],
            [
                'key' => 'default_lng',
                'value' => '109.0159',
                'type' => 'string',
                'description' => 'Longitude default pusat Kabupaten Cilacap',
            ],
            [
                'key' => 'jam_operasional',
                'value' => '24 Jam Siaga Darurat',
                'type' => 'string',
                'description' => 'Jam kerja layanan ambulans',
            ],
            [
                'key' => 'tentang_gsc',
                'value' => 'Yayasan Gerak Sedekah Cilacap (GSC) adalah organisasi sosial kemanusiaan non-profit yang berdedikasi melayani masyarakat Cilacap dalam kondisi darurat medis dan transportasi kemanusiaan secara gratis dan profesional.',
                'type' => 'string',
                'description' => 'Deskripsi singkat tentang Yayasan Gerak Sedekah Cilacap',
            ],
        ];

        foreach ($settings as $setting) {
            SettingAplikasi::setVal($setting['key'], $setting['value'], $setting['type'], $setting['description']);
        }
    }
}
