<?php

namespace App\Livewire\Admin;

use App\Models\SettingAplikasi;
use Livewire\Component;

class SettingIndex extends Component
{
    public string $nama_organisasi = '';
    public string $telepon_darurat = '';
    public string $email_organisasi = '';
    public string $alamat_kantor = '';
    public string $default_lat = '';
    public string $default_lng = '';
    public string $tentang_gsc = '';

    protected $rules = [
        'nama_organisasi' => 'required|string|max:150',
        'telepon_darurat' => 'required|string|max:30',
        'email_organisasi' => 'required|email|max:100',
        'alamat_kantor' => 'required|string|max:255',
        'default_lat' => 'required|numeric',
        'default_lng' => 'required|numeric',
        'tentang_gsc' => 'nullable|string|max:1000',
    ];

    public function mount()
    {
        $this->nama_organisasi = SettingAplikasi::getVal('nama_organisasi', 'Ambulance Siaga');
        $this->telepon_darurat = SettingAplikasi::getVal('telepon_darurat', '0812-3456-7890');
        $this->email_organisasi = SettingAplikasi::getVal('email_organisasi', 'info@ambulancesiaga.org');
        $this->alamat_kantor = SettingAplikasi::getVal('alamat_kantor', 'Pusat Koordinasi Layanan Ambulance Siaga');
        $this->default_lat = (string) SettingAplikasi::getVal('default_lat', '-7.7188');
        $this->default_lng = (string) SettingAplikasi::getVal('default_lng', '109.0159');
        $this->tentang_gsc = SettingAplikasi::getVal('tentang_gsc', 'Ambulance Siaga adalah platform digital layanan darurat medis dan transportasi kemanusiaan yang terintegrasi dengan berbagai mitra penyedia ambulans, rumah sakit, dan lembaga kemanusiaan untuk melayani masyarakat secara gratis, cepat, dan profesional 24 Jam.');
    }

    public function saveSettings()
    {
        $this->validate();

        SettingAplikasi::setVal('nama_organisasi', $this->nama_organisasi, 'string', 'Nama organisasi');
        SettingAplikasi::setVal('telepon_darurat', $this->telepon_darurat, 'string', 'Hotline darurat');
        SettingAplikasi::setVal('email_organisasi', $this->email_organisasi, 'string', 'Email organisasi');
        SettingAplikasi::setVal('alamat_kantor', $this->alamat_kantor, 'string', 'Alamat kantor sekretariat');
        SettingAplikasi::setVal('default_lat', $this->default_lat, 'string', 'Default latitude peta Cilacap');
        SettingAplikasi::setVal('default_lng', $this->default_lng, 'string', 'Default longitude peta Cilacap');
        SettingAplikasi::setVal('tentang_gsc', $this->tentang_gsc, 'text', 'Deskripsi Sistem Ambulance Siaga');

        session()->flash('success', 'Konfigurasi sistem Ambulance Siaga berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.setting-index')->layout('layouts.admin');
    }
}
