<?php

namespace App\Repositories\Eloquent;

use App\Models\Ambulans;
use App\Repositories\Contracts\AmbulansRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AmbulansRepository implements AmbulansRepositoryInterface
{
    public function getAll(?string $status = null, ?string $search = null): LengthAwarePaginator
    {
        $query = Ambulans::orderBy('kode_ambulans', 'asc');

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_ambulans', 'like', "%{$search}%")
                    ->orWhere('plat_nomor', 'like', "%{$search}%")
                    ->orWhere('jenis_ambulans', 'like', "%{$search}%");
            });
        }

        return $query->paginate(10);
    }

    public function getAvailable(): Collection
    {
        return Ambulans::where('status', 'Tersedia')
            ->orderBy('kode_ambulans', 'asc')
            ->get();
    }

    public function findById(int $id): ?Ambulans
    {
        return Ambulans::find($id);
    }

    public function create(array $data): Ambulans
    {
        return Ambulans::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $amb = Ambulans::find($id);
        if (!$amb) {
            return false;
        }

        return $amb->update($data);
    }

    public function delete(int $id): bool
    {
        $amb = Ambulans::find($id);
        if (!$amb) {
            return false;
        }

        return $amb->delete();
    }
}
