<?php

namespace App\Livewire\Dispatcher;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\Supir;
use App\Services\PemesananService;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    // Assignment Modal State
    public bool $showAssignModal = false;
    public ?int $selectedOrderId = null;
    public ?int $selectedAmbulansId = null;
    public ?int $selectedSupirId = null;

    public function openAssignModal($orderId)
    {
        $this->selectedOrderId = $orderId;
        $this->selectedAmbulansId = null;
        $this->selectedSupirId = null;
        $this->showAssignModal = true;
    }

    public function closeAssignModal()
    {
        $this->showAssignModal = false;
        $this->selectedOrderId = null;
    }

    public function assignOrder(PemesananService $service)
    {
        $this->validate([
            'selectedOrderId' => 'required|exists:pemesanan,id',
            'selectedAmbulansId' => 'required|exists:ambulans,id',
            'selectedSupirId' => 'required|exists:supir,id',
        ]);

        $service->assignAmbulanceAndDriver(
            $this->selectedOrderId,
            $this->selectedAmbulansId,
            $this->selectedSupirId,
            auth()->id()
        );

        $this->closeAssignModal();
        session()->flash('success', 'Ambulans dan supir berhasil ditugaskan untuk order darurat tersebut!');
    }

    public function render()
    {
        $stats = [
            'menunggu' => Pemesanan::where('status', 'menunggu')->count(),
            'aktif' => Pemesanan::whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])->count(),
            'amb_tersedia' => Ambulans::where('status', 'Tersedia')->count(),
            'supir_online' => Supir::where('status_online', true)->count(),
        ];

        $ordersMenunggu = Pemesanan::with(['user', 'rumahSakit'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'asc')
            ->get();

        $activeOrders = Pemesanan::with(['user', 'supir.user', 'ambulans', 'latestTracking'])
            ->whereIn('status', ['diproses', 'menuju_lokasi', 'membawa_pasien'])
            ->orderBy('created_at', 'desc')
            ->get();

        $availableAmbulances = Ambulans::where('status', 'Tersedia')->get();
        $onlineSupirs = Supir::with('user')->where('status_online', true)->get();

        // Data map untuk seluruh armada dan order aktif
        $mapMarkers = [];

        foreach ($activeOrders as $ao) {
            $lat = $ao->latestTracking ? (float) $ao->latestTracking->lat : ($ao->supir->lokasi_terakhir_lat ?? -7.7188);
            $lng = $ao->latestTracking ? (float) $ao->latestTracking->lng : ($ao->supir->lokasi_terakhir_lng ?? 109.0159);
            $mapMarkers[] = [
                'type' => 'ambulans',
                'id' => $ao->id,
                'kode' => $ao->ambulans?->kode_ambulans ?? 'AMB',
                'supir' => $ao->supir?->user->name ?? '-',
                'pasien' => $ao->nama_pasien,
                'status' => $ao->status_label,
                'lat' => $lat,
                'lng' => $lng,
            ];

            // Tambahkan juga marker jemput pasien
            $mapMarkers[] = [
                'type' => 'jemput',
                'id' => $ao->id,
                'pasien' => $ao->nama_pasien,
                'lokasi' => $ao->lokasi_jemput,
                'lat' => (float) $ao->jemput_lat,
                'lng' => (float) $ao->jemput_lng,
            ];
        }

        foreach ($ordersMenunggu as $om) {
            $mapMarkers[] = [
                'type' => 'darurat',
                'id' => $om->id,
                'kode' => $om->kode_order,
                'pasien' => $om->nama_pasien,
                'lokasi' => $om->lokasi_jemput,
                'lat' => (float) $om->jemput_lat,
                'lng' => (float) $om->jemput_lng,
            ];
        }

        return view('livewire.dispatcher.dashboard', [
            'stats' => $stats,
            'ordersMenunggu' => $ordersMenunggu,
            'activeOrders' => $activeOrders,
            'availableAmbulances' => $availableAmbulances,
            'onlineSupirs' => $onlineSupirs,
            'mapMarkers' => $mapMarkers,
        ]);
    }
}
