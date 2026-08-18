<?php

namespace App\Livewire\Supir;

use App\Models\Pemesanan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class RiwayatIndex extends Component
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

    public function render()
    {
        $supirId = auth()->user()->supir->id ?? null;

        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = Pemesanan::with(['user', 'ambulans', 'rumahSakit', 'rating'])
            ->where('supir_id', $supirId)
            ->orderBy('created_at', 'desc');

        if ($this->startDate && $this->endDate) {
            $query->whereDate('created_at', '>=', $this->startDate)
                  ->whereDate('created_at', '<=', $this->endDate);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $laporan = $query->paginate(6);

        // Rekap ringkas berdasarkan filter saat ini
        $rekap = [
            'total' => (clone $query)->count(),
            'selesai' => (clone $query)->where('status', 'selesai')->count(),
            'batal' => (clone $query)->where('status', 'dibatalkan')->count(),
        ];

        return view('livewire.supir.riwayat-index', [
            'laporan' => $laporan,
            'rekap' => $rekap,
        ]);
    }
}
