<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(?string $roleName = null, ?string $search = null): LengthAwarePaginator
    {
        $query = User::with(['role', 'supir', 'masyarakat'])->orderBy('created_at', 'desc');

        if ($roleName) {
            $query->whereHas('role', function ($q) use ($roleName) {
                $q->where('name', $roleName);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return $query->paginate(6);
    }

    public function getByRole(string $roleName): Collection
    {
        return User::with(['role', 'supir'])
            ->whereHas('role', fn($q) => $q->where('name', $roleName))
            ->where('is_active', true)
            ->get();
    }

    public function findById(int $id): ?User
    {
        return User::with(['role', 'supir', 'masyarakat'])->find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }

        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }

        return $user->delete();
    }
}
