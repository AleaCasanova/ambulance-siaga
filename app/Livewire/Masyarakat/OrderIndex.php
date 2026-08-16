<?php

namespace App\Livewire\Masyarakat;

use App\Models\Pemesanan;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public string $statusFilter = '';

    public function mount()
    {
        $user = auth()->user();
        if ($user && $user->hasRole('supir')) {
            $this->redirectRoute('supir.dashboard');
            return;
        }
        if ($user && ($user->hasRole('operator') || $user->hasRole('admin'))) {
            $this->redirectRoute('operator.orders.index');
            return;
        }
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function cancelOrder($orderId)
    {
        $order = Pemesanan::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->whereIn('status', ['menunggu', 'diproses'])
            ->first();

        if ($order) {
            $order->update(['status' => 'dibatalkan']);
            if ($order->ambulans) {
                $order->ambulans->update(['status' => 'Tersedia']);
            }
            session()->flash('success', 'Pesanan berhasil dibatalkan.');
        }
    }

    public function deleteOrderHistory($orderId)
    {
        $order = Pemesanan::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->whereIn('status', ['dibatalkan', 'selesai'])
            ->first();

        if ($order) {
            $order->delete();
            session()->flash('success', 'Riwayat pesanan berhasil dihapus.');
        }
    }

    public function render()
    {
        $query = Pemesanan::with(['supir.user', 'ambulans', 'rumahSakit', 'rating'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc');

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $orders = $query->paginate(8);

        return view('livewire.masyarakat.order-index', [
            'orders' => $orders,
        ])->layout('layouts.blank');
    }
}
