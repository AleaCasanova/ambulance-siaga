<?php

namespace App\Livewire\Admin;

use App\Models\LogAktivitas;
use Livewire\Component;
use Livewire\WithPagination;

class LogAktivitasIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch() { $this->resetPage(); }

    public function deleteLog($id)
    {
        LogAktivitas::findOrFail($id)->delete();
        session()->flash('success', 'Catatan log aktivitas berhasil dihapus.');
    }

    public function clearOldLogs()
    {
        LogAktivitas::truncate();
        session()->flash('success', 'Seluruh riwayat log aktivitas berhasil dibersihkan.');
    }

    public function render()
    {
        $query = LogAktivitas::with('user')->orderBy('created_at', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('activity', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('ip_address', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function ($userQuery) {
                      $userQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $logs = $query->paginate(20);

        return view('livewire.admin.log-aktivitas-index', [
            'logs' => $logs,
        ]);
    }
}
