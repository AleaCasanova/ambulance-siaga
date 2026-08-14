<?php

namespace App\Livewire\Mitra;

use App\Models\Mitra;
use App\Models\Pemesanan;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    // Detail Modal State
    public $isDetailModalOpen = false;
    public $selectedOrder = null;

    public function getMitraProperty()
    {
        $user = auth()->user();
        if (!$user) return null;

        $mitra = $user->mitra;
        if (!$mitra) {
            $mitra = Mitra::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_mitra' => $user->name,
                    'penanggung_jawab' => $user->name,
                    'no_telp' => $user->phone ?? '081234567890',
                    'alamat' => 'Cilacap, Jawa Tengah',
                    'is_active' => true,
                ]
            );
        }

        return $mitra;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function showDetail($id)
    {
        $mitra = $this->mitra;
        $mitraId = $mitra ? $mitra->id : 0;

        $this->selectedOrder = Pemesanan::with(['user', 'ambulans', 'supir.user', 'rumahSakit'])
            ->whereHas('ambulans', function ($q) use ($mitraId) {
                $q->where('mitra_id', $mitraId);
            })
            ->findOrFail($id);

        $this->isDetailModalOpen = true;
    }

    public function closeDetailModal()
    {
        $this->isDetailModalOpen = false;
        $this->selectedOrder = null;
    }

    public function render()
    {
        $mitra = $this->mitra;
        $mitraId = $mitra ? $mitra->id : 0;

        $orders = Pemesanan::with(['user', 'ambulans', 'supir.user', 'rumahSakit'])
            ->whereHas('ambulans', function ($q) use ($mitraId) {
                $q->where('mitra_id', $mitraId);
            })
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('kode_order', 'like', '%' . $this->search . '%')
                        ->orWhere('nama_pasien', 'like', '%' . $this->search . '%')
                        ->orWhere('lokasi_jemput', 'like', '%' . $this->search . '%')
                        ->orWhere('tujuan_lokasi', 'like', '%' . $this->search . '%')
                        ->orWhereHas('supir.user', function ($u) {
                            $u->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->statusFilter, function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.mitra.order-index', [
            'orders' => $orders,
            'mitra' => $mitra,
        ])->layout('layouts.admin');
    }
}
