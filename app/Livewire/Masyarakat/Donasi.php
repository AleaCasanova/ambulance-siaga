<?php

namespace App\Livewire\Masyarakat;

use Livewire\Component;
use App\Models\Donasi as DonasiModel;
use App\Models\Rating;

class Donasi extends Component
{
    // Form Donasi
    public $sapaan = 'Bapak';
    public $nama;
    public $isAnonim = false;
    public $email;
    public $whatsapp;
    public $pesan;
    public $nominal = 100000;
    public $nominalLainnya;

    // Form Umpan Balik / Ulasan
    public $feedbackNama;
    public $feedbackPeran = 'Donatur';
    public $feedbackLokasi;
    public $feedbackSkor = 5;
    public $feedbackPesan;
    public $feedbackSuccessMessage = null;

    // State Modal & Media
    public $showAllDonaturModal = false;
    public $activeVideo = 1;

    public function updatedIsAnonim($value)
    {
        if ($value) {
            $this->nama = 'Hamba Allah';
        } else {
            $this->nama = '';
        }
    }

    public function toggleAllDonaturModal()
    {
        $this->showAllDonaturModal = !$this->showAllDonaturModal;
    }

    public function setVideo($index)
    {
        $this->activeVideo = $index;
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

        $donasi = DonasiModel::create([
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

    public function kirimUmpanBalik()
    {
        $this->validate([
            'feedbackNama' => 'required|min:3|max:100',
            'feedbackPeran' => 'required',
            'feedbackPesan' => 'required|min:5|max:500',
            'feedbackSkor' => 'required|integer|min:1|max:5',
        ], [
            'feedbackNama.required' => 'Nama lengkap / inisial wajib diisi.',
            'feedbackPesan.required' => 'Pesan testimoni / umpan balik wajib diisi.',
            'feedbackPesan.min' => 'Pesan minimal 5 karakter.',
        ]);

        Rating::create([
            'nama_pengirim' => $this->feedbackNama,
            'peran_pengirim' => $this->feedbackPeran,
            'asal_kota' => $this->feedbackLokasi ?: 'Indonesia',
            'skor' => $this->feedbackSkor,
            'ulasan' => $this->feedbackPesan,
            'user_id' => auth()->check() ? auth()->id() : null,
        ]);

        $this->reset(['feedbackNama', 'feedbackLokasi', 'feedbackPesan']);
        $this->feedbackSkor = 5;
        $this->feedbackSuccessMessage = 'Jazakallah Khairan! Terima kasih, pesan dan umpan balik Anda berhasil dikirim.';
    }

    public function render()
    {
        $donaturList = DonasiModel::where('status', 'success')
            ->latest()
            ->take(6)
            ->get();

        $allDonaturList = $this->showAllDonaturModal 
            ? DonasiModel::where('status', 'success')->latest()->get()
            : collect();

        $totalDonasi = DonasiModel::where('status', 'success')->sum('nominal');
        $totalDonaturCount = DonasiModel::where('status', 'success')->count();

        $testimoniList = Rating::whereNotNull('ulasan')
            ->latest()
            ->take(6)
            ->get();

        $averageRating = round(Rating::avg('skor') ?: 5.0, 1);
        $totalRatingCount = Rating::whereNotNull('ulasan')->count();

        return view('livewire.masyarakat.donasi', [
            'donaturList' => $donaturList,
            'allDonaturList' => $allDonaturList,
            'totalDonasi' => $totalDonasi,
            'totalDonaturCount' => $totalDonaturCount,
            'testimoniList' => $testimoniList,
            'averageRating' => $averageRating,
            'totalRatingCount' => $totalRatingCount,
        ])->layout('layouts.blank');
    }
}
