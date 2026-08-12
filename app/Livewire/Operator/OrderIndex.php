<?php

namespace App\Livewire\Operator;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\RumahSakit;
use App\Models\Supir;
use App\Services\AuditLogService;
use App\Services\PemesananService;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public string $statusFilter = '';
    public string $search = '';

    // Assignment Modal
    public bool $showAssignModal = false;
    public ?int $selectedOrderId = null;
    public ?int $selectedAmbulansId = null;
    public ?int $selectedSupirId = null;

    // Data for Map inside Assign Modal
    public ?array $assignOrderData = null;
    public array $assignDriversData = [];

    // Create Manual Order Modal
    public bool $showCreateModal = false;
    public string $nama_pasien = '';
    public string $kondisi_pasien = 'Kondisi darurat medis (Hotline Manual)';
    public string $lokasi_jemput = '';
    public ?int $rumah_sakit_id = null;
    public float $jemput_lat = -7.7188;
    public float $jemput_lng = 109.0159;

    // Edit Order Modal
    public bool $showEditModal = false;
    public ?int $editOrderId = null;
    public string $edit_nama_pasien = '';
    public string $edit_kondisi_pasien = '';
    public string $edit_lokasi_jemput = '';
    public ?int $edit_rumah_sakit_id = null;
    public string $edit_status = 'menunggu';

    // Detail Order Modal
    public bool $showDetailModal = false;
    public ?Pemesanan $detailOrder = null;

    public function updatingStatusFilter() { $this->resetPage(); }
    public function updatingSearch() { $this->resetPage(); }

    // 1. ASSIGN ORDER
    public function openAssignModal($orderId)
    {
        $order = Pemesanan::find($orderId);
        if ($order) {
            $this->assignOrderData = [
                'lat' => (float) $order->jemput_lat,
                'lng' => (float) $order->jemput_lng,
                'nama' => $order->nama_pasien
            ];
        }

        $this->assignDriversData = Supir::with('user')
            ->where('status_online', true)
            ->get()
            ->map(function($s) {
                return [
                    'id' => $s->id,
                    'ambulans_id' => null,
                    'nama' => $s->user ? $s->user->name : 'Supir',
                    'kode_ambulans' => 'Driver Siaga',
                    'lat' => (float) ($s->lokasi_terakhir_lat ?? -7.7188),
                    'lng' => (float) ($s->lokasi_terakhir_lng ?? 109.0159),
                ];
            })->toArray();

        $this->selectedOrderId = $orderId;
        $this->selectedAmbulansId = null;
        $this->selectedSupirId = null;
        $this->showAssignModal = true;
        
        $this->dispatch('assign-modal-opened');
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
        session()->flash('success', 'Armada ambulans berhasil ditugaskan!');
    }

    // 2. CREATE MANUAL ORDER
    public function openCreateModal()
    {
        $this->reset([
            'nama_pasien', 'kondisi_pasien', 'lokasi_jemput', 'rumah_sakit_id'
        ]);
        $this->kondisi_pasien = 'Kondisi darurat medis (Hotline Manual)';
        $this->jemput_lat = -7.7188;
        $this->jemput_lng = 109.0159;
        $this->showCreateModal = true;
    }

    public function saveManualOrder(PemesananService $service)
    {
        $this->validate([
            'nama_pasien' => 'required|string|max:150',
            'kondisi_pasien' => 'required|string|max:500',
            'lokasi_jemput' => 'required|string|max:255',
            'rumah_sakit_id' => 'nullable|exists:rumah_sakit,id',
        ]);

        $rs = $this->rumah_sakit_id ? RumahSakit::find($this->rumah_sakit_id) : null;

        $data = [
            'nama_pasien' => $this->nama_pasien,
            'kondisi_pasien' => $this->kondisi_pasien,
            'lokasi_jemput' => $this->lokasi_jemput,
            'jemput_lat' => $this->jemput_lat,
            'jemput_lng' => $this->jemput_lng,
            'rumah_sakit_id' => $this->rumah_sakit_id,
            'tujuan_lokasi' => $rs ? $rs->nama . ' (' . $rs->alamat . ')' : null,
            'tujuan_lat' => $rs ? (float) $rs->lat : null,
            'tujuan_lng' => $rs ? (float) $rs->lng : null,
        ];

        $service->createOrder($data, auth()->id());
        $this->showCreateModal = false;

        session()->flash('success', 'Pesanan darurat ambulans (Hotline) berhasil dibuat!');
    }

    // 3. EDIT ORDER
    public function openEditModal($orderId)
    {
        $order = Pemesanan::findOrFail($orderId);
        $this->editOrderId = $order->id;
        $this->edit_nama_pasien = $order->nama_pasien;
        $this->edit_kondisi_pasien = (string) $order->kondisi_pasien;
        $this->edit_lokasi_jemput = $order->lokasi_jemput;
        $this->edit_rumah_sakit_id = $order->rumah_sakit_id;
        $this->edit_status = $order->status;
        $this->showEditModal = true;
    }

    public function saveEditOrder()
    {
        $this->validate([
            'edit_nama_pasien' => 'required|string|max:150',
            'edit_kondisi_pasien' => 'required|string|max:500',
            'edit_lokasi_jemput' => 'required|string|max:255',
            'edit_rumah_sakit_id' => 'nullable|exists:rumah_sakit,id',
            'edit_status' => 'required|string',
        ]);

        $order = Pemesanan::findOrFail($this->editOrderId);
        $rs = $this->edit_rumah_sakit_id ? RumahSakit::find($this->edit_rumah_sakit_id) : null;

        $order->update([
            'nama_pasien' => $this->edit_nama_pasien,
            'kondisi_pasien' => $this->edit_kondisi_pasien,
            'lokasi_jemput' => $this->edit_lokasi_jemput,
            'rumah_sakit_id' => $this->edit_rumah_sakit_id,
            'tujuan_lokasi' => $rs ? $rs->nama . ' (' . $rs->alamat . ')' : $order->tujuan_lokasi,
            'status' => $this->edit_status,
        ]);

        AuditLogService::log('EDIT_ORDER', 'Pemesanan', "Memperbarui data Order #{$order->kode_order}", auth()->id());
        $this->showEditModal = false;

        session()->flash('success', 'Detail pesanan darurat berhasil diperbarui.');
    }

    // 4. DELETE ORDER
    public function deleteOrder($orderId)
    {
        $order = Pemesanan::findOrFail($orderId);
        $kodeOrder = $order->kode_order;

        if ($order->ambulans && $order->status !== 'selesai') {
            $order->ambulans->update(['status' => 'Tersedia']);
        }

        $order->delete();
        AuditLogService::log('DELETE_ORDER', 'Pemesanan', "Menghapus pesanan ambulans #{$kodeOrder}", auth()->id());

        session()->flash('success', "Pesanan #{$kodeOrder} berhasil dihapus dari database.");
    }

    public function updateStatus(PemesananService $service, $orderId, $newStatus)
    {
        $service->updateStatus($orderId, $newStatus, null, auth()->id());
        session()->flash('success', "Status order berhasil diubah ke {$newStatus}.");
    }

    // 5. VIEW DETAIL ORDER
    public function openDetailModal($orderId)
    {
        $this->detailOrder = Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'dispatcher'])->findOrFail($orderId);
        $this->showDetailModal = true;
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->detailOrder = null;
    }

    public function render()
    {
        $query = Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'dispatcher'])
            ->orderBy('created_at', 'desc');

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('kode_order', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_pasien', 'like', '%' . $this->search . '%')
                    ->orWhere('lokasi_jemput', 'like', '%' . $this->search . '%');
            });
        }

        $orders = $query->paginate(10);
        $availableAmbulances = Ambulans::where('status', 'Tersedia')->get();
        $onlineSupirs = Supir::with('user')->where('status_online', true)->get();
        $rumahSakits = RumahSakit::orderBy('nama')->get();

        return view('livewire.operator.order-index', [
            'orders' => $orders,
            'availableAmbulances' => $availableAmbulances,
            'onlineSupirs' => $onlineSupirs,
            'rumahSakits' => $rumahSakits,
        ]);
    }
}
