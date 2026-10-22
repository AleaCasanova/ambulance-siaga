<?php

namespace App\Livewire\Admin;

use App\Models\Pemesanan;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanIndex extends Component
{
    use WithPagination;

    public string $startDate = '';
    public string $endDate = '';
    public string $statusFilter = '';

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function updatingStartDate() { $this->resetPage(); }
    public function updatingEndDate() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }

    public function resetFilters()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
        $this->statusFilter = '';
        $this->resetPage();
    }

    public function deleteReport($id)
    {
        Pemesanan::findOrFail($id)->delete();
        session()->flash('success', 'Data laporan pesanan berhasil dihapus dari database.');
    }

    public function editReportStatus($id, $newStatus)
    {
        Pemesanan::findOrFail($id)->update(['status' => $newStatus]);
        session()->flash('success', 'Status laporan pesanan berhasil diperbarui.');
    }

    public function render()
    {
        $baseQuery = Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'rating'])
            ->orderBy('created_at', 'desc');

        if ($this->startDate && $this->endDate) {
            $baseQuery->whereDate('created_at', '>=', $this->startDate)
                      ->whereDate('created_at', '<=', $this->endDate);
        }

        if ($this->statusFilter) {
            $baseQuery->where('status', $this->statusFilter);
        }

        $allData = (clone $baseQuery)->get();
        $laporan = (clone $baseQuery)->paginate(6);

        // Rekapitulasi Eksekutif Lengkap
        $totalOrders = $allData->count();
        $selesaiOrders = $allData->where('status', 'selesai')->count();
        $batalOrders = $allData->where('status', 'dibatalkan')->count();
        $successRate = $totalOrders > 0 ? round(($selesaiOrders / $totalOrders) * 100) : 0;

        // Waktu Respon Rata-rata (menit)
        $validResponses = $allData->filter(function($row) {
            return $row->waktu_respon && ($row->waktu_pesan || $row->created_at);
        });
        
        $avgResponseMinutes = 0;
        if ($validResponses->count() > 0) {
            $totalMinutes = $validResponses->sum(function($row) {
                $start = $row->waktu_pesan ?? $row->created_at;
                return max(1, $row->waktu_respon->diffInMinutes($start));
            });
            $avgResponseMinutes = round($totalMinutes / $validResponses->count());
        }

        // Rating Kepuasan CSAT
        $ratings = $allData->pluck('rating.skor')->filter();
        $avgRating = $ratings->count() > 0 ? round($ratings->avg(), 1) : null;
        $totalRatingCount = $ratings->count();

        // Kategori Darurat vs Non-Darurat
        $daruratCount = $allData->filter(function($row) {
            $keperluan = strtolower($row->keperluan_penggunaan ?? '');
            $prioritas = strtolower($row->prioritas ?? '');
            return str_contains($keperluan, 'darurat') || str_contains($keperluan, 'emergency') || str_contains($prioritas, 'darurat') || str_contains($prioritas, 'tinggi');
        })->count();

        // RS Rujukan Terbanyak
        $topRs = $allData->map(function($row) {
            return $row->rumahSakit?->nama ?? $row->tujuan_lokasi;
        })->filter()->countBy()->sortDesc()->keys()->first() ?? '-';

        // Ambulans Paling Aktif
        $topAmbulans = $allData->map(function($row) {
            return $row->ambulans?->kode_ambulans;
        })->filter()->countBy()->sortDesc()->keys()->first() ?? '-';

        $rekap = [
            'total'             => $totalOrders,
            'selesai'           => $selesaiOrders,
            'batal'             => $batalOrders,
            'success_rate'      => $successRate,
            'avg_response'      => $avgResponseMinutes,
            'avg_rating'        => $avgRating,
            'rating_count'      => $totalRatingCount,
            'darurat_count'     => $daruratCount,
            'non_darurat_count' => $totalOrders - $daruratCount,
            'top_rs'            => $topRs,
            'top_ambulans'      => $topAmbulans,
        ];

        return view('livewire.admin.laporan-index', [
            'laporan' => $laporan,
            'rekap' => $rekap,
        ])->layout('layouts.admin');
    }
}
