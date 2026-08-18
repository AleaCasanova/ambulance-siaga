<?php

namespace App\Livewire\Masyarakat;

use App\Models\Pemesanan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.blank')]
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
        /** @var \Illuminate\Database\Eloquent\Builder $baseQuery */
        $baseQuery = Pemesanan::with(['supir.user', 'ambulans', 'rumahSakit', 'rating'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc');

        if ($this->statusFilter) {
            $baseQuery->where('status', $this->statusFilter);
        }

        $activeQuery = clone $baseQuery;
        $historyQuery = clone $baseQuery;

        $activeOrders = $activeQuery->whereNotIn('status', ['selesai', 'dibatalkan'])->get();
        $historyOrders = $historyQuery->whereIn('status', ['selesai', 'dibatalkan'])->paginate(6);

        return view('livewire.masyarakat.order-index', [
            'activeOrders' => $activeOrders,
            'historyOrders' => $historyOrders,
        ])->layout('layouts.blank');
    }
}