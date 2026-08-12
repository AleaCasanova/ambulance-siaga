<?php

namespace App\Livewire\Supir;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\StatusPerjalanan;
use App\Models\Supir;
use Livewire\Component;

class TugasIndex extends Component
{
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
            return redirect()->route('supir.perjalanan.aktif');
        }
    }

    public function render()
    {
        $user = auth()->user();
        $supir = $user->supir;

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
                ->get();
        }

        $isOnline = $supir ? (bool) $supir->status_online : false;

        return view('livewire.supir.tugas-index', [
            'openOrders' => $openOrders,
            'completedOrders' => $completedOrders,
            'isOnline' => $isOnline,
        ])->layout('layouts.app');
    }
}
