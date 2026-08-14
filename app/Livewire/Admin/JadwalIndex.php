<?php

namespace App\Livewire\Admin;

use App\Models\Ambulans;
use App\Models\JadwalSupir;
use App\Models\Supir;
use Livewire\Component;
use Livewire\WithPagination;

class JadwalIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $hariFilter = '';

    // Modal Form State
    public bool $showModal = false;
    public bool $isEdit = false;
    public ?int $jadwalId = null;

    public ?int $supir_id = null;
    public ?int $ambulans_id = null;
    public string $hari = 'Senin';
    public string $jam_mulai = '08:00';
    public string $jam_selesai = '16:00';
    public string $status = 'Aktif';

    protected $rules = [
        'supir_id' => 'required|exists:supir,id',
        'ambulans_id' => 'required|exists:ambulans,id',
        'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        'jam_mulai' => 'required|string|max:10',
        'jam_selesai' => 'required|string|max:10',
        'status' => 'required|in:Aktif,Libur,Cadangan',
    ];

    public function openCreateModal()
    {
        $this->reset(['jadwalId', 'supir_id', 'ambulans_id']);
        $this->hari = 'Senin';
        $this->jam_mulai = '08:00';
        $this->jam_selesai = '16:00';
        $this->status = 'Aktif';
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $jadwal = JadwalSupir::findOrFail($id);
        $this->jadwalId = $jadwal->id;
        $this->supir_id = $jadwal->supir_id;
        $this->ambulans_id = $jadwal->ambulans_id;
        $this->hari = $jadwal->hari;
        $this->jam_mulai = $jadwal->jam_mulai;
        $this->jam_selesai = $jadwal->jam_selesai;
        $this->status = $jadwal->status;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function saveJadwal()
    {
        $this->validate();

        $data = [
            'supir_id' => $this->supir_id,
            'ambulans_id' => $this->ambulans_id,
            'hari' => $this->hari,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'status' => $this->status,
        ];

        if ($this->isEdit) {
            JadwalSupir::findOrFail($this->jadwalId)->update($data);
            session()->flash('success', 'Jadwal piket supir berhasil diperbarui.');
        } else {
            JadwalSupir::create($data);
            session()->flash('success', 'Jadwal piket supir baru berhasil ditambahkan.');
        }

        $this->showModal = false;
    }

    public function deleteJadwal($id)
    {
        JadwalSupir::findOrFail($id)->delete();
        session()->flash('success', 'Jadwal piket supir berhasil dihapus.');
    }

    public function render()
    {
        $query = JadwalSupir::with(['supir.user', 'ambulans'])->orderBy('id', 'desc');

        if ($this->hariFilter) {
            $query->where('hari', $this->hariFilter);
        }

        if ($this->search) {
            $query->whereHas('supir.user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('ambulans', function ($q) {
                $q->where('plat_nomor', 'like', '%' . $this->search . '%')
                  ->orWhere('kode_ambulans', 'like', '%' . $this->search . '%');
            });
        }

        $jadwalList = $query->paginate(10);
        $supirList = Supir::with('user')->get();
        $ambulansList = Ambulans::all();

        return view('livewire.admin.jadwal-index', [
            'jadwalList' => $jadwalList,
            'supirList' => $supirList,
            'ambulansList' => $ambulansList,
        ])->layout('layouts.admin');
    }
}
