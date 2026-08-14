<?php

namespace App\Livewire\Masyarakat;

use App\Models\Ambulans;
use App\Models\Masyarakat;
use App\Models\Pemesanan;
use App\Models\RumahSakit;
use App\Models\SettingAplikasi;
use Livewire\Component;

class Dashboard extends Component
{
    // Properti Edit Cepat Profil Darurat (ICE)
    public bool $showEditIceModal = false;
    public string $ice_nik = '';
    public string $ice_alamat = '';
    public string $ice_kontak_darurat = '';
    public string $ice_tanggal_lahir = '';
    public string $ice_jenis_kelamin = 'L';

    public function mount()
    {
        $user = auth()->user();
        if ($user) {
            $m = $user->masyarakat;
            if ($m) {
                $this->ice_nik = (string) ($m->nik ?? '');
                $this->ice_alamat = (string) ($m->alamat ?? '');
                $this->ice_kontak_darurat = (string) ($m->kontak_darurat ?? '');
                $this->ice_tanggal_lahir = $m->tanggal_lahir ? $m->tanggal_lahir->format('Y-m-d') : '';
                $this->ice_jenis_kelamin = (string) ($m->jenis_kelamin ?? 'L');
            }
        }
    }

    public function saveIceProfile()
    {
        $user = auth()->user();
        if (!$user) return;

        $this->validate([
            'ice_nik' => 'nullable|string|max:20',
            'ice_alamat' => 'nullable|string|max:255',
            'ice_kontak_darurat' => 'nullable|string|max:20',
            'ice_tanggal_lahir' => 'nullable|date',
            'ice_jenis_kelamin' => 'nullable|in:L,P',
        ]);

        Masyarakat::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nik' => $this->ice_nik,
                'alamat' => $this->ice_alamat,
                'kontak_darurat' => $this->ice_kontak_darurat,
                'tanggal_lahir' => $this->ice_tanggal_lahir ?: null,
                'jenis_kelamin' => $this->ice_jenis_kelamin,
            ]
        );

        $this->showEditIceModal = false;
        session()->flash('success', 'Data Medis & Kontak Darurat berhasil disimpan! Data ini akan otomatis terisi saat Anda memesan ambulans darurat.');
    }

    public function render()
    {
        $user = auth()->user();

        // 1. Pesanan Darurat yang Sedang Berjalan (Active / Ongoing)
        $activeOrder = null;
        if ($user) {
            $activeOrder = Pemesanan::with(['supir.user', 'ambulans', 'rumahSakit', 'latestTracking'])
                ->where('user_id', $user->id)
                ->whereIn('status', ['menunggu', 'menunggu_konfirmasi_supir', 'diproses', 'menuju_lokasi', 'membawa_pasien'])
                ->latest('id')
                ->first();
        }

        // 2. Riwayat Singkat (3 Terakhir)
        $recentOrders = collect();
        if ($user) {
            $recentOrders = Pemesanan::with(['supir.user', 'ambulans', 'rumahSakit', 'rating'])
                ->where('user_id', $user->id)
                ->latest('id')
                ->take(3)
                ->get();
        }

        // 3. Faskes / Rumah Sakit Siaga
        $rumahSakits = RumahSakit::orderBy('nama', 'asc')->get();

        // 4. Pengaturan Hotline
        $teleponDarurat = SettingAplikasi::getVal('telepon_darurat', '0812-3456-7890');
        $namaOrg = SettingAplikasi::getVal('nama_organisasi', 'Ambulance Siaga GSC');

        // 5. Total Armada & Siaga
        $totalAmbulans = Ambulans::count();
        $ambulansTersedia = Ambulans::where('status', 'Tersedia')->count();

        return view('livewire.masyarakat.dashboard', [
            'user' => $user,
            'activeOrder' => $activeOrder,
            'recentOrders' => $recentOrders,
            'rumahSakits' => $rumahSakits,
            'teleponDarurat' => $teleponDarurat,
            'namaOrg' => $namaOrg,
            'totalAmbulans' => $totalAmbulans,
            'ambulansTersedia' => $ambulansTersedia,
        ])->layout('layouts.blank');
    }
}
