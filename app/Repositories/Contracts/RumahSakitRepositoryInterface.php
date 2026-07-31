<?php

namespace App\Repositories\Contracts;

use App\Models\RumahSakit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface RumahSakitRepositoryInterface
{
    public function getAll(?string $search = null): LengthAwarePaginator;
    public function getAllList(): Collection;
    public function findById(int $id): ?RumahSakit;
    public function create(array $data): RumahSakit;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
