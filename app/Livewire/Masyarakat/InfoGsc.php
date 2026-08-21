<?php

namespace App\Livewire\Masyarakat;

use App\Models\RumahSakit;
use App\Models\SettingAplikasi;
use Livewire\Component;

class InfoGsc extends Component
{
    public function render()
    {
        $namaOrg = SettingAplikasi::getVal('nama_organisasi', 'Ambulans Siaga');
        $telepon = SettingAplikasi::getVal('telepon_darurat', '0812-3456-7890');
        $email = SettingAplikasi::getVal('email_organisasi', 'info@ambulansiaga.org');
        $alamat = SettingAplikasi::getVal('alamat_kantor', 'Pusat Koordinasi Layanan Ambulans Siaga');
        $tentang = SettingAplikasi::getVal('tentang_gsc', 'Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis, rujukan, dan gawat darurat secara cepat dan transparan.');

        $rumahSakits = RumahSakit::orderBy('nama', 'asc')->get();

        $totalTerbantu = 2665 + \App\Models\Pemesanan::where('status', 'selesai')->count();
        $totalRelawan = 150 + \App\Models\User::count();
        $totalAmbulans = \App\Models\Ambulans::count();
        $totalRumahSakit = \App\Models\RumahSakit::count();

        return view('livewire.masyarakat.info-gsc', [
            'namaOrg' => $namaOrg,
            'telepon' => $telepon,
            'email' => $email,
            'alamat' => $alamat,
            'tentang' => $tentang,
            'rumahSakits' => $rumahSakits,
            'totalTerbantu' => $totalTerbantu,
            'totalRelawan' => $totalRelawan,
            'totalAmbulans' => $totalAmbulans,
            'totalRumahSakit' => $totalRumahSakit,
        ])->layout('layouts.blank');
    }
}
