<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LogAktivitasRepositoryInterface
{
    public function getAll(?string $module = null, ?string $search = null): LengthAwarePaginator;
}
