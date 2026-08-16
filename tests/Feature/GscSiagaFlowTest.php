<?php

namespace Tests\Feature;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\RumahSakit;
use App\Models\Supir;
use App\Models\User;
use App\Services\PemesananService;
use App\Services\RatingService;
use App\Services\TrackingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GscSiagaFlowTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_end_to_end_order_flow_works_correctly(): void
    {
        // 1. Cek User & Armada dari Seeder
        $userMasyarakat = User::whereHas('role', fn ($q) => $q->where('name', 'masyarakat'))->firstOrFail();
        $userOperator = User::whereHas('role', fn ($q) => $q->where('name', 'operator'))->firstOrFail();
        $supir = Supir::firstOrFail();
        $ambulans = Ambulans::firstOrFail();
        $rumahSakit = RumahSakit::firstOrFail();

        // Reset any existing active orders from seeders to prevent driver conflict
        Pemesanan::query()->update(['status' => 'selesai']);

        // Disable auto-dispatch for this test by making ALL ambulances and supirs unavailable temporarily
        Ambulans::query()->update(['status' => 'Ditugaskan']);
        Supir::query()->update(['status_online' => 0]);

        $service = app(PemesananService::class);
        $trackingService = app(TrackingService::class);
        $ratingService = app(RatingService::class);

        // 2. Masyarakat Membuat Pesanan Darurat
        $order = $service->createOrder([
            'nama_pasien' => 'Bapak Joko Santoso',
            'kondisi_pasien' => 'Serangan jantung mendadak, membutuhkan tabung oksigen dan evakuasi segera.',
            'lokasi_jemput' => 'Jl. S. Parman No. 45, Cilacap Selatan',
            'jemput_lat' => -7.7350,
            'jemput_lng' => 109.0200,
            'tujuan_lat' => $rumahSakit->lat,
            'tujuan_lng' => $rumahSakit->lng,
            'tujuan_lokasi' => $rumahSakit->nama,
            'rumah_sakit_id' => $rumahSakit->id,
            'catatan_tambahan' => 'Gerbang warna putih dekat minimarket.',
        ], $userMasyarakat->id);

        $this->assertNotNull($order);
        $this->assertEquals('menunggu', $order->status);
        $this->assertStringStartsWith('AMB-ORD-', $order->kode_order);

        // Make it available again for manual assignment
        $ambulans->update(['status' => 'Tersedia']);
        Supir::query()->where('id', $supir->id)->update(['status_online' => 1]);
        $supir->refresh();

        // 3. Operator Menugaskan Ambulans & Supir
        $assignedOrder = $service->assignAmbulanceAndDriver(
            $order->id,
            $ambulans->id,
            $supir->id,
            $userOperator->id
        );

        $this->assertEquals('menunggu_konfirmasi_supir', $assignedOrder->status);
        $this->assertEquals($ambulans->id, $assignedOrder->ambulans_id);
        $this->assertEquals($supir->id, $assignedOrder->supir_id);

        // Supir Menerima Tugas
        $service->updateStatus($order->id, 'diproses', 'Supir menerima tugas dan bersiap', $supir->user_id);
        $this->assertEquals('diproses', $order->fresh()->status);

        // 4. Supir Mengupdate Status: menuju_lokasi -> membawa_pasien -> selesai
        $service->updateStatus($order->id, 'menuju_lokasi', 'Ambulans meluncur ke titik jemput', $supir->user_id);
        $this->assertEquals('menuju_lokasi', $order->fresh()->status);

        // 5. Simulasi Pergerakan GPS
        $trackingService->simulateMovement($order->id);
        $trackingCount = $order->fresh()->trackingGps()->count();
        $this->assertGreaterThan(0, $trackingCount);

        // 6. Pasien Diangkut & Selesai
        $service->updateStatus($order->id, 'membawa_pasien', 'Pasien dalam ambulans menuju RSUD', $supir->user_id);
        $service->updateStatus($order->id, 'selesai', 'Pasien tiba di IGD RSUD', $supir->user_id);

        $this->assertEquals('selesai', $order->fresh()->status);
        $this->assertEquals('Tersedia', $ambulans->fresh()->status);

        // 7. Masyarakat Memberikan Rating & Ulasan
        $rating = $ratingService->submitRating(
            $order->id,
            $userMasyarakat->id,
            5,
            'Supir sangat cepat dan tanggap, terima kasih GSC SIAGA!'
        );

        $this->assertNotNull($rating);
        $this->assertEquals(5, $rating->skor);

        // Verifikasi rating rata-rata supir meningkat
        $this->assertGreaterThanOrEqual(4.5, (float) $supir->fresh()->rating_rata_rata);
    }

    public function test_all_livewire_pages_render_successfully(): void
    {
        $admin = User::whereHas('role', fn ($q) => $q->where('name', 'admin'))->firstOrFail();
        $operator = User::whereHas('role', fn ($q) => $q->where('name', 'operator'))->firstOrFail();
        $supirUser = User::whereHas('role', fn ($q) => $q->where('name', 'supir'))->firstOrFail();
        $masyarakat = User::whereHas('role', fn ($q) => $q->where('name', 'masyarakat'))->firstOrFail();

        // 1. Masyarakat Pages
        $this->actingAs($masyarakat)->get(route('masyarakat.info'))->assertStatus(200);
        $this->actingAs($masyarakat)->get(route('masyarakat.order.create'))->assertStatus(200);
        $this->actingAs($masyarakat)->get(route('masyarakat.order.index'))->assertStatus(200);

        // 2. Operator Pages
        $this->actingAs($operator)->get(route('operator.dashboard'))->assertStatus(200);
        $this->actingAs($operator)->get(route('operator.orders'))->assertStatus(200);
        $this->actingAs($operator)->get(route('operator.monitoring'))->assertStatus(200);

        // 3. Supir Pages
        $this->actingAs($supirUser)->get(route('supir.dashboard'))->assertStatus(200);

        // 4. Admin Pages
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.users.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.ambulans.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.rumahsakit.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.laporan.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.logs.index'))->assertStatus(200);
        $this->actingAs($admin)->get(route('admin.settings.index'))->assertStatus(200);

        // 5. Guest Pages (Tanpa Login / Non-Authenticated)
        auth()->logout();
        $this->get(route('masyarakat.info'))->assertStatus(200);
        $this->get(route('masyarakat.order.create'))->assertStatus(200);
    }
}
