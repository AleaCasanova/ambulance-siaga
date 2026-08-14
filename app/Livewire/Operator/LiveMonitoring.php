<?php

namespace App\Livewire\Operator;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\RumahSakit;
use App\Models\Supir;
use Livewire\Component;

class LiveMonitoring extends Component
{
    public function render()
    {
        $activeOrders = Pemesanan::with(['user', 'supir.user', 'ambulans', 'latestTracking'])
            ->whereIn('status', ['menunggu', 'diproses', 'menuju_lokasi', 'membawa_pasien'])
            ->get();

        $allSupirs  = Supir::with('user')->get();
        $rumahSakits = RumahSakit::all();

        $markers = [];

        // Marker Rumah Sakit (Green)
        foreach ($rumahSakits as $rs) {
            $markers[] = [
                'type'      => 'rumahsakit',
                'id'        => $rs->id,
                'nama'      => $rs->nama,
                'alamat'    => $rs->alamat,
                'telepon'   => $rs->telepon,
                'kapasitas' => $rs->kapasitas_igd,
                'lat'       => (float) $rs->lat,
                'lng'       => (float) $rs->lng,
            ];
        }

        // Marker Supir / Ambulans
        foreach ($allSupirs as $sp) {
            $lat = (float) ($sp->lokasi_terakhir_lat ?? -7.7188);
            $lng = (float) ($sp->lokasi_terakhir_lng ?? 109.0159);
            $markers[] = [
                'type'         => 'ambulans',
                'id'           => $sp->id,
                'kode'         => $sp->ambulans?->kode_ambulans ?? 'AMB',
                'supir'        => $sp->user->name,
                'phone'        => $sp->user->phone,
                'status_online' => $sp->status_online,
                'lat'          => $lat,
                'lng'          => $lng,
            ];
        }

        // Marker Order Darurat
        foreach ($activeOrders as $ao) {
            $markers[] = [
                'type'    => 'darurat',
                'id'      => $ao->id,
                'kode'    => $ao->kode_order,
                'pasien'  => $ao->nama_pasien,
                'kondisi' => $ao->kondisi_pasien,
                'status'  => $ao->status_label,
                'lat'     => (float) $ao->jemput_lat,
                'lng'     => (float) $ao->jemput_lng,
            ];
        }

        return view('livewire.operator.live-monitoring', [
            'markers'            => $markers,
            'activeOrdersCount'  => $activeOrders->count(),
            'onlineSupirsCount'  => $allSupirs->where('status_online', true)->count(),
        ])->layout('layouts.admin');
    }
}
