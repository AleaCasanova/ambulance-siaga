<?php

namespace App\Livewire\Supir;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\StatusPerjalanan;
use App\Models\Supir;
use Livewire\Component;

class Dashboard extends Component
{
    public bool $isOnline = false;

    public function mount()
    {
        $user = auth()->user();
        if ($user && $user->supir) {
            $this->isOnline = (bool) $user->supir->status_online;
        }
    }

    public function toggleOnline()
    {
        $user = auth()->user();
        if ($user && $user->supir) {
            $this->isOnline = !$this->isOnline;
            $user->supir->update(['status_online' => $this->isOnline]);
            session()->flash('success', $this->isOnline ? 'Status Anda sekarang ONLINE (Siaga Menerima Tugas).' : 'Status Anda sekarang OFFLINE (Istirahat).');
        }
    }

    public function takeOrder($orderId)
    {
        $user = auth()->user();
        $supir = $user?->supir;
        if (!$supir) {
            return;
        }

        $order = Pemesanan::where('id', $orderId)
            ->where('status', 'menunggu')
            ->whereNull('supir_id')
            ->first();

        if ($order) {
            $amb = Ambulans::where('status', 'Tersedia')->first() ?? Ambulans::first();
            $order->update([
                'supir_id' => $supir->id,
                'ambulans_id' => $amb?->id,
                'status' => 'diproses',
                'waktu_respon' => now(),
            ]);

            if ($amb) {
                $amb->update(['status' => 'Ditugaskan']);
            }

            StatusPerjalanan::create([
                'pemesanan_id' => $order->id,
                'status' => 'diproses',
                'keterangan' => "Supir mengambil tugas penjemputan darurat ini",
                'created_by' => $user->id,
            ]);

            session()->flash('success', "Tugas pesanan #{$order->kode_order} berhasil Anda ambil! Segera lakukan penjemputan.");
            return redirect()->route('supir.orders.show', $order->id);
        }
    }

    public function render()
    {
        $user = auth()->user();
        $supir = $user->supir;

        // Ambil tugas aktif saat ini
        $activeOrder = null;
        if ($supir) {
            $activeOrder = Pemesanan::with(['user', 'ambulans', 'rumahSakit'])
                ->where('supir_id', $supir->id)
                ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
                ->latest()
                ->first();
        }

        // Ambil pesanan darurat yang masih menunggu supir (unassigned)
        $openOrders = Pemesanan::with(['user', 'rumahSakit'])
            ->where('status', 'menunggu')
            ->whereNull('supir_id')
            ->latest()
            ->get();

        // Ambil riwayat tugas yang sudah selesai
        $completedOrders = [];
        if ($supir) {
            $completedOrders = Pemesanan::with(['user', 'rumahSakit', 'rating'])
                ->where('supir_id', $supir->id)
                ->where('status', 'selesai')
                ->orderBy('updated_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('livewire.supir.dashboard', [
            'supir' => $supir,
            'activeOrder' => $activeOrder,
            'openOrders' => $openOrders,
            'completedOrders' => $completedOrders,
        ]);
    }
}

