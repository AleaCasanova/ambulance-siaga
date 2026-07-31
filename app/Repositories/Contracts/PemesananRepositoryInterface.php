<?php

namespace App\Repositories\Contracts;

use App\Models\Pemesanan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PemesananRepositoryInterface
{
    public function getAll(?string $status = null, ?string $search = null): LengthAwarePaginator;
    public function getActiveOrders(): Collection;
    public function findById(int $id): ?Pemesanan;
    public function findByKodeOrder(string $kode): ?Pemesanan;
    public function getByUserId(int $userId): Collection;
    public function getBySupirId(int $supirId): Collection;
    public function create(array $data): Pemesanan;
    public function update(int $id, array $data): bool;
    public function updateStatus(int $id, string $status, ?string $keterangan = null, ?int $userId = null): bool;
    public function getStatistics(): array;
}
