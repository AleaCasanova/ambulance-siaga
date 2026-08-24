# LAPORAN KEGIATAN MINGGUAN MAGANG
**Proyek:** Sistem Informasi & Layanan Darurat Ambulans Siaga (Multi-Mitra)  
**Tahun:** 2026  
**Format:** Terpisah Per Role Developer (**Front-End** & **Back-End**)

---

# 📅 MINGGU KE-1 (3 Agustus – 7 Agustus 2026)

### 🎨 Form Detail Pekerjaan — FRONT-END DEVELOPER (Minggu 1)
**Minggu ke : 1 | Hari : Senin – Jumat | Tanggal : 3 Agustus – 7 Agustus | Tahun : 2026**

| No | Pekerjaan/Tugas | Uraian Pekerjaan | Gambar (Bukti Visual) | Keterangan |
|:--:|:----------------|:-----------------|:----------------------|:-----------|
| **1** | Slicing Master Layout & Setup Desain Sistem Tailwind | Menyiapkan master layout (`layouts/app.blade.php`), konfigurasi warna tema Ambulance Siaga dengan Tailwind CSS, komponen header navbar dinamis, dan footer responsif. | Screenshot master layout Blade & konfigurasi Tailwind | **Selesai** |
| **2** | Desain Formulir Pemesanan & Integrasi Peta Leaflet | Membangun antarmuka formulir pemesanan darurat (`order-create.blade.php`), integrasi peta Leaflet.js dengan pin marker penjemputan draggable, dan tombol kontrol zoom. | Screenshot UI form pemesanan & picker peta Leaflet | **Selesai** |
| **3** | Desain Antarmuka Login, Registrasi & Upload Foto Darurat | Membuat UI form login dan register multi-role, modal preview upload foto kondisi gawat darurat pasien, serta validasi visual error input form. | Screenshot halaman login/register & preview upload foto | **Selesai** |
| **4** | Desain Halaman Verifikasi OTP & Landing Page Awal | Mendesain form 6-digit input verifikasi kode OTP (`verify-otp.blade.php`) dengan styling countdown timer, serta layout awal halaman beranda publik. | Screenshot UI verifikasi OTP & halaman beranda awal | **Selesai** |
| **5** | Desain Antarmuka Halaman Donasi Publik | Membangun antarmuka halaman donasi (`donasi.blade.php`), kartu pilihan cepat nominal donasi (10k, 50k, 100k), dan form input data donatur. | Screenshot antarmuka halaman donasi publik | **Selesai** |

---

### ⚙️ Form Detail Pekerjaan — BACK-END DEVELOPER (Minggu 1)
**Minggu ke : 1 | Hari : Senin – Jumat | Tanggal : 3 Agustus – 7 Agustus | Tahun : 2026**

| No | Pekerjaan/Tugas | Uraian Pekerjaan | Gambar (Bukti Visual) | Keterangan |
|:--:|:----------------|:-----------------|:----------------------|:-----------|
| **1** | Inisialisasi Proyek Laravel & Arsitektur Database Dasar | Setup framework Laravel 11, konfigurasi database MySQL, pembuatan skema migrasi tabel dasar (`users`, `roles`, `masyarakat`, `supir`, `ambulans`, `rumah_sakit`), dan pemodelan relasi Eloquent. | Screenshot struktur migration database & konfigurasi `.env` | **Selesai** |
| **2** | Logika Penyimpanan Data Pemesanan & Geocoding Koordinat | Membuat Livewire Component `OrderCreate.php`, validasi input form pemesanan, penyimpanan koordinat latitude/longitude jemput, dan generator kode pemesanan otomatis. | Screenshot class `OrderCreate.php` & tabel `pemesanan` | **Selesai** |
| **3** | Logika Autentikasi Multi-Role & Upload File Berkas | Mengembangkan controller autentikasi login/register multi-role, middleware otorisasi hak akses, dan logic penyimpanan file foto kondisi gawat darurat ke local storage. | Screenshot controller auth & logic upload file | **Selesai** |
| **4** | Sistem Generator OTP & Pengiriman Email Notifikasi | Membuat migrasi tabel `otp_verifications`, logika pembuatan 6-digit OTP acak, verifikasi masa kedaluwarsa token, dan integrasi SMTP Laravel Mail. | Screenshot script controller OTP & log email notifikasi | **Selesai** |
| **5** | Logika Transaksi Donasi Awal & Sinkronisasi Repositori | Membuat model `Donasi`, logic create transaksi donasi status pending, pengujian alur order darurat, serta menangani merge conflict branch git tim. | Screenshot model `Donasi.php` & log git merge | **Selesai** |

---

# 📅 MINGGU KE-2 (10 Agustus – 14 Agustus 2026)

### 🎨 Form Detail Pekerjaan — FRONT-END DEVELOPER (Minggu 2)
**Minggu ke : 2 | Hari : Senin – Jumat | Tanggal : 10 Agustus – 14 Agustus | Tahun : 2026**

