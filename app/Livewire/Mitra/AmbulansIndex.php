<?php

namespace App\Livewire\Mitra;

use App\Models\Ambulans;
use App\Models\Mitra;
use Livewire\Component;
use Livewire\WithPagination;

class AmbulansIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    // Modal Form State
    public $isModalOpen = false;
    public $ambulansId = null;
    public $kode_ambulans = '';
    public $plat_nomor = '';
    public $jenis_ambulans = 'Ambulans Gawat Darurat (AGD)';
    public $status = 'Tersedia';
    public $kapasitas_medis = '';
    public $perlengkapan_medis = '';
    public $catatan = '';

    protected $rules = [
        'kode_ambulans' => 'required|string|max:50',
        'plat_nomor' => 'required|string|max:20',
        'jenis_ambulans' => 'required|string|max:100',
        'status' => 'required|string|in:Tersedia,Ditugaskan,Perawatan,Tidak Aktif',
        'kapasitas_medis' => 'nullable|string|max:100',
        'perlengkapan_medis' => 'nullable|string',
        'catatan' => 'nullable|string',
    ];

    public function getMitraProperty()
    {
        $user = auth()->user();
        if (!$user) return null;

        $mitra = $user->mitra;
        if (!$mitra) {
            $mitra = Mitra::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_mitra' => $user->name,
                    'penanggung_jawab' => $user->name,
                    'no_telp' => $user->phone ?? '081234567890',
                    'alamat' => 'Cilacap, Jawa Tengah',
                    'is_active' => true,
                ]
            );
        }

        return $mitra;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->reset(['ambulansId', 'kode_ambulans', 'plat_nomor', 'kapasitas_medis', 'perlengkapan_medis', 'catatan']);
        $this->jenis_ambulans = 'Ambulans Gawat Darurat (AGD)';
        $this->status = 'Tersedia';
        $this->isModalOpen = true;
    }

    public function openEditModal($id)
    {
        $mitra = $this->mitra;
        $amb = Ambulans::where('mitra_id', $mitra ? $mitra->id : 0)->findOrFail($id);
        
        $this->ambulansId = $amb->id;
        $this->kode_ambulans = $amb->kode_ambulans;
        $this->plat_nomor = $amb->plat_nomor;
        $this->jenis_ambulans = $amb->jenis_ambulans;
        $this->status = $amb->status;
        $this->kapasitas_medis = $amb->kapasitas_medis;
        $this->perlengkapan_medis = $amb->perlengkapan_medis;
        $this->catatan = $amb->catatan;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();
        $mitra = $this->mitra;

        if ($this->ambulansId) {
            $amb = Ambulans::where('mitra_id', $mitra ? $mitra->id : 0)->findOrFail($this->ambulansId);
            $amb->update([
                'kode_ambulans' => $this->kode_ambulans,
                'plat_nomor' => strtoupper($this->plat_nomor),
                'jenis_ambulans' => $this->jenis_ambulans,
                'status' => $this->status,
                'kapasitas_medis' => $this->kapasitas_medis,
                'perlengkapan_medis' => $this->perlengkapan_medis,
                'catatan' => $this->catatan,
            ]);
            session()->flash('message', 'Data ambulans berhasil diperbarui!');
        } else {
            Ambulans::create([
                'mitra_id' => $mitra ? $mitra->id : null,
                'kode_ambulans' => $this->kode_ambulans,
                'plat_nomor' => strtoupper($this->plat_nomor),
                'jenis_ambulans' => $this->jenis_ambulans,
                'status' => $this->status,
                'kapasitas_medis' => $this->kapasitas_medis,
                'perlengkapan_medis' => $this->perlengkapan_medis,
                'catatan' => $this->catatan,
            ]);
            session()->flash('message', 'Armada baru berhasil didaftarkan ke lembaga!');
        }

        $this->closeModal();
    }

    public function updateStatus($id, $newStatus)
    {
        $mitra = $this->mitra;
        $amb = Ambulans::where('mitra_id', $mitra ? $mitra->id : 0)->findOrFail($id);
        $amb->update(['status' => $newStatus]);
        session()->flash('message', "Status unit {$amb->kode_ambulans} diubah menjadi {$newStatus}.");
    }

    public function render()
    {
        $mitra = $this->mitra;
        $mitraId = $mitra ? $mitra->id : 0;

        $ambulans = Ambulans::where('mitra_id', $mitraId)
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('kode_ambulans', 'like', '%' . $this->search . '%')
                        ->orWhere('plat_nomor', 'like', '%' . $this->search . '%')
                        ->orWhere('jenis_ambulans', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.mitra.ambulans-index', [
            'ambulans' => $ambulans,
            'mitra' => $mitra,
        ])->layout('layouts.admin');
    }
}
