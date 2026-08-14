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

    public function acceptOrder($orderId, \App\Services\PemesananService $service)
    {
        $order = Pemesanan::where('id', $orderId)->where('supir_id', auth()->user()->supir?->id)->first();
        if ($order && $order->status === 'menunggu_konfirmasi_supir') {
            $service->updateStatus($order->id, 'diproses', 'Supir menerima penugasan', auth()->id());
            session()->flash('success', 'Tugas berhasil diterima. Harap segera menuju lokasi!');
            return redirect()->route('supir.perjalanan.aktif');
        }
    }

    public function rejectOrder($orderId)
    {
        $order = Pemesanan::where('id', $orderId)->where('supir_id', auth()->user()->supir?->id)->first();
        if ($order && $order->status === 'menunggu_konfirmasi_supir') {
            $amb = $order->ambulans;
            $order->update([
                'supir_id' => null,
                'ambulans_id' => null,
                'status' => 'menunggu',
                'waktu_respon' => null,
            ]);
            
            if ($amb) {
                $amb->update(['status' => 'Tersedia']);
            }
            
            StatusPerjalanan::create([
                'pemesanan_id' => $order->id,
                'status' => 'menunggu',
                'keterangan' => 'Supir menolak penugasan. Pesanan kembali antre.',
                'created_by' => auth()->id(),
            ]);

            \App\Services\AuditLogService::log('REJECT_ORDER', 'Pemesanan', "Supir menolak tugas #{$order->kode_order}", auth()->id());
            session()->flash('warning', 'Tugas berhasil ditolak.');
        }
    }

    public function render()
    {
        $user = auth()->user();
        $supir = $user?->supir;

        // Pastikan record supir tersedia jika user ber-role supir
        if (!$supir && $user && $user->isSupir()) {
            $supir = Supir::firstOrCreate(['user_id' => $user->id], [
                'no_wa' => $user->phone ?? '',
                'status_online' => true,
            ]);
        }

        // Ambil pesanan yang ditugaskan khusus untuk supir ini tapi belum dikonfirmasi
        $assignedOrders = collect();
        if ($supir) {
            $assignedOrders = Pemesanan::with(['user', 'rumahSakit'])
                ->where('supir_id', $supir->id)
                ->where('status', 'menunggu_konfirmasi_supir')
                ->latest()
                ->get();
        }

        // Ambil pesanan darurat yang masih menunggu supir (unassigned)
        $openOrders = Pemesanan::with(['user', 'rumahSakit'])
            ->where('status', 'menunggu')
            ->whereNull('supir_id')
            ->latest()
            ->get();

        // Ambil riwayat tugas yang sudah selesai
        $completedOrders = collect();
        if ($supir) {
            $completedOrders = Pemesanan::with(['user', 'rumahSakit', 'rating'])
                ->where('supir_id', $supir->id)
                ->where('status', 'selesai')
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        $isOnline = $supir ? (bool) $supir->status_online : false;

        return view('livewire.supir.tugas-index', [
            'assignedOrders' => $assignedOrders,
            'openOrders' => $openOrders,
            'completedOrders' => $completedOrders,
            'isOnline' => $isOnline,
        ])->layout('layouts.app');
    }
}
