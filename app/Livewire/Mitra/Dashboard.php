<?php

namespace App\Livewire\Mitra;

use App\Models\Ambulans;
use App\Models\Mitra;
use App\Models\Pemesanan;
use App\Models\Supir;
use Livewire\Component;

class Dashboard extends Component
{
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

    public function render()
    {
        $mitra = $this->mitra;
        $mitraId = $mitra ? $mitra->id : 0;

        // 1. Stats Armada
        $totalAmbulans = Ambulans::where('mitra_id', $mitraId)->count();
        $ambulansTersedia = Ambulans::where('mitra_id', $mitraId)->where('status', 'Tersedia')->count();
        $ambulansBertugas = Ambulans::where('mitra_id', $mitraId)->where('status', 'Ditugaskan')->count();
        $ambulansPerawatan = Ambulans::where('mitra_id', $mitraId)->where('status', 'Perawatan')->count();

        // 2. Stats Supir
        $totalSupir = Supir::where('mitra_id', $mitraId)->count();
        $supirOnline = Supir::where('mitra_id', $mitraId)->where('status_online', true)->count();

        // 3. Stats Misi / Penugasan
        $totalMisi = Pemesanan::whereHas('ambulans', function ($q) use ($mitraId) {
            $q->where('mitra_id', $mitraId);
        })->where('status', 'selesai')->count();

        $misiBulanIni = Pemesanan::whereHas('ambulans', function ($q) use ($mitraId) {
            $q->where('mitra_id', $mitraId);
        })->where('status', 'selesai')
          ->whereMonth('created_at', now()->month)
          ->whereYear('created_at', now()->year)
          ->count();

        // 4. Riwayat Misi Terbaru (5 Terakhir)
        $recentOrders = Pemesanan::with(['user', 'ambulans', 'supir.user', 'rumahSakit'])
            ->whereHas('ambulans', function ($q) use ($mitraId) {
                $q->where('mitra_id', $mitraId);
            })
            ->latest()
            ->take(5)
            ->get();

        // 5. Driver List
        $driverList = Supir::with(['user', 'jadwal.ambulans'])
            ->where('mitra_id', $mitraId)
            ->take(6)
            ->get();

        // 6. Armada List untuk Radar
        $fleetList = Ambulans::with(['jadwal.supir.user'])
            ->where('mitra_id', $mitraId)
            ->get();

        return view('livewire.mitra.dashboard', [
            'mitra' => $mitra,
            'totalAmbulans' => $totalAmbulans,
            'ambulansTersedia' => $ambulansTersedia,
            'ambulansBertugas' => $ambulansBertugas,
            'ambulansPerawatan' => $ambulansPerawatan,
            'totalSupir' => $totalSupir,
            'supirOnline' => $supirOnline,
            'totalMisi' => $totalMisi,
            'misiBulanIni' => $misiBulanIni,
            'recentOrders' => $recentOrders,
            'driverList' => $driverList,
            'fleetList' => $fleetList,
        ])->layout('layouts.admin');
    }
}
