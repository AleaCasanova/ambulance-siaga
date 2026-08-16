<?php

namespace App\Livewire\Supir;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\Rating;
use App\Models\RumahSakit;
use App\Models\StatusPerjalanan;
use App\Models\Supir;
use Livewire\Component;

class Dashboard extends Component
{
    public bool $isOnline = false;

    public function mount()
    {
        $user = auth()->user();
        if ($user && !$user->supir && $user->isSupir()) {
            Supir::firstOrCreate(['user_id' => $user->id], [
                'no_wa' => $user->phone ?? '',
                'status_online' => true,
            ]);
            $user->refresh();
        }
        if ($user && $user->supir) {
            $this->isOnline = (bool) $user->supir->status_online;
        }
    }

    public function toggleOnline()
    {
        $user = auth()->user();
        if ($user && !$user->supir && $user->isSupir()) {
            Supir::firstOrCreate(['user_id' => $user->id], [
                'no_wa' => $user->phone ?? '',
                'status_online' => true,
            ]);
            $user->refresh();
        }
        if ($user && $user->supir) {
            $this->isOnline = !$this->isOnline;
            $user->supir->update(['status_online' => $this->isOnline]);
            session()->flash('success', $this->isOnline ? 'Status Anda sekarang ONLINE (Siaga Menerima Tugas).' : 'Status Anda sekarang OFFLINE (Istirahat).');
        }
    }

    public function render()
    {
        $user = auth()->user();
        $supir = $user?->supir;

        // 1. Tugas aktif saat ini (jika ada)
        $activeOrder = null;
        if ($supir) {
            $activeOrder = Pemesanan::with(['user', 'ambulans', 'rumahSakit'])
                ->where('supir_id', $supir->id)
                ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
                ->latest()
                ->first();
        }

        // 2. Metrik Operasional Harian & Keseluruhan
        $todayCompletedCount = 0;
        $totalCompletedCount = 0;
        $recentReviews = collect();
        $recentCompletedOrders = collect();

        if ($supir) {
            $todayCompletedCount = Pemesanan::where('supir_id', $supir->id)
                ->where('status', 'selesai')
                ->whereDate('updated_at', today())
                ->count();

            $totalCompletedCount = Pemesanan::where('supir_id', $supir->id)
                ->where('status', 'selesai')
                ->count();

            $recentReviews = Rating::where('supir_id', $supir->id)
                ->with(['user', 'pemesanan'])
                ->latest()
                ->take(3)
                ->get();

            $recentCompletedOrders = Pemesanan::where('supir_id', $supir->id)
                ->where('status', 'selesai')
                ->with(['rumahSakit', 'rating'])
                ->latest('updated_at')
                ->take(4)
                ->get();
        }

        // 3. Pesanan menunggu tindakan (antrean baru)
        $pendingOrdersCount = Pemesanan::where(function ($q) use ($supir) {
            if ($supir) {
                $q->where('supir_id', $supir->id)
                  ->where('status', 'menunggu_konfirmasi_supir');
            }
        })->orWhere(function ($q) {
            $q->where('status', 'menunggu')
              ->whereNull('supir_id');
        })->count();

        // 4. Daftar IGD Rumah Sakit Rujukan Terdekat
        $rumahSakitList = RumahSakit::select('nama', 'alamat', 'telepon', 'kapasitas_igd')
            ->take(3)
            ->get();

        return view('livewire.supir.dashboard', [
            'supir' => $supir,
            'activeOrder' => $activeOrder,
            'todayCompletedCount' => $todayCompletedCount,
            'totalCompletedCount' => $totalCompletedCount,
            'pendingOrdersCount' => $pendingOrdersCount,
            'recentReviews' => $recentReviews,
            'recentCompletedOrders' => $recentCompletedOrders,
            'rumahSakitList' => $rumahSakitList,
        ]);
    }
}