| No | Pekerjaan/Tugas | Uraian Pekerjaan | Gambar (Bukti Visual) | Keterangan |
|:--:|:----------------|:-----------------|:----------------------|:-----------|
| **1** | Pembaruan UI Navbar & Lonceng Notifikasi Dinamis | Merancang ulang komponen navigation bar dengan icon lonceng notifikasi dinamis (Alpine.js), menu aktif per role, dan penataan judul header. | Screenshot navbar notifikasi & menu navigasi per role | **Selesai** |
| **2** | Desain Ulang Hero Section & Tampilan Beranda Modern | Mengembangkan tampilan modern halaman Beranda (Hero section interaktif, badge status ambulans siaga 24 jam, kartu fitur, dan desain responsif mobile). | Screenshot tampilan baru Landing Page Beranda | **Selesai** |
| **3** | Pengembangan Landing Page Portal Supir & Mitra Lembaga | Membangun halaman informasi publik dan registrasi terpisah untuk supir ambulans (`register-supir.blade.php`) serta mitra lembaga (`register-mitra.blade.php`). | Screenshot portal supir dan portal mitra lembaga | **Selesai** |
| **4** | Desain Form Nominal Donasi & Komponen Payment Card | Merancang antarmuka pilihan metode pembayaran donasi, form pesan/doa donatur, dan tombol bayar donasi interaktif. | Screenshot form donasi & kartu pilihan pembayaran | **Selesai** |
| **5** | Integrasi Modal Checkout Midtrans Snap & Dashboard Mitra | Pemasangan script Midtrans Snap JS pada tombol bayar, popup checkout pembayaran multi-metode (QRIS, VA), dan tampilan awal dashboard mitra. | Screenshot modal Midtrans Snap checkout di browser | **Selesai** |

---

### ⚙️ Form Detail Pekerjaan — BACK-END DEVELOPER (Minggu 2)
**Minggu ke : 2 | Hari : Senin – Jumat | Tanggal : 10 Agustus – 14 Agustus | Tahun : 2026**

| No | Pekerjaan/Tugas | Uraian Pekerjaan | Gambar (Bukti Visual) | Keterangan |
|:--:|:----------------|:-----------------|:----------------------|:-----------|
| **1** | Refaktorisasi Sistem Role & Permission Multi-Level | Membuat migrasi refaktor 4 role resmi (Admin, Operator, Supir, Masyarakat), seeder data role, dan logic role-based redirection saat pengguna login. | Screenshot skema refaktor role di database & seeder | **Selesai** |
| **2** | Penyempurnaan Query Data Agregasi Beranda | Membuat query statistik dinamis pada halaman beranda (total armada siaga, total panggilan tertangani, dan daftar RS mitra rujukan). | Screenshot controller query agregasi data beranda | **Selesai** |
| **3** | Backend Pendaftaran Supir & Mitra Lembaga | Membuat controller `RegisteredSupirController.php` dan `RegisteredMitraController.php`, validasi form registrasi data lembaga, dan relasi mitra ke armada/driver. | Screenshot controller registrasi supir & mitra | **Selesai** |
| **4** | Perancangan Skema Database Donasi & Konfigurasi API Midtrans | Membuat migrasi tabel `donasis`, konfigurasi environment key Midtrans (Client Key & Server Key) pada `.env` dan `config/services.php`. | Screenshot migrasi tabel `donasis` & konfigurasi Midtrans | **Selesai** |
| **5** | Implementasi Midtrans Snap API & Webhook Handler | Membangun endpoint pembuatan Snap Token transaksi donasi, migrasi tabel `mitras`, serta webhook controller untuk auto-update status pembayaran donasi (settlement/expire). | Screenshot webhook controller & log transaksi Midtrans | **Selesai** |

---

# 📅 MINGGU KE-3 (17 Agustus – 21 Agustus 2026)

### 🎨 Form Detail Pekerjaan — FRONT-END DEVELOPER (Minggu 3)
**Minggu ke : 3 | Hari : Senin – Jumat | Tanggal : 17 Agustus – 21 Agustus | Tahun : 2026**

| No | Pekerjaan/Tugas | Uraian Pekerjaan | Gambar (Bukti Visual) | Keterangan |
|:--:|:----------------|:-----------------|:----------------------|:-----------|
| **1** | Desain Console Supir & Mobile Bottom Navigation Bar | Membangun antarmuka dashboard supir (`tugas-index.blade.php`) yang dioptimasi untuk layar smartphone dengan mobile bottom navigation bar. | Screenshot tampilan dashboard supir versi smartphone | **Selesai** |
| **2** | Desain Form Upload SIM/STNK & Badge Prioritas Order | Membuat komponen form upload berkas foto SIM & STNK supir, preview berkas, serta visualisasi badge status prioritas order (Gawat Darurat / Normal). | Screenshot form upload SIM/STNK & badge prioritas order | **Selesai** |
| **3** | Desain Antarmuka Dispatching Operator & Modal Penugasan | Merancang UI konsol dispatch operator (`order-index.blade.php`), modal interaktif pemilihan supir terdekat, dan filter status panggilan. | Screenshot konsol dispatching operator & modal assign | **Selesai** |
| **4** | Desain Antarmuka Live Tracking GPS Pasien & Supir | Membangun UI halaman tracking pasien (`order-tracking.blade.php`) dan supir (`order-show.blade.php`) dengan visualisasi polyline rute jalan dan animasi marker ambulans. | Screenshot live tracking peta pasien & rute jalan RS | **Selesai** |
| **5** | Desain Form Rating Ulasan Bintang & Kwitansi Donasi | Merancang modal rating bintang dan review feedback kepuasan layanan ambulans, serta halaman kwitansi digital bukti donasi online. | Screenshot form rating bintang ulasan & kwitansi donasi | **Selesai** |

