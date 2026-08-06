<?php

namespace App\Livewire\Masyarakat;

use Livewire\Component;

class Donasi extends Component
{
    public $sapaan = 'Bapak';
    public $nama;
    public $isAnonim = false;
    public $email;
    public $whatsapp;
    public $pesan;
    
    public $nominal = 100000;
    public $nominalLainnya;
    
    public $metodePembayaran = 'qris';

    public function updatedIsAnonim($value)
    {
        if ($value) {
            $this->nama = 'Hamba Allah';
        } else {
            $this->nama = '';
        }
    }

    public function render()
    {
        return view('livewire.masyarakat.donasi')->layout('layouts.blank');
    }
}
