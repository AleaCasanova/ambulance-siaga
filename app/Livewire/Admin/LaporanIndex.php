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
        $query = Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'rating'])
            ->orderBy('created_at', 'desc');

        if ($this->startDate && $this->endDate) {
            $query->whereDate('created_at', '>=', $this->startDate)
                  ->whereDate('created_at', '<=', $this->endDate);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $laporan = $query->paginate(15);

        // Rekap ringkas berdasarkan filter saat ini
        $rekap = [
            'total' => (clone $query)->count(),
            'selesai' => (clone $query)->where('status', 'selesai')->count(),
            'batal' => (clone $query)->where('status', 'dibatalkan')->count(),
        ];

        return view('livewire.admin.laporan-index', [
            'laporan' => $laporan,
            'rekap' => $rekap,
        ]);
    }
}