---

### ⚙️ Form Detail Pekerjaan — BACK-END DEVELOPER (Minggu 3)
**Minggu ke : 3 | Hari : Senin – Jumat | Tanggal : 17 Agustus – 21 Agustus | Tahun : 2026**

| No | Pekerjaan/Tugas | Uraian Pekerjaan | Gambar (Bukti Visual) | Keterangan |
|:--:|:----------------|:-----------------|:----------------------|:-----------|
| **1** | Logika Penerimaan Tugas Supir & Status Perjalanan | Membuat logika penerimaan/penolakan order oleh supir, update status perjalanan (`menuju_lokasi`, `membawa_pasien`, `selesai`), dan event listener perubahan status. | Screenshot Livewire Supir `OrderShow.php` & status alur | **Selesai** |
| **2** | Backend Prioritas Darurat, Verifikasi SIM/STNK & Pagination | Menambahkan migrasi kolom prioritas pada tabel `pemesanan`, migrasi kolom `foto_sim` & `foto_stnk` pada tabel `supir`, dan optimalisasi pagination data order. | Screenshot file migrasi prioritas & validasi berkas | **Selesai** |
| **3** | Setup REST API Token (Sanctum) & Logika Dispatching | Konfigurasi Laravel Sanctum (`personal_access_tokens`), pembuatan service `PemesananService.php` untuk algoritma penugasan armada terdekat ke pasien. | Screenshot `PemesananService.php` & route Sanctum API | **Selesai** |
| **4** | Integrasi OSRM (Routing API), Estimasi ETA & Polling GPS | Menghubungkan API OSRM untuk kalkulasi jarak kilometer dan estimasi waktu tempuh (ETA), serta logika polling sinkronisasi koordinat GPS armada. | Screenshot fungsi kalkulasi rute OSRM & polling Livewire | **Selesai** |
| **5** | Backend Modul Rating Feedback & Kwitansi Transaksi | Membuat migrasi penyempurnaan tabel `ratings`, logika kalkulasi rata-rata kepuasan supir, dan query detail transaksi donasi untuk kwitansi digital. | Screenshot migrasi rating & controller kwitansi donasi | **Selesai** |

---

# 📅 MINGGU KE-4 (24 Agustus – 28 Agustus 2026)

### 🎨 Form Detail Pekerjaan — FRONT-END DEVELOPER (Minggu 4)
**Minggu ke : 4 | Hari : Senin – Jumat | Tanggal : 24 Agustus – 28 Agustus | Tahun : 2026**

| No | Pekerjaan/Tugas | Uraian Pekerjaan | Gambar (Bukti Visual) | Keterangan |
|:--:|:----------------|:-----------------|:----------------------|:-----------|
| **1** | Penyeragaman Visual Peta Leaflet & Interaktivitas Zoom | Menyeragamkan tile layer OpenStreetMap di seluruh role (Admin, Operator, Mitra, Supir, Pasien), mengaktifkan zoom scroll mouse pada Admin, dan memperbarui pin marker 3D. | Screenshot tampilan peta seragam di Admin, Operator, & Pasien | **Selesai** |
| **2** | Testing & Optimasi Responsivitas Antarmuka Seluruh Perangkat | Melakukan pengujian antarmuka UI di berbagai ukuran layar (Desktop, Tablet, Mobile) dan merapikan komponen modal popup serta navigasi. | Screenshot tampilan responsif mobile dan desktop | **Selesai** |

---

### ⚙️ Form Detail Pekerjaan — BACK-END DEVELOPER (Minggu 4)
**Minggu ke : 4 | Hari : Senin – Jumat | Tanggal : 24 Agustus – 28 Agustus | Tahun : 2026**

| No | Pekerjaan/Tugas | Uraian Pekerjaan | Gambar (Bukti Visual) | Keterangan |
|:--:|:----------------|:-----------------|:----------------------|:-----------|
| **1** | Optimasi Sinkronisasi Realtime Marker Status Armada | Memperbaiki logic pemetaan status operasional supir di Dashboard Admin (Emergency, On Duty, Available, Offline) dan sinkronisasi koordinat terakhir supir. | Screenshot query status supir di `Admin/Dashboard.php` | **Selesai** |
| **2** | Pengujian Alur Bisnis End-to-End & Audit Trail Log Aktivitas | Melakukan testing komprehensif alur pemesanan darurat (pasien -> operator -> supir -> selesai) serta verifikasi pencatatan riwayat aksi pada tabel `log_aktivitas`. | Screenshot log status pemesanan & tabel `log_aktivitas` | **Selesai** |
