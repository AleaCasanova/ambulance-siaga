<?php

namespace Database\Seeders;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\Rating;
use App\Models\RumahSakit;
use App\Models\StatusPerjalanan;
use App\Models\Supir;
use App\Models\TrackingGps;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        $masyarakatUser = User::where('email', 'masyarakat@ambulancesiaga.org')->first();
        $budiUser = User::where('email', 'budi@gmail.com')->first();
        $dispatcherUser = User::where('email', 'dispatcher@ambulancesiaga.org')->first();
        $supir1 = Supir::whereHas('user', fn($q) => $q->where('email', 'supir1@ambulancesiaga.org'))->first();
        $supir2 = Supir::whereHas('user', fn($q) => $q->where('email', 'supir2@ambulancesiaga.org'))->first();
        $amb1 = Ambulans::where('kode_ambulans', 'AMB-01')->first();
        $amb2 = Ambulans::where('kode_ambulans', 'AMB-02')->first();
        $rs1 = RumahSakit::where('nama', 'RSUD Cilacap')->first();
        $rs2 = RumahSakit::where('nama', 'RS Pertamina Cilacap')->first();

        if (!$masyarakatUser || !$supir1 || !$amb1 || !$rs1) {
            return;
        }

        // 1. Order Selesai
        $order1 = Pemesanan::create([
            'kode_order' => 'AMB-ORD-20260726-001',
            'user_id' => $masyarakatUser->id,
            'supir_id' => $supir1->id,
            'ambulans_id' => $amb1->id,
            'rumah_sakit_id' => $rs1->id,
            'dispatcher_id' => $dispatcherUser?->id,
            'nama_pasien' => 'Kakek Hartono',
            'nik_pasien' => '3301015006900001',
            'usia_pasien' => '68 Tahun',
            'diagnosa_medis' => 'Sesak Napas Berat & Hipertensi',
            'kondisi_pasien' => 'Sesak nafas darurat butuh bantuan oksigen dan penanganan IGD segera',
            'lokasi_jemput' => 'Jl. Gatot Subroto No. 45, Sidanegara, Cilacap Tengah',
            'jemput_lat' => -7.7188,
            'jemput_lng' => 109.0159,
            'tujuan_lokasi' => $rs1->nama . ' - ' . $rs1->alamat,
            'tujuan_lat' => $rs1->lat,
            'tujuan_lng' => $rs1->lng,
            'tanggal_jemput' => Carbon::now()->subHours(5)->format('Y-m-d'),
            'jam_jemput' => '14:30',
            'jumlah_pendamping' => 2,
            'no_hp_kontak' => '081987654321',
            'keperluan_penggunaan' => 'IGD Darurat',
            'status' => 'selesai',
            'catatan_tambahan' => 'Tolong bawa tabung oksigen penuh',
            'waktu_pesan' => Carbon::now()->subHours(5),
            'waktu_respon' => Carbon::now()->subHours(5)->addMinutes(3),
            'waktu_jemput' => Carbon::now()->subHours(4)->addMinutes(45),
            'waktu_selesai' => Carbon::now()->subHours(4),
        ]);

        StatusPerjalanan::create([
            'pemesanan_id' => $order1->id,
            'status' => 'menunggu',
            'keterangan' => 'Pesanan baru diterima dari masyarakat',
            'created_by' => $masyarakatUser->id,
            'created_at' => Carbon::now()->subHours(5),
        ]);
        StatusPerjalanan::create([
            'pemesanan_id' => $order1->id,
            'status' => 'diproses',
            'keterangan' => 'Dispatcher menugaskan Ambulans AMB-01 dan Supir Ahmad Supriyadi',
            'created_by' => $dispatcherUser?->id,
            'created_at' => Carbon::now()->subHours(5)->addMinutes(3),
        ]);
        StatusPerjalanan::create([
            'pemesanan_id' => $order1->id,
            'status' => 'menuju_lokasi',
            'keterangan' => 'Supir berangkat menuju lokasi jemput pasien',
            'created_by' => $supir1->user_id,
            'created_at' => Carbon::now()->subHours(5)->addMinutes(5),
        ]);
        StatusPerjalanan::create([
            'pemesanan_id' => $order1->id,
            'status' => 'membawa_pasien',
            'keterangan' => 'Pasien berhasil dijembat dan dalam perjalanan menuju RSUD Cilacap',
            'created_by' => $supir1->user_id,
            'created_at' => Carbon::now()->subHours(4)->addMinutes(45),
        ]);
        StatusPerjalanan::create([
            'pemesanan_id' => $order1->id,
            'status' => 'selesai',
            'keterangan' => 'Pasien telah tiba di IGD RSUD Cilacap dan ditangani tim medis',
            'created_by' => $supir1->user_id,
            'created_at' => Carbon::now()->subHours(4),
        ]);

        Rating::create([
            'pemesanan_id' => $order1->id,
            'user_id' => $masyarakatUser->id,
            'supir_id' => $supir1->id,
            'skor' => 5,
            'ulasan' => 'Alhamdulillah pelayanan Ambulance Siaga sangat cepat dan gratis. Supir ramah serta sabar membantu kakek kami. Semoga berkah selalu!',
        ]);

        // 2. Order Aktif (menuju_lokasi / membawa_pasien) - Untuk uji coba Realtime Tracking Map
        $order2 = Pemesanan::create([
            'kode_order' => 'AMB-ORD-' . date('Ymd') . '-002',
            'user_id' => $masyarakatUser->id,
            'supir_id' => $supir1->id,
            'ambulans_id' => $amb1->id,
            'rumah_sakit_id' => $rs2->id,
            'dispatcher_id' => $dispatcherUser?->id,
            'nama_pasien' => 'Ibu Halimah',
            'nik_pasien' => '3301021203850009',
            'usia_pasien' => '54 Tahun',
            'diagnosa_medis' => 'Serangan Jantung / Angina Pektoris',
            'kondisi_pasien' => 'Kecepatan tinggi kritis, perlu evakuasi segera ke RS Pertamina',
            'lokasi_jemput' => 'Jl. S. Parman No. 12, Cilacap Tengah',
            'jemput_lat' => -7.7210,
            'jemput_lng' => 109.0120,
            'tujuan_lokasi' => $rs2->nama . ' - ' . $rs2->alamat,
            'tujuan_lat' => $rs2->lat,
            'tujuan_lng' => $rs2->lng,
            'tanggal_jemput' => Carbon::today()->format('Y-m-d'),
            'jam_jemput' => Carbon::now()->format('H:i'),
            'jumlah_pendamping' => 1,
            'no_hp_kontak' => '081234560006',
            'keperluan_penggunaan' => 'IGD Darurat',
            'status' => 'menuju_lokasi',
            'catatan_tambahan' => 'Gerbang rumah warna hitam samping warung',
            'waktu_pesan' => Carbon::now()->subMinutes(15),
            'waktu_respon' => Carbon::now()->subMinutes(12),
        ]);

        // Ubah status ambulans ke Ditugaskan
        $amb1->update(['status' => 'Ditugaskan']);

        StatusPerjalanan::create([
            'pemesanan_id' => $order2->id,
            'status' => 'menunggu',
            'keterangan' => 'Pesanan masuk dari masyarakat',
            'created_by' => $masyarakatUser->id,
            'created_at' => Carbon::now()->subMinutes(15),
        ]);
        StatusPerjalanan::create([
            'pemesanan_id' => $order2->id,
            'status' => 'diproses',
            'keterangan' => 'Dispatcher menugaskan AMB-01 (Ahmad Supriyadi)',
            'created_by' => $dispatcherUser?->id,
            'created_at' => Carbon::now()->subMinutes(12),
        ]);
        StatusPerjalanan::create([
            'pemesanan_id' => $order2->id,
            'status' => 'menuju_lokasi',
            'keterangan' => 'Supir sedang dalam perjalanan menuju lokasi jemput',
            'created_by' => $supir1->user_id,
            'created_at' => Carbon::now()->subMinutes(10),
        ]);

        // Log GPS untuk simulasi pergerakan dari lokasi awal supir ke dekat lokasi jemput
        $gpsPoints = [
            ['lat' => -7.7188, 'lng' => 109.0159, 'speed' => 35],
            ['lat' => -7.7195, 'lng' => 109.0148, 'speed' => 40],
            ['lat' => -7.7202, 'lng' => 109.0135, 'speed' => 38],
            ['lat' => -7.7207, 'lng' => 109.0126, 'speed' => 30],
        ];

        foreach ($gpsPoints as $idx => $pt) {
            TrackingGps::create([
                'pemesanan_id' => $order2->id,
                'supir_id' => $supir1->id,
                'lat' => $pt['lat'],
                'lng' => $pt['lng'],
                'kecepatan' => $pt['speed'],
                'heading' => 220,
                'recorded_at' => Carbon::now()->subMinutes(8 - ($idx * 2)),
            ]);
        }

        // 3. Order Baru (menunggu dispatcher)
        if ($budiUser) {
            Pemesanan::create([
                'kode_order' => 'AMB-ORD-' . date('Ymd') . '-003',
                'user_id' => $budiUser->id,
                'supir_id' => null,
                'ambulans_id' => null,
                'rumah_sakit_id' => $rs1->id,
                'dispatcher_id' => null,
                'nama_pasien' => 'Rizki Aditya',
                'nik_pasien' => '3301031112000003',
                'usia_pasien' => '23 Tahun',
                'diagnosa_medis' => 'Trauma Kaki Luka Robek Akibat KLL',
                'kondisi_pasien' => 'Kecelakaan lalu lintas ringan di dekat Taman Zehner, luka robek di kaki',
                'lokasi_jemput' => 'Jl. Letjen Suprapto depan Taman Zehner, Kebonmanis, Cilacap Utara',
                'jemput_lat' => -7.7050,
                'jemput_lng' => 109.0350,
                'tujuan_lokasi' => $rs1->nama . ' - ' . $rs1->alamat,
                'tujuan_lat' => $rs1->lat,
                'tujuan_lng' => $rs1->lng,
                'tanggal_jemput' => Carbon::today()->format('Y-m-d'),
                'jam_jemput' => Carbon::now()->format('H:i'),
                'jumlah_pendamping' => 1,
                'no_hp_kontak' => '081234560007',
                'keperluan_penggunaan' => 'IGD Darurat',
                'status' => 'menunggu',
                'catatan_tambahan' => 'Korban sadar, butuh angkutan aman ke IGD',
                'waktu_pesan' => Carbon::now()->subMinutes(5),
            ]);
        }
    }
}
