<?php

namespace App\Livewire\Masyarakat;

use App\Models\RumahSakit;
use App\Models\SettingAplikasi;
use App\Services\PemesananService;
use Livewire\Component;

class OrderCreate extends Component
{
    public string $nama_pasien = '';
    public string $nik_pasien = '';
    public string $usia_pasien = '';
    public string $no_hp_kontak = '';
    public int $jumlah_pendamping = 1;
    public string $keperluan_penggunaan = 'IGD Darurat';
    public string $diagnosa_medis = '';
    public string $kondisi_pasien = '';
    public string $tanggal_jemput = '';
    public string $jam_jemput = '';
    public string $lokasi_jemput = '';
    public string $tujuan_lokasi = '';
    public float $jemput_lat = -7.7188;
    public float $jemput_lng = 109.0159;
    public ?int $rumah_sakit_id = null;
    public string $catatan_tambahan = '';

    protected $rules = [
        'nama_pasien' => 'required|string|max:100',
        'nik_pasien' => 'required|string|max:30',
        'usia_pasien' => 'required|string|max:30',
        'no_hp_kontak' => 'required|string|max:30',
        'jumlah_pendamping' => 'required|integer|min:0|max:10',
        'keperluan_penggunaan' => 'required|string|max:150',
        'diagnosa_medis' => 'nullable|string|max:255',
        'kondisi_pasien' => 'required|string|max:255',
        'tanggal_jemput' => 'required|date',
        'jam_jemput' => 'required|string|max:20',
        'lokasi_jemput' => 'required|string|max:255',
        'tujuan_lokasi' => 'required|string|max:255',
        'jemput_lat' => 'required|numeric',
        'jemput_lng' => 'required|numeric',
        'rumah_sakit_id' => 'nullable|exists:rumah_sakit,id',
        'catatan_tambahan' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $defaultLat = (float) SettingAplikasi::getVal('default_lat', -7.7188);
        $defaultLng = (float) SettingAplikasi::getVal('default_lng', 109.0159);

        $this->jemput_lat = $defaultLat;
        $this->jemput_lng = $defaultLng;
        $this->lokasi_jemput = 'Jl. Raya Cilacap, Kabupaten Cilacap';
        $this->tujuan_lokasi = 'RSUD Cilacap - Jl. Gatot Subroto No.28';
        $this->tanggal_jemput = now()->format('Y-m-d');
        $this->jam_jemput = now()->format('H:i');

        if (auth()->check()) {
            $user = auth()->user();
            $this->nama_pasien = $user->name;
            $this->no_hp_kontak = (string) $user->phone;
            $this->nik_pasien = (string) ($user->masyarakat?->nik ?? '');
        }
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

    public function updateCoordinates($lat, $lng, $address = null)
    {
        $this->jemput_lat = (float) $lat;
        $this->jemput_lng = (float) $lng;
        if ($address) {
            $this->lokasi_jemput = $address;
        }
    }

    public function submitOrder(PemesananService $service)
    {
        $this->validate();

        $data = [
            'nama_pasien' => $this->nama_pasien,
            'nik_pasien' => $this->nik_pasien,
            'usia_pasien' => $this->usia_pasien,
            'no_hp_kontak' => $this->no_hp_kontak,
            'jumlah_pendamping' => $this->jumlah_pendamping,
            'keperluan_penggunaan' => $this->keperluan_penggunaan,
            'diagnosa_medis' => $this->diagnosa_medis,
            'kondisi_pasien' => $this->kondisi_pasien,
            'tanggal_jemput' => $this->tanggal_jemput,
            'jam_jemput' => $this->jam_jemput,
            'lokasi_jemput' => $this->lokasi_jemput,
            'tujuan_lokasi' => $this->tujuan_lokasi,
            'jemput_lat' => $this->jemput_lat,
            'jemput_lng' => $this->jemput_lng,
            'rumah_sakit_id' => $this->rumah_sakit_id,
            'catatan_tambahan' => $this->catatan_tambahan,
        ];

        if ($this->rumah_sakit_id) {
            $rs = RumahSakit::find($this->rumah_sakit_id);
            if ($rs) {
                $data['tujuan_lokasi'] = $rs->nama . ' - ' . $rs->alamat;
                $data['tujuan_lat'] = $rs->lat;
                $data['tujuan_lng'] = $rs->lng;
            }
        }

        $order = $service->createOrder($data, auth()->id());

        session()->flash('success', 'Pesanan ambulans berhasil dikirim! Armada sedang dipersiapkan.');

        return redirect()->route('masyarakat.tracking', $order->id);
    }

    public function render()
    {
        $rumahSakits = RumahSakit::orderBy('nama', 'asc')->get();

        return view('livewire.masyarakat.order-create', [
            'rumahSakits' => $rumahSakits,
        ]);
    }
}
