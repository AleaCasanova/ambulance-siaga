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
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GscSiagaFlowTest extends TestCase
{
    use DatabaseTransactions;
    public function test_end_to_end_order_flow_works_correctly(): void
    {
        // 1. Cek User & Armada dari Seeder
        $userMasyarakat = User::whereHas('role', fn ($q) => $q->where('name', 'masyarakat'))->firstOrFail();
        $userDispatcher = User::whereHas('role', fn ($q) => $q->where('name', 'dispatcher'))->firstOrFail();
        $supir = Supir::firstOrFail();
        $ambulans = Ambulans::firstOrFail();
        $rumahSakit = RumahSakit::firstOrFail();

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
        $this->assertStringStartsWith('GSC-', $order->kode_order);

        // 3. Dispatcher Menugaskan Ambulans & Supir
        $assignedOrder = $service->assignAmbulanceAndDriver(
            $order->id,
            $ambulans->id,
            $supir->id,
            $userDispatcher->id
        );

        $this->assertEquals('diproses', $assignedOrder->status);
        $this->assertEquals($ambulans->id, $assignedOrder->ambulans_id);
        $this->assertEquals($supir->id, $assignedOrder->supir_id);

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
        $superAdmin = User::whereHas('role', fn ($q) => $q->where('name', 'superadmin'))->firstOrFail();
        $dispatcher = User::whereHas('role', fn ($q) => $q->where('name', 'dispatcher'))->firstOrFail();
        $supirUser = User::whereHas('role', fn ($q) => $q->where('name', 'supir'))->firstOrFail();
        $masyarakat = User::whereHas('role', fn ($q) => $q->where('name', 'masyarakat'))->firstOrFail();

        // 1. Masyarakat Pages
        $this->actingAs($masyarakat)->get(route('masyarakat.info'))->assertStatus(200);
        $this->actingAs($masyarakat)->get(route('masyarakat.order.create'))->assertStatus(200);
        $this->actingAs($masyarakat)->get(route('masyarakat.order.index'))->assertStatus(200);

        // 2. Dispatcher Pages
        $this->actingAs($dispatcher)->get(route('dispatcher.dashboard'))->assertStatus(200);
        $this->actingAs($dispatcher)->get(route('dispatcher.orders'))->assertStatus(200);
        $this->actingAs($dispatcher)->get(route('dispatcher.monitoring'))->assertStatus(200);

        // 3. Supir Pages
        $this->actingAs($supirUser)->get(route('supir.dashboard'))->assertStatus(200);

        // 4. Admin Pages
        $this->actingAs($superAdmin)->get(route('admin.dashboard'))->assertStatus(200);
        $this->actingAs($superAdmin)->get(route('admin.users.index'))->assertStatus(200);
        $this->actingAs($superAdmin)->get(route('admin.ambulans.index'))->assertStatus(200);
        $this->actingAs($superAdmin)->get(route('admin.rumahsakit.index'))->assertStatus(200);
        $this->actingAs($superAdmin)->get(route('admin.laporan.index'))->assertStatus(200);
        $this->actingAs($superAdmin)->get(route('admin.logs.index'))->assertStatus(200);
        $this->actingAs($superAdmin)->get(route('admin.settings.index'))->assertStatus(200);

        // 5. Guest Pages (Tanpa Login / Non-Authenticated)
        auth()->logout();
        $this->get(route('masyarakat.info'))->assertStatus(200);
        $this->get(route('masyarakat.order.create'))->assertStatus(200);
    }
}
