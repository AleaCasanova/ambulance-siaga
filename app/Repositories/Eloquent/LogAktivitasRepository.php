<?php

namespace App\Repositories\Eloquent;

use App\Models\LogAktivitas;
use App\Repositories\Contracts\LogAktivitasRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LogAktivitasRepository implements LogAktivitasRepositoryInterface
{
    public function getAll(?string $module = null, ?string $search = null): LengthAwarePaginator
    {
        $query = LogAktivitas::with('user')->orderBy('created_at', 'desc');

        if ($module) {
            $query->where('module', $module);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('activity', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query->paginate(6);
    }
}
