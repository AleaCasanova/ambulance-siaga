<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanExportController extends Controller
{
    /**
     * Export laporan sebagai file PDF menggunakan DomPDF.
     */
    public function exportPdf(Request $request)
    {
        [$startDate, $endDate, $statusFilter, $laporan, $rekap] = $this->getData($request);

        $pdf = Pdf::loadView('pdf.laporan-pdf', [
            'laporan'      => $laporan,
            'rekap'        => $rekap,
            'startDate'    => $startDate,
            'endDate'      => $endDate,
            'statusFilter' => $statusFilter,
        ])
        ->setPaper('a4', 'landscape')
        ->setOption('margin-top', '8mm')
        ->setOption('margin-bottom', '10mm')
        ->setOption('margin-left', '8mm')
        ->setOption('margin-right', '8mm')
        ->setOption('enable-php', true)
        ->setOption('isHtml5ParserEnabled', true);

        $filename = 'Laporan-Ambulans-GSC-' . Carbon::parse($startDate)->format('Ymd') . '-sd-' . Carbon::parse($endDate)->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export laporan sebagai file Excel (.xlsx) menggunakan PhpSpreadsheet.
     */
    public function exportExcel(Request $request)
    {
        [$startDate, $endDate, $statusFilter] = $this->getFilters($request);

        $export      = new LaporanExport($startDate, $endDate, $statusFilter);
        $spreadsheet = $export->build();

        $writer   = new Xlsx($spreadsheet);
        $filename = 'Laporan-Ambulans-GSC-' . Carbon::parse($startDate)->format('Ymd') . '-sd-' . Carbon::parse($endDate)->format('Ymd') . '.xlsx';
        $tmpPath  = storage_path('app/tmp/' . $filename);

        // Pastikan direktori tmp ada
        if (!is_dir(storage_path('app/tmp'))) {
            mkdir(storage_path('app/tmp'), 0755, true);
        }

        $writer->save($tmpPath);

        return response()->download($tmpPath, $filename, [
            'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Ambil filter dari request.
     */
    private function getFilters(Request $request): array
    {
        $startDate    = $request->query('start', now()->startOfMonth()->format('Y-m-d'));
        $endDate      = $request->query('end', now()->format('Y-m-d'));
        $statusFilter = $request->query('status', '');

        return [$startDate, $endDate, $statusFilter];
    }

    /**
     * Ambil data laporan berdasarkan filter.
     */
    private function getData(Request $request): array
    {
        [$startDate, $endDate, $statusFilter] = $this->getFilters($request);

        $query = Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'rating'])
            ->orderBy('created_at', 'desc');

        if ($startDate && $endDate) {
            $query->whereDate('created_at', '>=', $startDate)
                  ->whereDate('created_at', '<=', $endDate);
        }

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        $laporan = $query->get();

        $rekap = [
            'total'   => $laporan->count(),
            'selesai' => $laporan->where('status', 'selesai')->count(),
            'batal'   => $laporan->where('status', 'dibatalkan')->count(),
        ];

        return [$startDate, $endDate, $statusFilter, $laporan, $rekap];
    }
}
