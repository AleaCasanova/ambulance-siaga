<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemesanan Ambulans - Ambulans Siaga</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 8.5px;
            color: #1e293b;
            background: #ffffff;
            padding: 15px 20px;
        }

        /* ====== KOP SURAT RESMI ====== */
        .kop-surat {
            border-bottom: 2.5px solid #0f172a;
            padding-bottom: 8px;
            margin-bottom: 12px;
            position: relative;
        }
        .kop-inner {
            display: table;
            width: 100%;
        }
        .kop-col-left {
            display: table-cell;
            vertical-align: middle;
            width: 70%;
        }
        .kop-col-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 30%;
        }
        .kop-title {
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .kop-sub {
            font-size: 8.5px;
            color: #475569;
            margin-top: 1px;
            font-weight: 500;
        }
        .kop-address {
            font-size: 7.5px;
            color: #64748b;
            margin-top: 2px;
        }
        .kop-meta-box {
            display: inline-block;
            text-align: right;
            font-size: 8px;
            color: #334155;
            line-height: 1.4;
        }
        .kop-doc-num {
            font-family: monospace;
            font-size: 8.5px;
            font-weight: bold;
            color: #0284c7;
        }

        /* ====== EXECUTIVE SUMMARY / KPI BOX ====== */
        .kpi-container {
            display: table;
            width: 100%;
            margin-bottom: 12px;
            border-spacing: 5px;
        }
        .kpi-card {
            display: table-cell;
            width: 20%;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 6px 8px;
            vertical-align: top;
        }
        .kpi-label {
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 2px;
        }
        .kpi-value {
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
        }
        .kpi-sub {
            font-size: 6.5px;
            color: #64748b;
            margin-top: 2px;
        }

        /* ====== FILTER & PERIODE INFO ====== */
        .filter-bar {
            background: #f1f5f9;
            border-left: 3px solid #0284c7;
            padding: 5px 8px;
            margin-bottom: 10px;
            font-size: 7.5px;
            color: #334155;
        }

        /* ====== TABEL DATA ====== */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7.5px;
            margin-bottom: 15px;
        }
        table.data-table thead th {
            background-color: #f1f5f9;
            border: 1px solid #94a3b8;
            padding: 5px 5px;
            font-weight: bold;
            text-align: left;
            text-transform: uppercase;
            font-size: 7px;
            color: #1e293b;
        }
        table.data-table tbody td {
            border: 1px solid #cbd5e1;
            padding: 4.5px 5px;
            vertical-align: top;
        }
        td.kode { font-weight: bold; color: #0284c7; font-family: monospace; font-size: 7.5px; }
        td.nama { font-weight: bold; color: #0f172a; }
        .status-selesai { color: #059669; font-weight: bold; }
        .status-batal   { color: #dc2626; font-weight: bold; }
        .status-proses  { color: #2563eb; font-weight: bold; }
        .status-tunggu  { color: #d97706; font-weight: bold; }

        /* ====== LEMBAR PENGESAHAN (TANDA TANGAN) ====== */
        .ttd-container {
            width: 100%;
            margin-top: 18px;
            display: table;
            page-break-inside: avoid;
        }
        .ttd-box {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            font-size: 8px;
            line-height: 1.4;
        }
        .ttd-box.right {
            text-align: right;
            padding-right: 15px;
        }
        .ttd-box.left {
            text-align: left;
            padding-left: 15px;
        }
        .ttd-space {
            height: 48px;
        }
        .ttd-name {
            font-weight: bold;
            font-size: 8.5px;
            text-decoration: underline;
            color: #0f172a;
        }
        .ttd-nip {
            font-size: 7.5px;
            color: #64748b;
        }

        /* ====== FOOTER ====== */
        .footer {
            margin-top: 14px;
            border-top: 1px solid #cbd5e1;
            padding-top: 6px;
            display: table;
            width: 100%;
            font-size: 7px;
            color: #94a3b8;
        }
        .footer-left { display: table-cell; text-align: left; }
        .footer-right { display: table-cell; text-align: right; }
    </style>
</head>
<body>

    {{-- ====== KOP SURAT RESMI ====== --}}
    <div class="kop-surat">
        <div class="kop-inner">
            <div class="kop-col-left">
                <div class="kop-title">🚑 AMBULANS SIAGA — UNIT TANGGAP DARURAT</div>
                <div class="kop-sub">Sistem Informasi Pelayanan Evakuasi Medis & Ambulans Siaga Real-Time</div>
                <div class="kop-address">Jl. Pemuda No. 123, Kabupaten Cilacap, Jawa Tengah | Hotline: (0282) 119-000 | Email: operasional@ambulansiaga.id</div>
            </div>
            <div class="kop-col-right">
                <div class="kop-meta-box">
                    <strong>LAPORAN OPERASIONAL</strong><br>
                    <span class="kop-doc-num">No: LAP-OPS/AS/{{ date('m/Y') }}/{{ str_pad($rekap['total'] ?? 1, 3, '0', STR_PAD_LEFT) }}</span><br>
                    Tgl Cetak: {{ now()->translatedFormat('d F Y, H:i') }} WIB
                </div>
            </div>
        </div>
    </div>

    {{-- ====== RINGKASAN OPERASIONAL ====== --}}
    <div class="kpi-container">
        <!-- 1. Total & Sukses -->
        <div class="kpi-card">
            <div class="kpi-label">Total Layanan</div>
            <div class="kpi-value">{{ $rekap['total'] ?? 0 }} <span style="font-size:7.5px; font-weight:normal;">Order</span></div>
            <div class="kpi-sub">Tingkat Selesai: <strong>{{ $rekap['success_rate'] ?? 100 }}%</strong></div>
        </div>

        <!-- 2. Evakuasi Selesai vs Batal -->
        <div class="kpi-card">
            <div class="kpi-label">Evakuasi Selesai</div>
            <div class="kpi-value">{{ $rekap['selesai'] ?? 0 }} <span style="font-size:7.5px; font-weight:normal; color:#475569;">Pasien</span></div>
            <div class="kpi-sub">Batal: <strong>{{ $rekap['batal'] ?? 0 }} Order</strong></div>
        </div>

        <!-- 3. Rata-rata Respon Time -->
        <div class="kpi-card">
            <div class="kpi-label">Rata-rata Respon</div>
            <div class="kpi-value">
                @if(($rekap['avg_response'] ?? 0) > 0)
                    ~{{ $rekap['avg_response'] }} <span style="font-size:7.5px; font-weight:normal; color:#475569;">Menit</span>
                @else
                    < 5 <span style="font-size:7.5px; font-weight:normal; color:#475569;">Menit</span>
                @endif
            </div>
            <div class="kpi-sub">Waktu konfirmasi supir</div>
        </div>

        <!-- 4. Kepuasan Pengguna -->
        <div class="kpi-card">
            <div class="kpi-label">Kepuasan Pengguna</div>
            <div class="kpi-value">
                ★ {{ !empty($rekap['avg_rating']) ? number_format($rekap['avg_rating'], 1) : '5.0' }} <span style="font-size:7.5px; font-weight:normal; color:#475569;">/ 5.0</span>
            </div>
            <div class="kpi-sub">Total: <strong>{{ $rekap['rating_count'] ?? 0 }} Ulasan</strong></div>
        </div>

        <!-- 5. RS Rujukan Terbanyak -->
        <div class="kpi-card">
            <div class="kpi-label">Rujukan Terbanyak</div>
            <div class="kpi-value" style="font-size:9.5px; white-space:nowrap; overflow:hidden;">
                {{ Str::limit($rekap['top_rs'] ?? '-', 18) }}
            </div>
            <div class="kpi-sub">
                {{ $rekap['darurat_count'] ?? 0 }} Darurat, {{ $rekap['non_darurat_count'] ?? 0 }} Rutin
            </div>
        </div>
    </div>

    {{-- ====== BAR INFO FILTER ====== --}}
    <div class="filter-bar">
        📅 <strong>Periode Audit:</strong> {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} s.d. {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
        &nbsp;|&nbsp; 🔍 <strong>Filter Status:</strong> {{ $statusFilter ? ucfirst(str_replace('_', ' ', $statusFilter)) : 'Semua Status' }}
        &nbsp;|&nbsp; 📊 <strong>Total Entitas:</strong> {{ $laporan->count() }} Data Rekap
    </div>

    {{-- ====== TABEL DATA ====== --}}
    <table class="data-table">
        <thead>
            <tr>
                <th style="width:3%; text-align:center;">No</th>
                <th style="width:11%;">Kode Order</th>
                <th style="width:8%;">Waktu</th>
                <th style="width:14%;">Nama Pasien</th>
                <th style="width:19%;">Lokasi Jemput</th>
                <th style="width:19%;">RS / Faskes Rujukan</th>
                <th style="width:8%;">Armada</th>
                <th style="width:10%;">Driver</th>
                <th style="width:8%; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $idx => $row)
                @php
                    $statusClass = match($row->status) {
                        'selesai'    => 'status-selesai',
                        'dibatalkan' => 'status-batal',
                        'diproses','menuju_lokasi','membawa_pasien' => 'status-proses',
                        default      => 'status-tunggu',
                    };
                @endphp
                <tr>
                    <td style="text-align:center;">{{ $idx + 1 }}</td>
                    <td class="kode">
                        {{ $row->kode_order }}
                        @if($row->rating)
                            <div style="font-size:6.5px; color:#d97706; margin-top:1px;">★ {{ $row->rating->skor }}/5</div>
                        @endif
                    </td>
                    <td>
                        {{ $row->created_at?->format('d/m/Y') }}<br>
                        <span style="color:#64748b; font-size:6.5px;">{{ $row->created_at?->format('H:i') }} WIB</span>
                    </td>
                    <td class="nama">
                        {{ $row->nama_pasien }}
                        <div style="color:#64748b; font-size:6.5px; margin-top:1px;">NIK: {{ $row->nik_pasien ?: '-' }}</div>
                    </td>
                    <td>{{ Str::limit($row->lokasi_jemput, 55) }}</td>
                    <td>{{ Str::limit($row->tujuan_lokasi ?? $row->rumahSakit?->nama ?? '-', 55) }}</td>
                    <td><strong>{{ $row->ambulans?->kode_ambulans ?? '-' }}</strong></td>
                    <td>{{ $row->supir?->user?->name ?? '-' }}</td>
                    <td style="text-align:center;" class="{{ $statusClass }}">{{ $row->status_label }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:15px; color:#94a3b8;">
                        Tidak ada data pemesanan pada rentang periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ====== LEMBAR PENGESAHAN DOKUMEN ====== --}}
    <div class="ttd-container">
        <div class="ttd-box left">
            <div>Dibuat & Diverifikasi Oleh:</div>
            <div style="font-weight:bold; color:#334155;">Petugas Administrator / Operator Medis</div>
            <div class="ttd-space"></div>
            <div class="ttd-name">( {{ auth()->user()->name ?? 'Administrator Siaga' }} )</div>
            <div class="ttd-nip">Operator Tanggap Darurat</div>
        </div>
        <div class="ttd-box right">
            <div>Cilacap, {{ now()->translatedFormat('d F Y') }}</div>
            <div>Mengetahui & Menyetujui:</div>
            <div style="font-weight:bold; color:#334155;">Kepala Operasional / Pimpinan Yayasan</div>
            <div class="ttd-space"></div>
            <div class="ttd-name">( ................................................................ )</div>
            <div class="ttd-nip">Penanggung Jawab Operasional</div>
        </div>
    </div>

    {{-- ====== FOOTER ====== --}}
    <div class="footer">
        <div class="footer-left">© {{ date('Y') }} Ambulans Siaga — Dokumen Audit & Laporan Resmi Sistem Pelayanan Darurat</div>
        <div class="footer-right">Digenerate otomatis pada {{ now()->format('d/m/Y H:i:s') }} WIB</div>
    </div>

</body>
</html>
