<?php

namespace App\Livewire\Admin;

use App\Models\Ambulans;
use App\Models\Donasi;
use App\Models\LogAktivitas;
use App\Models\Pemesanan;
use App\Models\RumahSakit;
use App\Models\Supir;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_order' => Pemesanan::count(),
            'order_selesai' => Pemesanan::where('status', 'selesai')->count(),
            'order_darurat' => Pemesanan::where('status', 'menunggu')->count(),
            'total_user' => User::count(),
            'total_ambulans' => Ambulans::count(),
            'total_rs' => RumahSakit::count(),
            'supir_aktif' => Supir::where('status_online', true)->count(),
            'total_donasi' => Donasi::whereIn('status', ['settlement', 'success'])->sum('nominal'),
        ];

        // Rata-rata waktu respon (selisih waktu_pesan dan waktu_respon dalam menit)
        $avgResponseTime = Pemesanan::whereNotNull('waktu_respon')
            ->whereNotNull('waktu_pesan')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, waktu_pesan, waktu_respon)) as avg_time')
            ->value('avg_time') ?? 0;

        $userDistribution = [
            'Admin' => User::whereHas('role', fn($q) => $q->where('name', 'admin'))->count(),
            'Operator' => User::whereHas('role', fn($q) => $q->where('name', 'operator'))->count(),
            'Supir' => User::whereHas('role', fn($q) => $q->where('name', 'supir'))->count(),
            'Masyarakat' => User::whereHas('role', fn($q) => $q->where('name', 'masyarakat'))->count() + User::doesntHave('role')->count(),
        ];

        // Data untuk grafik status pesanan (Pie Chart)
        $chartStatus = [
            'Menunggu' => Pemesanan::where('status', 'menunggu')->count(),
            'Diproses' => Pemesanan::whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])->count(),
            'Selesai' => Pemesanan::where('status', 'selesai')->count(),
            'Dibatalkan' => Pemesanan::where('status', 'dibatalkan')->count(),
        ];

        // Data untuk grafik pemesanan bulanan (Bar Chart) - 6 bulan terakhir
        $months = [];
        $chartMonthly = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $months[] = $monthDate->translatedFormat('M Y');
            $chartMonthly[] = Pemesanan::whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->count();
        }

        $recentOrders = Pemesanan::with(['user', 'ambulans', 'rumahSakit'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $recentLogs = LogAktivitas::with('user')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Data for Live Ambulance Map
        $activeDrivers = Supir::with('user')
            ->whereNotNull('lokasi_terakhir_lat')
            ->whereNotNull('lokasi_terakhir_lng')
            ->get()
            ->map(function($supir) {
                // Determine status pseudo logic based on their active pemesanan
                $activeOrder = Pemesanan::where('supir_id', $supir->id)
                    ->whereIn('status', ['menunggu_konfirmasi_supir', 'diproses', 'menuju_lokasi', 'membawa_pasien'])
                    ->first();
                
                $statusMap = 'Available';
                if ($activeOrder) {
                    $statusMap = $activeOrder->status == 'membawa_pasien' || $activeOrder->status == 'menuju_lokasi' ? 'Emergency' : 'On Duty';
                } elseif (!$supir->status_online) {
                    $statusMap = 'Offline';
                }

                return [
                    'id' => $supir->id,
                    'name' => $supir->user->name ?? 'Driver',
                    'plat_nomor' => $supir->plat_nomor,
                    'lat' => $supir->lokasi_terakhir_lat,
                    'lng' => $supir->lokasi_terakhir_lng,
                    'status' => $statusMap,
                    'destination' => $activeOrder ? ($activeOrder->rumahSakit->nama ?? $activeOrder->lokasi_tujuan) : '-',
                ];
            });

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'avgResponseTime' => $avgResponseTime,
            'userDistribution' => $userDistribution,
            'chartStatus' => $chartStatus,
            'months' => $months,
            'chartMonthly' => $chartMonthly,
            'recentOrders' => $recentOrders,
            'recentLogs' => $recentLogs,
            'activeDrivers' => $activeDrivers,
        ])->layout('layouts.admin');
    }
}
