<?php

namespace App\Livewire\Admin;

use App\Models\Ambulans;
use Livewire\Component;
use Livewire\WithPagination;

class AmbulansIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';

    // Modal Form State
    public bool $showModal = false;
    public bool $isEdit = false;
    public ?int $ambulansId = null;

    public string $kode_ambulans = '';
    public string $plat_nomor = '';
    public string $jenis_ambulans = 'Ambulans Gawat Darurat (AGD)';
    public string $status = 'Tersedia';
    public string $perlengkapan_medis = '';

    protected $rules = [
        'kode_ambulans' => 'required|string|max:50',
        'plat_nomor' => 'required|string|max:50',
        'jenis_ambulans' => 'required|string|max:100',
        'status' => 'required|in:Tersedia,Bertugas,Perbaikan',
        'perlengkapan_medis' => 'nullable|string|max:500',
    ];

    public function openCreateModal()
    {
        $this->reset(['ambulansId', 'kode_ambulans', 'plat_nomor', 'jenis_ambulans', 'status', 'perlengkapan_medis']);
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $amb = Ambulans::findOrFail($id);
        $this->ambulansId = $amb->id;
        $this->kode_ambulans = $amb->kode_ambulans;
        $this->plat_nomor = $amb->plat_nomor;
        $this->jenis_ambulans = $amb->jenis_ambulans;
        $this->status = $amb->status;
        $this->perlengkapan_medis = (string) $amb->perlengkapan_medis;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function saveAmbulans()
    {
        $this->validate();

        $data = [
            'kode_ambulans' => strtoupper($this->kode_ambulans),
            'plat_nomor' => strtoupper($this->plat_nomor),
            'jenis_ambulans' => $this->jenis_ambulans,
            'status' => $this->status,
            'perlengkapan_medis' => $this->perlengkapan_medis,
        ];

        if ($this->isEdit) {
            Ambulans::findOrFail($this->ambulansId)->update($data);
            session()->flash('success', 'Data armada ambulans berhasil diperbarui.');
        } else {
            Ambulans::create($data);
            session()->flash('success', 'Armada ambulans baru berhasil ditambahkan.');
        }

        $this->showModal = false;
    }

    public function deleteAmbulans($id)
    {
        Ambulans::findOrFail($id)->delete();
        session()->flash('success', 'Armada ambulans berhasil dihapus.');
    }

    public function render()
    {
        $query = Ambulans::orderBy('kode_ambulans', 'asc');

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('kode_ambulans', 'like', '%' . $this->search . '%')
                  ->orWhere('plat_nomor', 'like', '%' . $this->search . '%')
                  ->orWhere('jenis_ambulans', 'like', '%' . $this->search . '%');
            });
        }

        $ambulansList = $query->paginate(10);

        return view('livewire.admin.ambulans-index', [
            'ambulansList' => $ambulansList,
        ]);
    }
}
