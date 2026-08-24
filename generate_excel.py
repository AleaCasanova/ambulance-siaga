import sys

# Generate Excel XML (SpreadsheetML) which opens natively in Microsoft Excel with full styling
xml_content = """<?xml version="1.0" encoding="UTF-8"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Center"/>
   <Borders/>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="TitleStyle">
   <Font ss:FontName="Calibri" ss:Size="14" ss:Bold="1" ss:Color="#000000"/>
   <Alignment ss:Vertical="Center"/>
  </Style>
  <Style ss:ID="SubtitleStyle">
   <Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#1F497D"/>
   <Alignment ss:Vertical="Center"/>
  </Style>
  <Style ss:ID="HeaderStyle">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#FFFFFF"/>
   <Interior ss:Color="#2E75B6" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="CellNo">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
   </Borders>
   <Font ss:FontName="Calibri" ss:Size="10"/>
  </Style>
  <Style ss:ID="CellText">
   <Alignment ss:Horizontal="Left" ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
   </Borders>
   <Font ss:FontName="Calibri" ss:Size="10"/>
  </Style>
  <Style ss:ID="CellStatus">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D9D9D9"/>
   </Borders>
   <Font ss:FontName="Calibri" ss:Size="10" ss:Bold="1" ss:Color="#1E4620"/>
   <Interior ss:Color="#E2EFDA" ss:Pattern="Solid"/>
  </Style>
 </Styles>
"""

weeks_data = [
    {
        "week_num": "1",
        "title": "Minggu ke : 1 | Hari : Senin – Jumat | Tanggal : 3 Agustus – 7 Agustus | Tahun : 2026",
        "tasks": [
            (1, "Inisialisasi Lingkungan Proyek & Setup Basis Data Awal",
             "Melakukan inisialisasi framework Laravel 11, Livewire 3, Tailwind CSS, serta perancangan skema database dasar (users, roles, masyarakat, supir, ambulans, rumah_sakit).",
             "Screenshot struktur folder projek Laravel & daftar migrasi database",
             "Selesai (Environment & Database siap)"),
            (2, "Pembuatan Form Pemesanan Pasien & Integrasi Peta Awal",
             "Mengembangkan antarmuka pemesanan ambulans masyarakat (order-create), integrasi Leaflet.js untuk penentuan titik jemput pasien, dan migrasi pelengkap form pemesanan.",
             "Screenshot formulir pemesanan ambulans dan picker peta Leaflet",
             "Selesai (Form & pin lokasi berfungsi)"),
            (3, "Implementasi Modul Autentikasi & Registrasi Multi-Role",
             "Membangun alur login dan registrasi multi-role (Masyarakat, Supir, Mitra), serta penambahan fitur upload foto verifikasi kondisi darurat pasien.",
             "Screenshot halaman Login, Register, dan form pendaftaran armada",
             "Selesai (Autentikasi multi-role aktif)"),
            (4, "Pengembangan Sistem Verifikasi Email & OTP",
             "Mengintegrasikan sistem verifikasi akun berbasis OTP/Email (tabel otp_verifications), pembuatan template email kode OTP, dan perapian tampilan awal landing page.",
             "Screenshot form verifikasi kode OTP dan preview email notifikasi",
             "Selesai (Verifikasi OTP berfungsi)"),
            (5, "Inisiasi Modul Donasi & Sinkronisasi Kode Tim (Git Merge)",
             "Membangun antarmuka halaman donasi publik (donasi.blade.php), menyelesaikan resolusi konflik merge branch repository tim, dan pengujian alur order darurat tahap 1.",
             "Screenshot halaman donasi ambulans siaga & histori git merge",
             "Selesai (Modul donasi aktif & repo sinkron)")
        ]
    },
    {
        "week_num": "2",
        "title": "Minggu ke : 2 | Hari : Senin – Jumat | Tanggal : 10 Agustus – 14 Agustus | Tahun : 2026",
        "tasks": [
            (1, "Refaktor Sistem Role & Peningkatan Komponen Navbar",
             "Melakukan refaktor hak akses pengguna menjadi 4 role utama (Admin, Operator, Supir, Masyarakat), memperbaiki lonceng notifikasi dan tata letak judul header aplikasi.",
             "Screenshot navbar notifikasi & menu navigasi per role",
             "Selesai (Sistem role terstruktur)"),
            (2, "Desain Ulang Hero Section & Landing Page Beranda",
             "Mengembangkan tampilan visual modern pada halaman Beranda utama (Hero section interaktif, kartu keunggulan layanan darurat, dan layout responsif).",
             "Screenshot tampilan baru Landing Page Beranda",
             "Selesai (Landing page responsif & modern)"),
            (3, "Pengembangan Landing Page Portal Supir & Mitra Lembaga",
             "Menambahkan halaman landing page khusus informasi pendaftaran supir ambulans dan kemitraan lembaga, serta optimasi aset gambar ilustrasi.",
             "Screenshot portal supir dan portal kemitraan lembaga",
             "Selesai (Portal supir & mitra siap)"),
            (4, "Perancangan Skema Database Donasi & Midtrans Gateway",
             "Membuat migrasi tabel donasis, konfigurasi environment API Midtrans (Client Key & Server Key), dan penyiapan webhook handler status transaksi donasi.",
             "Screenshot skema tabel donasis dan form input donasi",
             "Selesai (Database & konfigurasi API siap)"),
            (5, "Integrasi Payment Gateway Midtrans & Manajemen Mitra",
             "Mengimplementasikan integrasi Midtrans Snap popup (QRIS, Bank Transfer, E-Wallet), migrasi tabel mitras, role Mitra lembaga, dan status alur 'menunggu_konfirmasi_supir'.",
             "Screenshot popup pembayaran Midtrans Snap & dashboard mitra",
             "Selesai (Transaksi donasi online berhasil)")
        ]
    },
    {
        "week_num": "3",
        "title": "Minggu ke : 3 | Hari : Senin – Jumat | Tanggal : 17 Agustus – 21 Agustus | Tahun : 2026",
        "tasks": [
            (1, "Pengembangan Portal Supir & Bottom Navigation Mobile",
             "Membangun dashboard kerja khusus supir (tugas-index.blade.php) dan sistem bottom navigation bar untuk mempermudah operasional supir di smartphone mobile.",
             "Screenshot dashboard supir & mobile bottom nav",
             "Selesai (Mobile console supir aktif)"),
            (2, "Penambahan Prioritas Pesanan & Berkas Kelayakan Supir",
             "Menambahkan fitur unggah berkas foto SIM & STNK pada verifikasi akun supir, kolom prioritas darurat (Gawat Darurat / Normal), serta pagination tabel pesanan.",
             "Screenshot form upload SIM/STNK & badge prioritas order",
             "Selesai (Verifikasi supir & triage darurat siap)"),
            (3, "Integrasi API Token & Sistem Dispatching Operator",
             "Setup Laravel Sanctum untuk REST API token perangkat GPS dan penguatan konsol dispatch operator untuk penugasan armada ambulans terdekat.",
             "Screenshot konsol dispatching operator & route API",
             "Selesai (API & dispatch console aktif)"),
            (4, "Optimalisasi Real-time Tracking GPS & Rute OSRM",
             "Mengembangkan pelacakan posisi ambulans secara langsung (Livewire polling), kalkulasi rute OSRM dengan garis polyline, dan estimasi waktu sampai (ETA).",
             "Screenshot halaman tracking live ambulans & rute jalan",
             "Selesai (Live tracking & kalkulasi ETA aktif)"),
            (5, "Penyempurnaan Modul Ulasan (Rating) & Kwitansi Donasi",
             "Migrasi penyempurnaan tabel ratings untuk feedback masyarakat, halaman kwitansi bukti donasi sukses, dan perbaikan tampilan rincian pesanan.",
             "Screenshot form rating bintang ulasan & kwitansi donasi",
             "Selesai (Modul rating & kwitansi selesai)")
        ]
    },
    {
        "week_num": "4",
        "title": "Minggu ke : 4 | Hari : Senin – Jumat | Tanggal : 24 Agustus – 28 Agustus | Tahun : 2026",
        "tasks": [
            (1, "Penyeragaman & Optimalisasi Peta Leaflet Seluruh Role",
             "Menyeragamkan tile layer Leaflet OpenStreetMap di semua role (Admin, Operator, Mitra, Supir, Pasien), mengaktifkan zoom mouse wheel di Admin, dan memperbaiki akurasi warna pin marker status armada.",
             "Screenshot tampilan peta seragam di Admin, Operator, & Pasien",
             "Selesai (Peta seragam, zoom interaktif, & pin 3D rapi)"),
            (2, "Pengujian Alur End-to-End Pemesanan & Navigasi Ambulans",
             "Melakukan testing terpadu mulai dari pasien membuat pesanan darurat, notifikasi operator, assign supir, navigasi supir ke lokasi, hingga update status selesai.",
             "Screenshot alur status perjalanan ambulans dari order hingga selesai",
             "Selesai (Alur end-to-end terverifikasi)")
        ]
    }
]

