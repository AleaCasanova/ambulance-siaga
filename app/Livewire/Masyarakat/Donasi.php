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

    public function updatedIsAnonim($value)
    {
        if ($value) {
            $this->nama = 'Hamba Allah';
        } else {
            $this->nama = '';
        }
    }

    public function kirimDonasi()
    {
        $this->validate([
            'nama' => 'required',
            'nominal' => 'required',
        ]);

        $nominalDonasi = $this->nominal == 'lainnya' ? $this->nominalLainnya : $this->nominal;

        if (!$nominalDonasi || $nominalDonasi < 10000) {
            $this->addError('nominal', 'Minimal donasi adalah Rp 10.000');
            return;
        }

        $donasi = \App\Models\Donasi::create([
            'nama' => $this->nama,
            'is_anonim' => $this->isAnonim,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'pesan' => $this->pesan,
            'nominal' => $nominalDonasi,
            'status' => 'pending',
        ]);

        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $donasi->id,
                'gross_amount' => $nominalDonasi,
            ),
            'customer_details' => array(
                'first_name' => $this->nama,
                'email' => $this->email ?? 'donatur@example.com',
                'phone' => $this->whatsapp,
            ),
        );

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $donasi->update(['snap_token' => $snapToken]);
            
            $this->dispatch('snap-token-created', token: $snapToken);
        } catch (\Exception $e) {
            $this->addError('nominal', 'Terjadi kesalahan saat menghubungi Midtrans: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.masyarakat.donasi')->layout('layouts.blank');
    }
}
