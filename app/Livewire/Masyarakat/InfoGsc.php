<?php

namespace App\Livewire\Masyarakat;

use App\Models\RumahSakit;
use App\Models\SettingAplikasi;
use Livewire\Component;

class InfoGsc extends Component
{
    public function render()
    {
        $namaOrg = SettingAplikasi::getVal('nama_organisasi', 'Ambulance Siaga');
        $telepon = SettingAplikasi::getVal('telepon_darurat', '0812-3456-7890');
        $email = SettingAplikasi::getVal('email_organisasi', 'info@ambulancesiaga.org');
        $alamat = SettingAplikasi::getVal('alamat_kantor', 'Pusat Koordinasi Layanan Ambulance Siaga');
        $tentang = SettingAplikasi::getVal('tentang_gsc', 'Ambulance Siaga adalah sistem pelayanan ambulans darurat gratis yang mempertemukan masyarakat yang membutuhkan evakuasi medis dengan jaringan armada ambulans dari berbagai mitra kepedulian sosial, lembaga kemanusiaan, dan fasilitas kesehatan. Cepat, tanggap, dan profesional 24 Jam.');

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
