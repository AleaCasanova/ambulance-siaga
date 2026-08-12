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

        return view('livewire.supir.dashboard', [
            'supir' => $supir,
            'activeOrder' => $activeOrder,
        ]);
    }
}

