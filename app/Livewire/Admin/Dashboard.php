<?php

namespace App\Livewire\Admin;

use App\Models\Ambulans;
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

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'chartStatus' => $chartStatus,
            'months' => $months,
            'chartMonthly' => $chartMonthly,
            'recentOrders' => $recentOrders,
            'recentLogs' => $recentLogs,
        ]);
    }
}
