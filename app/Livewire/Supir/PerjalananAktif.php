<?php

namespace App\Livewire\Supir;

use App\Models\Pemesanan;
use Livewire\Component;

class PerjalananAktif extends Component
{
    public function render()
    {
        $user = auth()->user();
        $supir = $user->supir;

        $activeOrder = null;
        if ($supir) {
            $activeOrder = Pemesanan::with(['user', 'ambulans', 'rumahSakit'])
                ->where('supir_id', $supir->id)
                ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
                ->latest()
                ->first();
        }

        if ($activeOrder) {
            // Jika ada perjalanan aktif, alihkan langsung ke halaman OrderShow (tracking)
            return redirect()->route('supir.orders.show', $activeOrder->id);
        }

        return view('livewire.supir.perjalanan-aktif')->layout('layouts.app');
    }
}
