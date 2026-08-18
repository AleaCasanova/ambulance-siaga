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

    // Camera Verification Properties
    public ?string $photo_base64 = null;
    public ?float $photo_latitude = null;
    public ?float $photo_longitude = null;
    public ?string $photo_address = null;
    public ?string $photo_district = null;
    public ?string $photo_city = null;
    public ?string $photo_province = null;
    public ?string $photo_country = null;
    public ?string $photo_taken_at = null;
    public ?float $photo_accuracy = null;

    protected $rules = [
        'nama_pasien' => 'required|string|max:100',
        'usia_pasien' => 'required|string|max:30',
        'kondisi_pasien' => 'required|string|max:255',
        'lokasi_jemput' => 'required|string|max:255',
        'jemput_lat' => 'required|numeric',
        'jemput_lng' => 'required|numeric',
        'rumah_sakit_id' => 'nullable|exists:rumah_sakit,id',
        'catatan_tambahan' => 'nullable|string|max:255',
        'photo_base64' => 'required|string',
        'photo_latitude' => 'required|numeric',
        'photo_longitude' => 'required|numeric',
        'photo_taken_at' => 'required|date',
    ];

    protected $messages = [
        'photo_base64.required' => 'Silakan ambil foto langsung di lokasi kejadian beserta GPS aktif sebelum mengirim pesanan.',
        'photo_latitude.required' => 'Data lokasi (Latitude) dari foto tidak ditemukan.',
        'photo_longitude.required' => 'Data lokasi (Longitude) dari foto tidak ditemukan.',
        'photo_taken_at.required' => 'Data waktu (Timestamp) dari foto tidak ditemukan.',
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

        $photoPath = null;
        if ($this->photo_base64) {
            $imageParts = explode(";base64,", $this->photo_base64);
            $imageTypeAux = explode("image/", $imageParts[0]);
            $imageType = $imageTypeAux[1] ?? 'jpg';
            $imageBase64 = base64_decode($imageParts[1]);

            $fileName = 'ORDER_' . date('Ymd_His') . '_' . uniqid() . '.jpg';
            $filePath = 'order-verification/' . $fileName;

            \Illuminate\Support\Facades\Storage::disk('public')->put($filePath, $imageBase64);
            $photoPath = $filePath;
        }

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
            'photo_path' => $photoPath,
            'photo_latitude' => $this->photo_latitude,
            'photo_longitude' => $this->photo_longitude,
            'photo_address' => $this->photo_address,
            'photo_district' => $this->photo_district,
            'photo_city' => $this->photo_city,
            'photo_province' => $this->photo_province,
            'photo_country' => $this->photo_country,
            'photo_taken_at' => $this->photo_taken_at,
            'photo_accuracy' => $this->photo_accuracy,
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

        if (auth()->check()) {
            // Jika data user sudah lengkap dari profil, lewati form pelengkapan
            if (!empty($this->nik_pasien) && !empty($this->no_hp_kontak) && !empty($this->usia_pasien) && $this->usia_pasien !== '-') {
                $order->update(['is_form_complete' => true]);
                session()->flash('success', 'Pesanan ambulans darurat berhasil dikirim ke armada dan sedang diproses!');
                return redirect()->route('masyarakat.tracking', $order->id);
            }

            session()->put('pending_order_id', $order->id);
            session()->put('pending_order_code', $order->kode_order);
            session()->put('url.intended', route('masyarakat.order.complete', $order->id));

            session()->flash('success', 'Pesanan ambulans darurat berhasil dikirim ke armada! Silakan lengkapi formulir kebutuhan ambulans di bawah ini.');
            return redirect()->route('masyarakat.order.complete', $order->id);
        }

        // Untuk Guest
        session()->put('pending_order_id', $order->id);
        session()->put('pending_order_code', $order->kode_order);
        session()->put('url.intended', route('masyarakat.order.complete', $order->id));

        session()->flash('info', 'Pesanan ambulans darurat Anda (#' . $order->kode_order . ') berhasil dikirim ke armada! Silakan buat akun (Register) atau Login untuk melengkapi formulir kebutuhan medis pasien.');
        return redirect()->route('register');
    }

    public function render()
    {
        $rumahSakits = RumahSakit::orderBy('nama', 'asc')->get();

        return view('livewire.masyarakat.order-create', [
            'rumahSakits' => $rumahSakits,
        ])->layout('layouts.blank');
    }
}
