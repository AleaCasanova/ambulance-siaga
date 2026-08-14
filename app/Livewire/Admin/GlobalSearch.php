<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pemesanan;
use App\Models\Ambulans;
use App\Models\User;
use App\Models\RumahSakit;
use App\Models\Donasi;

class GlobalSearch extends Component
{
    public $query = '';
    
    public function render()
    {
        $results = [];

        if (strlen($this->query) >= 2) {
            $search = '%' . $this->query . '%';

            // 1. Pemesanan (Pesanan Masuk)
            $orders = Pemesanan::with(['user', 'ambulans'])
                ->where('kode_order', 'like', $search)
                ->orWhereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', $search);
                })
                ->limit(5)
                ->get();
            if ($orders->isNotEmpty()) {
                $results['Pemesanan / Layanan'] = $orders;
            }

            // 2. Ambulans (Armada)
            $ambulans = Ambulans::where('plat_nomor', 'like', $search)
                ->orWhere('kode_ambulans', 'like', $search)
                ->limit(5)
                ->get();
            if ($ambulans->isNotEmpty()) {
                $results['Armada Ambulans'] = $ambulans;
            }

            // 3. User (Supir & Pengguna)
            $users = User::where('name', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->limit(5)
                ->get();
            if ($users->isNotEmpty()) {
                $results['Pengguna & Supir'] = $users;
            }

            // 4. Rumah Sakit
            $rumahsakit = RumahSakit::where('nama', 'like', $search)
                ->limit(5)
                ->get();
            if ($rumahsakit->isNotEmpty()) {
                $results['Rumah Sakit Mitra'] = $rumahsakit;
            }

            // 5. Donasi (Transaksi)
            $donasi = Donasi::where('nama', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('id', 'like', $search)
                ->limit(5)
                ->get();
            if ($donasi->isNotEmpty()) {
                $results['Transaksi Donasi'] = $donasi;
            }
        }

        return view('livewire.admin.global-search', [
            'results' => $results,
            'query' => $this->query
        ]);
    }
}
