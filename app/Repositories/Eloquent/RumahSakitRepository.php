<?php

namespace App\Repositories\Eloquent;

use App\Models\RumahSakit;
use App\Repositories\Contracts\RumahSakitRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RumahSakitRepository implements RumahSakitRepositoryInterface
{
    public function getAll(?string $search = null): LengthAwarePaginator
    {
        $query = RumahSakit::orderBy('nama', 'asc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        return $query->paginate(6);
    }

    public function getAllList(): Collection
    {
        return RumahSakit::orderBy('nama', 'asc')->get();
    }

    public function findById(int $id): ?RumahSakit
    {
        return RumahSakit::find($id);
    }

    public function create(array $data): RumahSakit
    {
        return RumahSakit::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $rs = RumahSakit::find($id);
        if (!$rs) {
            return false;
        }

        return $rs->update($data);
    }

    public function delete(int $id): bool
    {
        $rs = RumahSakit::find($id);
        if (!$rs) {
            return false;
        }

        return $rs->delete();
    }
}
