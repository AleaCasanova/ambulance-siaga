<?php

namespace App\Livewire\Admin;

use App\Models\RumahSakit;
use Livewire\Component;
use Livewire\WithPagination;

class RumahSakitIndex extends Component
{
    use WithPagination;

    public string $search = '';

    // Modal Form State
    public bool $showModal = false;
    public bool $isEdit = false;
    public ?int $rsId = null;

    public string $nama = '';
    public string $alamat = '';
    public float $lat = -7.7188;
    public float $lng = 109.0159;
    public string $telepon = '';
    public string $kapasitas_igd = 'Tersedia 24 Jam';

    protected $rules = [
        'nama' => 'required|string|max:150',
        'alamat' => 'required|string|max:255',
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'telepon' => 'nullable|string|max:30',
        'kapasitas_igd' => 'nullable|string|max:50',
    ];

    public function openCreateModal()
    {
        $this->reset(['rsId', 'nama', 'alamat', 'telepon', 'kapasitas_igd']);
        $this->lat = -7.7188;
        $this->lng = 109.0159;
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $rs = RumahSakit::findOrFail($id);
        $this->rsId = $rs->id;
        $this->nama = $rs->nama;
        $this->alamat = $rs->alamat;
        $this->lat = (float) $rs->lat;
        $this->lng = (float) $rs->lng;
        $this->telepon = (string) $rs->telepon;
        $this->kapasitas_igd = (string) $rs->kapasitas_igd;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function updateCoordinates($lat, $lng)
    {
        $this->lat = (float) $lat;
        $this->lng = (float) $lng;
    }

    public function saveRs()
    {
        $this->validate();

        $data = [
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'telepon' => $this->telepon,
            'kapasitas_igd' => $this->kapasitas_igd,
        ];

        if ($this->isEdit) {
            RumahSakit::findOrFail($this->rsId)->update($data);
            session()->flash('success', 'Data rumah sakit berhasil diperbarui.');
        } else {
            RumahSakit::create($data);
            session()->flash('success', 'Rumah sakit rujukan baru berhasil ditambahkan.');
        }

        $this->showModal = false;
    }

    public function deleteRs($id)
    {
        RumahSakit::findOrFail($id)->delete();
        session()->flash('success', 'Rumah sakit berhasil dihapus.');
    }

    public function render()
    {
        $query = RumahSakit::orderBy('nama', 'asc');

        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('alamat', 'like', '%' . $this->search . '%');
        }

        $rumahSakits = $query->paginate(10);

        return view('livewire.admin.rumah-sakit-index', [
            'rumahSakits' => $rumahSakits,
        ])->layout('layouts.admin');
    }
}
