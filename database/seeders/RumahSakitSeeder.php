<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Seeder;

class RumahSakitSeeder extends Seeder
{
    public function run(): void
    {
        $hospitals = [
            // ==========================================
            // RUMAH SAKIT UMUM & KHUSUS KABUPATEN CILACAP
            // (Data Resmi Kemenkes RI & Dinkes Kab. Cilacap)
            // ==========================================
            [
                'nama' => 'RSUD Cilacap',
                'alamat' => 'Jl. Gatot Subroto No.28, Sidanegara, Kec. Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah 53223',
                'telepon' => '(0282) 533010',
                'lat' => -7.7173197,
                'lng' => 109.0158343,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RSUD Majenang',
                'alamat' => 'Jl. Dr. Soetomo No.54, Jenang, Kec. Majenang, Kabupaten Cilacap, Jawa Tengah 53257',
                'telepon' => '(0280) 621012',
                'lat' => -7.2957386,
                'lng' => 108.7598624,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Pertamina Cilacap',
                'alamat' => 'Jl. Setiabudi No.1, Kemiren, Tegalkamulyan, Kec. Cilacap Selatan, Kabupaten Cilacap, Jawa Tengah 53231',
                'telepon' => '(0282) 509955',
                'lat' => -7.7023280,
                'lng' => 109.0455210,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RSI Fatimah Cilacap',
                'alamat' => 'Jl. Ir. H. Juanda No.20, Kebonmanis, Kec. Cilacap Utara, Kabupaten Cilacap, Jawa Tengah 53235',
                'telepon' => '(0282) 542396',
                'lat' => -7.6920580,
                'lng' => 109.0249030,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Santa Maria Cilacap',
                'alamat' => 'Jl. Jend. Ahmad Yani No.38, Sidakaya, Kec. Cilacap Selatan, Kabupaten Cilacap, Jawa Tengah 53212',
                'telepon' => '(0282) 534859',
                'lat' => -7.7357202,
                'lng' => 109.0100203,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Priscilla Medical Center',/*  */
                'alamat' => 'Jl. Raya Maos - Sampang, Karangtengah, Kec. Sampang, Kabupaten Cilacap, Jawa Tengah 53273',
                'telepon' => '(0282) 6181488',
                'lat' => -7.5700029,
                'lng' => 109.2153271,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Umum PKU Muhammadiyah Aghisna Kroya',
                'alamat' => 'Jl. Yos Sudarso No.1, Kalisari, Karangmangu, Kec. Kroya, Kabupaten Cilacap, Jawa Tengah 53282',
                'telepon' => '(0282) 492260',
                'lat' => -7.6369350,
                'lng' => 109.2489280,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Umum Aghisna Medika Sidareja',
                'alamat' => 'Jl. Jenderal Sudirman No.1, Sidamulya, Kec. Sidareja, Kabupaten Cilacap, Jawa Tengah 53261',
                'telepon' => '(0280) 523300',
                'lat' => -7.4851480,
                'lng' => 108.7998022,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Umum Aprillia Cilacap',
                'alamat' => 'Jl. Jend. Gatot Subroto No.95, Sidanegara, Kec. Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah 53212',
                'telepon' => '(0282) 536307',
                'lat' => -7.7124350,
                'lng' => 109.0168580,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Umum Raffa Majenang',
                'alamat' => 'Jl. Bhayangkara No.69, Jenang, Kec. Majenang, Kabupaten Cilacap, Jawa Tengah 53257',
                'telepon' => '(0280) 6260269',
                'lat' => -7.3006514,
                'lng' => 108.7561700,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Umum Duta Mulya Majenang',
                'alamat' => 'Jl. Dr. Wahidin No.66A, Sindangsari, Kec. Majenang, Kabupaten Cilacap, Jawa Tengah 53257',
                'telepon' => '(0280) 621434',
                'lat' => -7.2960397,
                'lng' => 108.7680377,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RS Umum Afdila Cilacap',
                'alamat' => 'Jl. Soekarno-Hatta No.79, Rejasari, Menganti, Kec. Kesugihan, Kabupaten Cilacap, Jawa Tengah 53274',
                'telepon' => '(0282) 542749',
                'lat' => -7.6691670,
                'lng' => 109.0725000,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],
            [
                'nama' => 'RSIA Annisa Cilacap',
                'alamat' => 'Jl. Gatot Subroto No.31A, Sidanegara, Kec. Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah 53223',
                'telepon' => '(0282) 5252885',
                'lat' => -7.7167160,
                'lng' => 109.0147000,
                'kapasitas_igd' => 'Tersedia (IGD 24 Jam)',
            ],

            // ==========================================
            // RUMAH SAKIT MILITER & KLINIK RAWAT INAP DARURAT
            // ==========================================
            [
                'nama' => 'Rumkitban 04.08.01 Cilacap (TNI AD)',
                'alamat' => 'Jl. Brigjen Katamso No.1, Sidanegara, Kec. Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah 53223',
                'telepon' => '(0282) 534125',
                'lat' => -7.7271326,
                'lng' => 109.0110091,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam)',
            ],
            [
                'nama' => 'Balai Kesehatan TNI AL (Lanal) Cilacap',
                'alamat' => 'Jl. Mayor Jenderal Wiratno No.1, Tegalreja, Kec. Cilacap Selatan, Kabupaten Cilacap, Jawa Tengah 53213',
                'telepon' => '(0282) 534343',
                'lat' => -7.7308963,
                'lng' => 109.0034960,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam)',
            ],
            [
                'nama' => 'Klinik Pratama Rawat Inap PMI Cilacap',
                'alamat' => 'Jl. Raya Slarang KM 12, Slarang, Kec. Kesugihan, Kabupaten Cilacap, Jawa Tengah 53274',
                'telepon' => '(0282) 5253814',
                'lat' => -7.6582450,
                'lng' => 109.0791200,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam)',
            ],
            [
                'nama' => 'Klinik Utama Amalia Bunda Medika',
                'alamat' => 'Jl. Dr. Rajiman No.44, Kebonmanis, Kec. Cilacap Utara, Kabupaten Cilacap, Jawa Tengah 53235',
                'telepon' => '(0282) 548900',
                'lat' => -7.6912300,
                'lng' => 109.0321500,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam)',
            ],
            [
                'nama' => 'Klinik Rawat Inap PKU Muhammadiyah Kroya',
                'alamat' => 'Jl. Raya Mujur No.15, Mujur Lor, Kec. Kroya, Kabupaten Cilacap, Jawa Tengah 53282',
                'telepon' => '(0282) 492118',
                'lat' => -7.6251200,
                'lng' => 109.2554300,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam)',
            ],

            // ==========================================
            // PUSKESMAS DTP RAWAT INAP & UGD 24 JAM WILAYAH CILACAP
            // (Titik Rujukan Darurat Wilayah Kecamatan)
            // ==========================================
            [
                'nama' => 'Puskesmas Rawat Inap Gandrungmangu I',
                'alamat' => 'Jl. Raya Gandrungmangu No.154, Kec. Gandrungmangu, Kabupaten Cilacap, Jawa Tengah 53254',
                'telepon' => '(0280) 5260118',
                'lat' => -7.5181959,
                'lng' => 108.8439345,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Cipari',
                'alamat' => 'Jl. Raya Cipari No.32, Kec. Cipari, Kabupaten Cilacap, Jawa Tengah 53261',
                'telepon' => '(0280) 6261118',
                'lat' => -7.4388000,
                'lng' => 108.7599999,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Sidareja',
                'alamat' => 'Jl. Yos Sudarso No.1, Sidamulya, Kec. Sidareja, Kabupaten Cilacap, Jawa Tengah 53261',
                'telepon' => '(0280) 523118',
                'lat' => -7.4869843,
                'lng' => 108.7914075,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Majenang I',
                'alamat' => 'Jl. Raya Ciguling No.15, Cilopadang, Kec. Majenang, Kabupaten Cilacap, Jawa Tengah 53257',
                'telepon' => '(0280) 621118',
                'lat' => -7.3052214,
                'lng' => 108.7923341,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Kedungreja',
                'alamat' => 'Jl. Raya Tambaksari, Cidanau, Kec. Kedungreja, Kabupaten Cilacap, Jawa Tengah 53263',
                'telepon' => '(0280) 524118',
                'lat' => -7.5169125,
                'lng' => 108.7763893,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Kawunganten',
                'alamat' => 'Jl. Raya Kawunganten No.25, Kec. Kawunganten, Kabupaten Cilacap, Jawa Tengah 53253',
                'telepon' => '(0280) 625118',
                'lat' => -7.5920288,
                'lng' => 108.9181281,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Karangpucung I',
                'alamat' => 'Jl. Raya Karangpucung - Majenang, Kec. Karangpucung, Kabupaten Cilacap, Jawa Tengah 53255',
                'telepon' => '(0280) 6263118',
                'lat' => -7.4097539,
                'lng' => 108.8999987,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Wanareja I',
                'alamat' => 'Jl. Raya Cilacap - Ciamis No.45, Kec. Wanareja, Kabupaten Cilacap, Jawa Tengah 53265',
                'telepon' => '(0280) 6264118',
                'lat' => -7.3389765,
                'lng' => 108.7015185,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Dayeuhluhur I',
                'alamat' => 'Jl. Prawiranegara No.1, Kec. Dayeuhluhur, Kabupaten Cilacap, Jawa Tengah 53266',
                'telepon' => '(0280) 6265118',
                'lat' => -7.2592301,
                'lng' => 108.6108184,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Adipala I',
                'alamat' => 'Jl. Raya Adipala - Kroya, Adipala, Kec. Adipala, Kabupaten Cilacap, Jawa Tengah 53271',
                'telepon' => '(0282) 377118',
                'lat' => -7.6589571,
                'lng' => 109.1474692,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Nusawungu I',
                'alamat' => 'Jl. Perintis Kemerdekaan, Danasri Lor, Kec. Nusawungu, Kabupaten Cilacap, Jawa Tengah 53283',
                'telepon' => '(0282) 5500118',
                'lat' => -7.6487763,
                'lng' => 109.3441088,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
            [
                'nama' => 'Puskesmas Rawat Inap Bantarsari',
                'alamat' => 'Jl. Raya Bantarsari, Rawajaya, Kec. Bantarsari, Kabupaten Cilacap, Jawa Tengah 53281',
                'telepon' => '(0280) 6262118',
                'lat' => -7.5772028,
                'lng' => 108.8662182,
                'kapasitas_igd' => 'Tersedia (UGD 24 Jam & Rawat Inap)',
            ],
        ];

        foreach ($hospitals as $rs) {
            RumahSakit::updateOrCreate(['nama' => $rs['nama']], $rs);
        }
    }
}
