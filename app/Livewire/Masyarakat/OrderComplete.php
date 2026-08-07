<?php

namespace App\Livewire\Masyarakat;

use App\Models\Pemesanan;
use App\Models\RumahSakit;
use Carbon\Carbon;
use Livewire\Component;

class OrderComplete extends Component
{
    public Pemesanan $order;

    // 1. DATA PASIEN & KONTAK PENDAMPING
    public string $nama_pasien = '';
    public string $nik_pasien = '';
    public string $usia_pasien = '';
    public string $no_hp_kontak = '';
    public int $jumlah_pendamping = 1;

    // 2. KONDISI & KEPERLUAN AMBULANS
    public string $keperluan_penggunaan = 'Kontrol Rutin';
    public string $keperluan_lainnya = '';
    public string $diagnosa_medis = '';
    public string $kondisi_pasien = '';

    // 3. JADWAL & ALAMAT PENJEMPUTAN / PENGANTARAN
    public string $tanggal_jemput = '';
    public string $jam_jemput = '';
    public string $lokasi_jemput = '';
    public float $jemput_lat = 0.0;
    public float $jemput_lng = 0.0;
    public ?int $rumah_sakit_id = null;
    public string $tujuan_lokasi = '';
    public string $catatan_tambahan = '';

    protected $rules = [
        'nama_pasien' => 'required|string|max:100',
        'nik_pasien' => 'required|string|max:30',
        'usia_pasien' => 'required|string|max:30',
        'no_hp_kontak' => 'required|string|max:30',
        'jumlah_pendamping' => 'required|integer|min:1|max:10',
        'keperluan_penggunaan' => 'required|string|max:100',
        'diagnosa_medis' => 'nullable|string|max:255',
        'kondisi_pasien' => 'required|string|max:500',
        'tanggal_jemput' => 'required|date',
        'jam_jemput' => 'required|string|max:20',
        'lokasi_jemput' => 'required|string|max:255',
        'tujuan_lokasi' => 'required|string|max:255',
        'rumah_sakit_id' => 'nullable|exists:rumah_sakit,id',
        'catatan_tambahan' => 'nullable|string|max:500',
    ];

    public function mount($id)
    {
        $this->order = Pemesanan::with(['rumahSakit', 'user'])->findOrFail($id);

        // Jika user yang baru login belum terikat di order, otomatis hubungkan ke user_id
        if (auth()->check() && null === $this->order->user_id) {
            $this->order->update(['user_id' => auth()->id()]);
        }

        $user = auth()->user();

        // Populate dari order yang sudah ada atau dari profil user
        $this->nama_pasien = $this->order->nama_pasien ?: ($user?->name ?? '');
        $this->nik_pasien = (string) ($this->order->nik_pasien ?: ($user?->masyarakat?->nik ?? ''));

        if ($this->order->usia_pasien) {
            $this->usia_pasien = $this->order->usia_pasien;
        } elseif ($user?->masyarakat?->tanggal_lahir) {
            try {
                $this->usia_pasien = Carbon::parse($user->masyarakat->tanggal_lahir)->age . ' Tahun';
            } catch (\Exception $e) {
                $this->usia_pasien = '';
            }
        } else {
            $this->usia_pasien = '';
        }

        $this->no_hp_kontak = (string) ($this->order->no_hp_kontak ?: ($user?->phone ?? ''));
        $this->jumlah_pendamping = (int) ($this->order->jumlah_pendamping ?: 1);

        // Keperluan penggunaan
        $kep = $this->order->keperluan_penggunaan ?: 'Kontrol Rutin';
        if (str_starts_with($kep, 'Lainnya: ') || str_starts_with($kep, 'Lainnya - ')) {
            $this->keperluan_penggunaan = 'Lainnya';
            $this->keperluan_lainnya = trim(preg_replace('/^Lainnya[:\-]\s*/i', '', $kep));
        } elseif (in_array($kep, ['Kontrol Rutin', 'IGD', 'IGD Darurat', 'Pulang Rawat Inap'])) {
            $this->keperluan_penggunaan = ($kep === 'IGD Darurat' ? 'IGD' : $kep);
        } else {
            $this->keperluan_penggunaan = 'Kontrol Rutin';
        }

        $this->diagnosa_medis = $this->order->diagnosa_medis === '-' ? '' : (string) $this->order->diagnosa_medis;
        $this->kondisi_pasien = (string) $this->order->kondisi_pasien;

        $this->tanggal_jemput = $this->order->tanggal_jemput ? Carbon::parse($this->order->tanggal_jemput)->format('Y-m-d') : now()->format('Y-m-d');
        $this->jam_jemput = $this->order->jam_jemput ?: now()->format('H:i');

        $this->lokasi_jemput = (string) $this->order->lokasi_jemput;
        $this->jemput_lat = (float) $this->order->jemput_lat;
        $this->jemput_lng = (float) $this->order->jemput_lng;

        $this->rumah_sakit_id = $this->order->rumah_sakit_id ? (int) $this->order->rumah_sakit_id : null;
        $this->tujuan_lokasi = (string) ($this->order->tujuan_lokasi ?: '');
        $this->catatan_tambahan = (string) ($this->order->catatan_tambahan ?: '');
    }

    public function updatedRumahSakitId($val)
    {
        if ($val) {
            $rs = RumahSakit::find($val);
            if ($rs) {
                $this->tujuan_lokasi = $rs->nama . ' - ' . $rs->alamat;
            }
        }
    }

    public function saveCompleteOrder()
    {
        $this->rumah_sakit_id = !empty($this->rumah_sakit_id) ? (int) $this->rumah_sakit_id : null;

        $this->validate();

        $keperluan = $this->keperluan_penggunaan;
        if ($keperluan === 'Lainnya') {
            $keperluan = 'Lainnya: ' . ($this->keperluan_lainnya ?: 'Tidak disebutkan');
        }

        $this->order->update([
            'nama_pasien' => $this->nama_pasien,
            'nik_pasien' => $this->nik_pasien,
            'usia_pasien' => $this->usia_pasien,
            'no_hp_kontak' => $this->no_hp_kontak,
            'jumlah_pendamping' => $this->jumlah_pendamping,
            'keperluan_penggunaan' => $keperluan,
            'diagnosa_medis' => $this->diagnosa_medis ?: '-',
            'kondisi_pasien' => $this->kondisi_pasien,
            'tanggal_jemput' => $this->tanggal_jemput,
            'jam_jemput' => $this->jam_jemput,
            'lokasi_jemput' => $this->lokasi_jemput,
            'jemput_lat' => $this->jemput_lat,
            'jemput_lng' => $this->jemput_lng,
            'rumah_sakit_id' => $this->rumah_sakit_id,
            'tujuan_lokasi' => $this->tujuan_lokasi,
            'catatan_tambahan' => $this->catatan_tambahan,
            'is_form_complete' => true,
        ]);

        session()->forget(['pending_order_id', 'pending_order_code', 'url.intended']);

        session()->flash('success', 'Formulir kebutuhan ambulans berhasil dilengkapi dan disimpan!');

        return redirect()->route('masyarakat.tracking', $this->order->id);
    }

    public function render()
    {
        $rumahSakits = RumahSakit::orderBy('nama', 'asc')->get();

        return view('livewire.masyarakat.order-complete', [
            'rumahSakits' => $rumahSakits,
        ])->layout('layouts.blank');
    }
}
