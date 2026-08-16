<?php

namespace App\Livewire\Supir;

use App\Models\Pemesanan;
use Livewire\Component;

class PerjalananAktif extends Component
{
    public function mount()
    {
        $user = auth()->user();
        $supir = $user?->supir;

        if ($supir) {
            $activeOrder = Pemesanan::where('supir_id', $supir->id)
                ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
                ->latest()
                ->first();

            if ($activeOrder) {
                $this->redirectRoute('supir.orders.show', ['id' => $activeOrder->id]);
            }
        }
    }

    public function render()
    {
        return view('livewire.supir.perjalanan-aktif')->layout('layouts.app');
    }
}

