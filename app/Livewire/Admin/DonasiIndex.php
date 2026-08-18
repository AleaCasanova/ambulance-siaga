<?php

namespace App\Livewire\Admin;

use App\Models\Donasi;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DonasiIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $searchField = 'nama';
    public string $statusFilter = '';
    public string $dateFilter = '';
    public string $startDate = '';
    public string $endDate = '';
    public string $minNominal = '';
    public string $maxNominal = '';
    public bool $showAdvancedFilter = false;

    public function updatingSearch() { $this->resetPage(); }
    public function updatingSearchField() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }
    public function updatingDateFilter() { $this->resetPage(); }
    public function updatingStartDate() { $this->resetPage(); }
    public function updatingEndDate() { $this->resetPage(); }
    public function updatingMinNominal() { $this->resetPage(); }
    public function updatingMaxNominal() { $this->resetPage(); }

    public function toggleAdvancedFilter()
    {
        $this->showAdvancedFilter = !$this->showAdvancedFilter;
    }

    public function resetFilters()
    {
        $this->reset([
            'search', 'searchField', 'statusFilter', 'dateFilter', 
            'startDate', 'endDate', 'minNominal', 'maxNominal'
        ]);
        $this->resetPage();
    }

    public function applyFilter()
    {
        $this->resetPage();
    }

    public function exportCsv(): StreamedResponse
    {
        $fileName = 'transaksi_donasi_' . date('Y-m-d_His') . '.csv';

        $query = $this->buildQuery();

        return response()->streamDownload(function () use ($query) {
            $handle = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header row
            fputcsv($handle, [
                'ID Transaksi',
                'Tanggal & Waktu',
                'Nama Donatur',
                'Anonim',
                'Email',
                'WhatsApp',
                'Nominal (IDR)',
                'Status',
                'Pesan / Doa'
            ]);

            $query->chunk(200, function ($donasis) use ($handle) {
                foreach ($donasis as $d) {
                    fputcsv($handle, [
                        $d->id,
                        $d->created_at ? $d->created_at->format('Y-m-d H:i:s') : '-',
                        $d->is_anonim ? 'Hamba Allah (Anonim)' : ($d->nama ?: 'Anonim'),
                        $d->is_anonim ? 'Ya' : 'Tidak',
                        $d->email ?: '-',
                        $d->whatsapp ?: '-',
                        $d->nominal,
                        $d->status,
                        $d->pesan ?: '-'
                    ]);
                }
            });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }

    protected function buildQuery()
    {
        $query = Donasi::query();

        if ($this->search) {
            if ($this->searchField === 'nama') {
                $query->where('nama', 'like', '%' . $this->search . '%');
            } elseif ($this->searchField === 'email') {
                $query->where('email', 'like', '%' . $this->search . '%');
            } elseif ($this->searchField === 'id') {
                $query->where('id', 'like', '%' . $this->search . '%');
            } else {
                $query->where(function($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('pesan', 'like', '%' . $this->search . '%');
                });
            }
        }

        if ($this->statusFilter) {
            if ($this->statusFilter === 'berhasil') {
                $query->whereIn('status', ['settlement', 'success']);
            } elseif ($this->statusFilter === 'gagal') {
                $query->whereIn('status', ['cancel', 'expire', 'deny', 'failed']);
            } elseif ($this->statusFilter === 'pending') {
                $query->where('status', 'pending');
            } else {
                $query->where('status', $this->statusFilter);
            }
        }

        if ($this->dateFilter) {
            if ($this->dateFilter === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($this->dateFilter === '7days') {
                $query->where('created_at', '>=', now()->subDays(7));
            } elseif ($this->dateFilter === '30days') {
                $query->where('created_at', '>=', now()->subDays(30));
            } elseif ($this->dateFilter === 'this_month') {
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
            } elseif ($this->dateFilter === 'this_year') {
                $query->whereYear('created_at', now()->year);
            }
        }

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        if ($this->minNominal) {
            $query->where('nominal', '>=', (float) $this->minNominal);
        }

        if ($this->maxNominal) {
            $query->where('nominal', '<=', (float) $this->maxNominal);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function render()
    {
        $stats = [
            'totalDana' => Donasi::whereIn('status', ['settlement', 'success'])->sum('nominal'),
            'totalBerhasil' => Donasi::whereIn('status', ['settlement', 'success'])->count(),
            'totalPending' => Donasi::where('status', 'pending')->count(),
            'totalGagal' => Donasi::whereIn('status', ['cancel', 'expire', 'deny', 'failed'])->count(),
        ];

        $donasis = $this->buildQuery()->paginate(6);

        return view('livewire.admin.donasi-index', [
            'donasis' => $donasis,
            'stats' => $stats,
            'showAdvancedFilter' => $this->showAdvancedFilter,
        ])->layout('layouts.admin');
    }
}
