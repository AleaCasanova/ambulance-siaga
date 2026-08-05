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
        $this->lokasi_jemput = '';
        $this->tujuan_lokasi = 'Ditentukan Dispatcher (RS Rujukan Terdekat)';
        $this->tanggal_jemput = now()->format('Y-m-d');
        $this->jam_jemput = now()->format('H:i');

        if (auth()->check()) {
            $user = auth()->user();
            $this->nama_pasien = $user->name;
            $this->no_hp_kontak = (string) ($user->phone ?? '');
            $this->nik_pasien = (string) ($user->masyarakat?->nik ?? '');
            if ($user->masyarakat?->tanggal_lahir) {
                try {
                    $this->usia_pasien = \Carbon\Carbon::parse($user->masyarakat->tanggal_lahir)->age . ' Tahun';
                } catch (\Exception $e) {
                    $this->usia_pasien = '-';
                }
            }
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
        $this->rumah_sakit_id = !empty($this->rumah_sakit_id) ? (int) $this->rumah_sakit_id : null;

        $this->validate();

        $data = [
            'nama_pasien' => $this->nama_pasien,
            'nik_pasien' => $this->nik_pasien ?: null,
            'usia_pasien' => $this->usia_pasien ?: null,
            'no_hp_kontak' => $this->no_hp_kontak ?: null,
            'jumlah_pendamping' => 1,
            'keperluan_penggunaan' => 'IGD Darurat',
            'diagnosa_medis' => '-',
            'kondisi_pasien' => $this->kondisi_pasien,
            'tanggal_jemput' => now()->format('Y-m-d'),
            'jam_jemput' => now()->format('H:i'),
            'lokasi_jemput' => $this->lokasi_jemput,
            'tujuan_lokasi' => $this->tujuan_lokasi ?: 'Ditentukan Dispatcher (RS Rujukan Terdekat)',
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

        session()->put('pending_order_id', $order->id);
        session()->put('pending_order_code', $order->kode_order);
        session()->put('url.intended', route('masyarakat.order.complete', $order->id));

        if (!auth()->check()) {
            session()->flash('info', 'Pesanan ambulans darurat Anda (#' . $order->kode_order . ') berhasil dikirim ke armada! Silakan Login atau Daftar untuk melengkapi formulir kebutuhan medis pasien.');
            return redirect()->route('login');
        }

        session()->flash('success', 'Pesanan ambulans darurat berhasil dikirim ke armada! Silakan lengkapi formulir kebutuhan ambulans di bawah ini.');
        return redirect()->route('masyarakat.order.complete', $order->id);
    }

    public function render()
    {
        $rumahSakits = RumahSakit::orderBy('nama', 'asc')->get();

        return view('livewire.masyarakat.order-create', [
            'rumahSakits' => $rumahSakits,
        ]);
    }
}
