<?php

namespace App\Repositories\Eloquent;

use App\Models\Pemesanan;
use App\Models\StatusPerjalanan;
use App\Repositories\Contracts\PemesananRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PemesananRepository implements PemesananRepositoryInterface
{
    public function getAll(?string $status = null, ?string $search = null): LengthAwarePaginator
    {
        $query = Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'dispatcher'])
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_order', 'like', "%{$search}%")
                    ->orWhere('nama_pasien', 'like', "%{$search}%")
                    ->orWhere('lokasi_jemput', 'like', "%{$search}%");
            });
        }

        return $query->paginate(6);
    }

    public function getActiveOrders(): Collection
    {
        return Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'latestTracking'])
            ->whereIn('status', ['menunggu', 'diproses', 'menuju_lokasi', 'membawa_pasien'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findById(int $id): ?Pemesanan
    {
        return Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'dispatcher', 'statusPerjalanan.creator', 'rating', 'trackingGps'])
            ->find($id);
    }

    public function findByKodeOrder(string $kode): ?Pemesanan
    {
        return Pemesanan::with(['user', 'supir.user', 'ambulans', 'rumahSakit', 'dispatcher', 'statusPerjalanan.creator', 'rating', 'trackingGps'])
            ->where('kode_order', $kode)
            ->first();
    }

    public function getByUserId(int $userId): Collection
    {
        return Pemesanan::with(['supir.user', 'ambulans', 'rumahSakit', 'rating'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getBySupirId(int $supirId): Collection
    {
        return Pemesanan::with(['user', 'ambulans', 'rumahSakit'])
            ->where('supir_id', $supirId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function create(array $data): Pemesanan
    {
        return Pemesanan::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $order = Pemesanan::find($id);
        if (!$order) {
            return false;
        }

        return $order->update($data);
    }

    public function updateStatus(int $id, string $status, ?string $keterangan = null, ?int $userId = null): bool
    {
        $order = Pemesanan::find($id);
        if (!$order) {
            return false;
        }

        $order->status = $status;
        if ($status === 'diproses' && !$order->waktu_respon) {
            $order->waktu_respon = now();
        } elseif ($status === 'membawa_pasien' && !$order->waktu_jemput) {
            $order->waktu_jemput = now();
        } elseif (in_array($status, ['selesai', 'dibatalkan'])) {
            $order->waktu_selesai = now();
        }

        $order->save();

        StatusPerjalanan::create([
            'pemesanan_id' => $id,
            'status' => $status,
            'keterangan' => $keterangan ?? "Status pesanan diubah ke {$status}",
            'created_by' => $userId,
        ]);

        return true;
    }

    public function getStatistics(): array
    {
        return [
            'total' => Pemesanan::count(),
            'today' => Pemesanan::whereDate('created_at', today())->count(),
            'active' => Pemesanan::whereIn('status', ['menunggu', 'diproses', 'menuju_lokasi', 'membawa_pasien'])->count(),
            'completed' => Pemesanan::where('status', 'selesai')->count(),
            'cancelled' => Pemesanan::where('status', 'dibatalkan')->count(),
            'menunggu' => Pemesanan::where('status', 'menunggu')->count(),
            'monthly' => Pemesanan::selectRaw('MONTH(created_at) as month, count(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray(),
        ];
    }
}
