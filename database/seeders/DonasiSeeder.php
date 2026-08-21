<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donasi;
use App\Models\Rating;
use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Supir;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donasis = [
            [
                'nama' => 'Hamba Allah',
                'is_anonim' => true,
                'email' => 'hambaallah@gmail.com',
                'whatsapp' => '081234567890',
                'pesan' => 'Semoga Allah membalas kebaikan para relawan dan supir ambulans yang siaga 24 jam.',
                'nominal' => 100000,
                'status' => 'success',
                'created_at' => now()->subMinutes(15),
            ],
            [
                'nama' => 'Bapak Budi Santoso',
                'is_anonim' => false,
                'email' => 'budi.santoso@yahoo.com',
                'whatsapp' => '082198765432',
                'pesan' => 'Semoga program operasional ambulans siaga ini terus berjalan lancar dan berkah.',
                'nominal' => 250000,
                'status' => 'success',
                'created_at' => now()->subHours(1),
            ],
            [
                'nama' => 'Ibu Siti Nurhaliza',
                'is_anonim' => false,
                'email' => 'siti.nur@gmail.com',
                'whatsapp' => '085712345678',
                'pesan' => 'Terima kasih atas bantuan evakuasi keluarga kami minggu lalu, sangat terbantu.',
                'nominal' => 500000,
                'status' => 'success',
                'created_at' => now()->subHours(3),
            ],
            [
                'nama' => 'Hamba Allah',
                'is_anonim' => true,
                'email' => 'donatur.ikhlas@gmail.com',
                'whatsapp' => '081399887766',
                'pesan' => 'Aamiin yarabbal alamin, berkah untuk semua penerima manfaat.',
                'nominal' => 50000,
                'status' => 'success',
                'created_at' => now()->subHours(5),
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'is_anonim' => false,
                'email' => 'ahmad.fauzi@outlook.com',
                'whatsapp' => '087811223344',
                'pesan' => 'Sehat selalu untuk seluruh kru ambulans dan paramedis yang bertugas di lapangan.',
                'nominal' => 150000,
                'status' => 'success',
                'created_at' => now()->subHours(8),
            ],
            [
                'nama' => 'Ibu Fitri Handayani',
                'is_anonim' => false,
                'email' => 'fitri.h@gmail.com',
                'whatsapp' => '089655443322',
                'pesan' => 'Semoga semakin banyak armada yang siap siaga membantu warga.',
                'nominal' => 200000,
                'status' => 'success',
                'created_at' => now()->subDay(),
            ],
            [
                'nama' => 'Hamba Allah',
                'is_anonim' => true,
                'email' => 'donatur@gmail.com',
                'whatsapp' => '081255667788',
                'pesan' => 'Bismillah, titipan rezeki untuk bahan bakar ambulans gratis.',
                'nominal' => 75000,
                'status' => 'success',
                'created_at' => now()->subDays(2),
            ],
        ];

        foreach ($donasis as $item) {
            Donasi::create($item);
        }

        // Add additional ratings if needed
        $pesanan = Pemesanan::where('status', 'selesai')->first();
        $user = User::whereHas('role', function($q) { $q->where('name', 'masyarakat'); })->first();
        $supir = Supir::first();

        if ($pesanan && $user && $supir) {
            $sampleReviews = [
                [
                    'skor' => 5,
                    'ulasan' => 'Alhamdulillah, sangat terbantu saat ibu saya harus dirujuk ke RSUD malam hari. Responnya sangat cepat dan tim relawannya ramah. Gratis tanpa dipungut biaya apapun.',
                ],
                [
                    'skor' => 5,
                    'ulasan' => 'Driver ambulans sangat cekatan dan profesional. Tiba di lokasi penjemputan kurang dari 15 menit. Peralatan di dalam mobil juga lengkap.',
                ],
                [
                    'skor' => 5,
                    'ulasan' => 'Pelayanan ramah, sopan, dan transparan. Terima kasih Ambulans Siaga sudah membantu mengantar kakek kami cuci darah tepat waktu.',
                ]
            ];

            foreach ($sampleReviews as $rev) {
                Rating::firstOrCreate(
                    [
                        'ulasan' => $rev['ulasan']
                    ],
                    [
                        'pemesanan_id' => $pesanan->id,
                        'user_id' => $user->id,
                        'supir_id' => $supir->id,
                        'skor' => $rev['skor'],
                    ]
                );
            }
        }
    }
}
