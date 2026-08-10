<?php

namespace App\Exports;

use App\Models\Pemesanan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport
{
    protected string $startDate;
    protected string $endDate;
    protected string $statusFilter;

    public function __construct(string $startDate, string $endDate, string $statusFilter = '')
    {
        $this->startDate    = $startDate;
        $this->endDate      = $endDate;
        $this->statusFilter = $statusFilter;
    }

    public function build(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Ambulans');

        // ====== JUDUL DOKUMEN ======
        $sheet->mergeCells('A1:T1');
        $sheet->setCellValue('A1', 'LAPORAN PEMESANAN AMBULANS — GSC SIAGA (Yayasan Gerak Sedekah Cilacap)');
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FFFFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0284C7']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // ====== INFO PERIODE ======
        $sheet->mergeCells('A2:T2');
        $periodText = 'Periode: ' . \Carbon\Carbon::parse($this->startDate)->format('d/m/Y') . ' s.d. ' . \Carbon\Carbon::parse($this->endDate)->format('d/m/Y');
        if ($this->statusFilter) {
            $periodText .= '  |  Filter Status: ' . ucfirst(str_replace('_', ' ', $this->statusFilter));
        }
        $periodText .= '  |  Dicetak: ' . now()->format('d/m/Y H:i') . ' WIB';
        $sheet->setCellValue('A2', $periodText);
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['size' => 9, 'italic' => true, 'color' => ['argb' => 'FF475569']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFEFF6FF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(16);

        // ====== HEADER KOLOM ======
        $headers = [
            'A' => ['No',             4],
            'B' => ['Kode Order',     18],
            'C' => ['Tgl Pesan',      14],
            'D' => ['Nama Pasien',    22],
            'E' => ['NIK Pasien',     18],
            'F' => ['Usia',           8],
            'G' => ['No. HP',         15],
            'H' => ['Keperluan',      16],
            'I' => ['Kondisi Pasien', 30],
            'J' => ['Lokasi Jemput',  35],
            'K' => ['RS Tujuan',      28],
            'L' => ['Kode Ambulans',  14],
            'M' => ['Supir',          22],
            'N' => ['Status',         16],
            'O' => ['Tgl Pesan',      16],
            'P' => ['Waktu Respon',   16],
            'Q' => ['Waktu Jemput',   16],
            'R' => ['Waktu Selesai',  16],
            'S' => ['Rating',         10],
            'T' => ['Ulasan',         35],
        ];

        $headerRow = 4; // baris 3 kosong sebagai spacer
        $sheet->getRowDimension(3)->setRowHeight(6);

        foreach ($headers as $col => [$label, $width]) {
            $sheet->setCellValue("{$col}{$headerRow}", $label);
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        $sheet->getStyle("A{$headerRow}:T{$headerRow}")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 9, 'color' => ['argb' => 'FFFFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0F4C81']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FF0284C7']]],
        ]);
        $sheet->getRowDimension($headerRow)->setRowHeight(22);

        // ====== DATA ======
        $query = Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'rating'])
            ->orderBy('created_at', 'desc');

        if ($this->startDate && $this->endDate) {
            $query->whereDate('created_at', '>=', $this->startDate)
                  ->whereDate('created_at', '<=', $this->endDate);
        }
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $data = $query->get();
        $dataStartRow = $headerRow + 1;

        foreach ($data as $i => $row) {
            $r = $dataStartRow + $i;
            $isEven = ($i % 2 === 0);

            $statusLabel = match ($row->status) {
                'menunggu'       => 'Menunggu',
                'diproses'       => 'Ditugaskan',
                'menuju_lokasi'  => 'Menuju Lokasi',
                'membawa_pasien' => 'Membawa Pasien',
                'selesai'        => 'Selesai',
                'dibatalkan'     => 'Dibatalkan',
                default          => ucfirst($row->status),
            };

            $rowData = [
                'A' => $i + 1,
                'B' => $row->kode_order,
                'C' => $row->created_at ? $row->created_at->format('d/m/Y H:i') : '-',
                'D' => $row->nama_pasien,
                'E' => $row->nik_pasien ?: '-',
                'F' => $row->usia_pasien ?: '-',
                'G' => $row->no_hp_kontak ?: '-',
                'H' => $row->keperluan_penggunaan ?: '-',
                'I' => $row->kondisi_pasien ?: '-',
                'J' => $row->lokasi_jemput,
                'K' => $row->tujuan_lokasi ?? $row->rumahSakit?->nama ?? '-',
                'L' => $row->ambulans?->kode_ambulans ?? '-',
                'M' => $row->supir?->user?->name ?? '-',
                'N' => $statusLabel,
                'O' => $row->waktu_pesan ? $row->waktu_pesan->format('d/m/Y H:i') : '-',
                'P' => $row->waktu_respon ? $row->waktu_respon->format('d/m/Y H:i') : '-',
                'Q' => $row->waktu_jemput ? $row->waktu_jemput->format('d/m/Y H:i') : '-',
                'R' => $row->waktu_selesai ? $row->waktu_selesai->format('d/m/Y H:i') : '-',
                'S' => $row->rating ? $row->rating->skor . '/5' : '-',
                'T' => $row->rating?->ulasan ?? '-',
            ];

            foreach ($rowData as $col => $value) {
                $sheet->setCellValue("{$col}{$r}", $value);
            }

            // Styling per baris
            $bgColor = $isEven ? 'FFFAFAFA' : 'FFFFFFFF';
            $sheet->getStyle("A{$r}:T{$r}")->applyFromArray([
                'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => $bgColor]],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
            ]);
            $sheet->getStyle("B{$r}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => 'FF0284C7']],
            ]);

            // Warna status
            $statusColor = match ($row->status) {
                'selesai'    => 'FF059669',
                'dibatalkan' => 'FFDC2626',
                'menunggu'   => 'FFD97706',
                default      => 'FF2563EB',
            };
            $sheet->getStyle("N{$r}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => $statusColor]],
            ]);

            $sheet->getRowDimension($r)->setRowHeight(20);
        }

        // ====== REKAP RINGKAS di bawah ======
        $totalRows   = $data->count();
        $lastDataRow = $dataStartRow + $totalRows;

        $sheet->getRowDimension($lastDataRow + 1)->setRowHeight(8);
        $rekapRow = $lastDataRow + 2;

        $rekapData = [
            ['Total Order', $totalRows],
            ['Selesai', $data->where('status', 'selesai')->count()],
            ['Dibatalkan', $data->where('status', 'dibatalkan')->count()],
            ['Menunggu', $data->where('status', 'menunggu')->count()],
            ['Diproses', $data->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])->count()],
        ];

        $sheet->mergeCells("A{$rekapRow}:C{$rekapRow}");
        $sheet->setCellValue("A{$rekapRow}", 'REKAP RINGKAS');
        $sheet->getStyle("A{$rekapRow}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 10, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0F4C81']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        foreach ($rekapData as $idx => [$label, $val]) {
            $colA = chr(65 + ($idx * 2));
            $colB = chr(66 + ($idx * 2));
            $r2 = $rekapRow + 1;
            if ($idx === 0) {
                $sheet->setCellValue("A{$r2}", $label);
                $sheet->setCellValue("B{$r2}", $val);
            } else {
                $sheet->setCellValue(chr(65 + (($idx - 1) * 2 + 2)) . $r2, $label);
                $sheet->setCellValue(chr(65 + (($idx - 1) * 2 + 3)) . $r2, $val);
            }
        }

        // Freeze header row
        $sheet->freezePane("A{$dataStartRow}");

        return $spreadsheet;
    }
}