for w in weeks_data:
    xml_content += f""" <Worksheet ss:Name="Minggu {w['week_num']}">
  <Table ss:DefaultRowHeight="20">
   <Column ss:Width="35"/>
   <Column ss:Width="200"/>
   <Column ss:Width="380"/>
   <Column ss:Width="240"/>
   <Column ss:Width="160"/>
   <Row ss:Height="25">
    <Cell ss:StyleID="TitleStyle"><Data ss:Type="String">Form Detail Pekerjaan</Data></Cell>
   </Row>
   <Row ss:Height="20">
    <Cell ss:StyleID="SubtitleStyle"><Data ss:Type="String">{w['title']}</Data></Cell>
   </Row>
   <Row ss:Height="10"></Row>
   <Row ss:Height="28">
    <Cell ss:StyleID="HeaderStyle"><Data ss:Type="String">No</Data></Cell>
    <Cell ss:StyleID="HeaderStyle"><Data ss:Type="String">Pekerjaan/Tugas</Data></Cell>
    <Cell ss:StyleID="HeaderStyle"><Data ss:Type="String">Uraian Pekerjaan</Data></Cell>
    <Cell ss:StyleID="HeaderStyle"><Data ss:Type="String">Gambar</Data></Cell>
    <Cell ss:StyleID="HeaderStyle"><Data ss:Type="String">Keterangan</Data></Cell>
   </Row>
"""
    for task in w['tasks']:
        no, name, desc, img, status = task
        xml_content += f"""   <Row ss:Height="48">
    <Cell ss:StyleID="CellNo"><Data ss:Type="Number">{no}</Data></Cell>
    <Cell ss:StyleID="CellText"><Data ss:Type="String">{name}</Data></Cell>
    <Cell ss:StyleID="CellText"><Data ss:Type="String">{desc}</Data></Cell>
    <Cell ss:StyleID="CellText"><Data ss:Type="String">{img}</Data></Cell>
    <Cell ss:StyleID="CellStatus"><Data ss:Type="String">{status}</Data></Cell>
   </Row>
"""
    xml_content += """  </Table>
 </Worksheet>
"""

xml_content += "</Workbook>"

with open("laporan_mingguan_magang.xls", "w", encoding="utf-8") as f:
    f.write(xml_content)

print("Excel XML file generated successfully as laporan_mingguan_magang.xls")
