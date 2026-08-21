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
            font-size: 9px;
            color: #1e293b;
            background: #ffffff;
        }

        /* ====== HEADER ====== */
        .header {
            padding: 16px 20px;
            margin-bottom: 16px;
            border-bottom: 2px solid #000;
        }
        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .header-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .header-subtitle { font-size: 9px; opacity: 0.85; }
        .header-meta {
            text-align: right;
            font-size: 8px;
            opacity: 0.85;
        }
        .header-meta strong { font-size: 10px; }



        /* ====== FILTER INFO ====== */
        .filter-info {
            padding: 4px 0;
            margin-bottom: 14px;
            font-size: 8px;
            color: #333;
        }
        .filter-info strong { font-weight: bold; }

        /* ====== TABLE ====== */
        table { width: 100%; border-collapse: collapse; font-size: 8px; }
        thead tr {
            border-top: 2px solid #000;
            border-bottom: 1px solid #000;
        }
        thead th {
            padding: 7px 6px;
            font-weight: bold;
            text-align: left;
            font-size: 7.5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        tbody tr { border-bottom: 1px solid #ddd; }
        tbody td {
            padding: 6px 6px;
            vertical-align: top;
        }
        td.kode { font-weight: bold; color: #0284c7; }
        td.nama { font-weight: bold; }
        td.status-selesai    { color: #059669; font-weight: bold; }
        td.status-batal      { color: #dc2626; font-weight: bold; }
        td.status-diproses   { color: #2563eb; }
        td.status-menunggu   { color: #d97706; }
        td.rating-star       { color: #f59e0b; font-weight: bold; }

        /* ====== FOOTER ====== */
        .footer {
            margin-top: 16px;
            border-top: 2px solid #e2e8f0;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            font-size: 7.5px;
            color: #94a3b8;
        }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>

    {{-- ====== HEADER ====== --}}
    <div class="header">
        <div class="header-inner">
            <div>
                <div class="header-title">🚑 LAPORAN PEMESANAN AMBULANS</div>
                <div class="header-subtitle">Ambulans Siaga — Jaringan Layanan Tanggap Darurat & Evakuasi Medis</div>
            </div>
            <div class="header-meta">
                <strong>Dicetak: {{ now()->translatedFormat('d F Y, H:i') }} WIB</strong><br>
                Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}<br>
                @if($statusFilter) Filter Status: {{ ucfirst($statusFilter) }} @else Semua Status @endif
            </div>
        </div>
    </div>



    {{-- ====== FILTER INFO ====== --}}
    <div class="filter-info">
        📅 <strong>Rentang Data:</strong>
        {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} s.d.
        {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
        @if($statusFilter) &nbsp;|&nbsp; 🔍 <strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $statusFilter)) }} @endif
        &nbsp;|&nbsp; 📊 <strong>Total Ditampilkan:</strong> {{ $laporan->count() }} baris
    </div>

    {{-- ====== TABLE ====== --}}
    <table>
        <thead>
            <tr>
                <th style="width:3%">No</th>
                <th style="width:10%">Kode Order</th>
                <th style="width:8%">Tanggal</th>
                <th style="width:13%">Nama Pasien</th>
                <th style="width:20%">Lokasi Jemput</th>
                <th style="width:20%">Tujuan / RS</th>
                <th style="width:8%">Ambulans</th>
                <th style="width:10%">Supir</th>
                <th style="width:8%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $idx => $row)
                @php
                    $statusClass = match($row->status) {
                        'selesai'    => 'status-selesai',
                        'dibatalkan' => 'status-batal',
                        'diproses','menuju_lokasi','membawa_pasien' => 'status-diproses',
                        default      => 'status-menunggu',
                    };
                @endphp
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td class="kode">{{ $row->kode_order }}</td>
                    <td>{{ $row->created_at?->format('d/m/Y') }}<br><span style="color:#94a3b8">{{ $row->created_at?->format('H:i') }}</span></td>
                    <td class="nama">{{ $row->nama_pasien }}<div style="margin-top: 3px; color:#64748b; font-size:7px">NIK: {{ $row->nik_pasien ?: '-' }}</div></td>
                    <td>{{ Str::limit($row->lokasi_jemput, 60) }}</td>
                    <td>{{ Str::limit($row->tujuan_lokasi ?? $row->rumahSakit?->nama ?? '-', 60) }}</td>
                    <td>{{ $row->ambulans?->kode_ambulans ?? '-' }}</td>
                    <td>{{ $row->supir?->user?->name ?? '-' }}</td>
                    <td class="{{ $statusClass }}">{{ $row->status_label }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center;padding:20px;color:#94a3b8">
                        Tidak ada data pada periode yang dipilih
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ====== FOOTER ====== --}}
    <div class="footer">
        <div>© {{ date('Y') }} Ambulans Siaga &nbsp;|&nbsp; Sistem Tanggap Darurat v1.0</div>
        <div>Dokumen ini digenerate otomatis oleh sistem pada {{ now()->format('d/m/Y H:i:s') }} WIB</div>
    </div>

</body>
</html>
