<?php

namespace App\Livewire\Masyarakat;

use App\Models\RumahSakit;
use App\Models\SettingAplikasi;
use App\Services\PemesananService;
use Livewire\Component;

class OrderCreate extends Component
{
    public string $nama_pasien = '';
    public string $kondisi_pasien = '';
    public string $lokasi_jemput = '';
    public float $jemput_lat = -7.7188;
    public float $jemput_lng = 109.0159;
    public ?int $rumah_sakit_id = null;
    public string $catatan_tambahan = '';

    protected $rules = [
        'nama_pasien' => 'required|string|max:100',
        'kondisi_pasien' => 'required|string|max:255',
        'lokasi_jemput' => 'required|string|max:255',
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

        // Set default nama pasien dengan nama user jika mau
        if (auth()->check()) {
            $this->nama_pasien = auth()->user()->name;
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
            'kondisi_pasien' => $this->kondisi_pasien,
            'lokasi_jemput' => $this->lokasi_jemput,
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
