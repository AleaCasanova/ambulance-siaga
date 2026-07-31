<?php

namespace App\Repositories\Contracts;

use App\Models\Ambulans;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface AmbulansRepositoryInterface
{
    public function getAll(?string $status = null, ?string $search = null): LengthAwarePaginator;
    public function getAvailable(): Collection;
    public function findById(int $id): ?Ambulans;
    public function create(array $data): Ambulans;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
