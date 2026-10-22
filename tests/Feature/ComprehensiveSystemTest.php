<?php

namespace Tests\Feature;

use App\Models\Ambulans;
use App\Models\Pemesanan;
use App\Models\RumahSakit;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComprehensiveSystemTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_all_admin_submodules_load_without_errors(): void
    {
        $admin = User::whereHas('role', fn ($q) => $q->where('name', 'admin'))->firstOrFail();

        $routes = [
            'admin.dashboard',
            'admin.users.index',
            'admin.ambulans.index',
            'admin.jadwal.index',
            'admin.rumahsakit.index',
            'admin.laporan.index',
            'admin.donasi.index',
            'admin.orders.index',
            'admin.logs.index',
            'admin.settings.index',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($admin)->get(route($route));
            $this->assertEquals(200, $response->status(), "Route {$route} failed with status {$response->status()}");
        }

        // Test Laporan PDF Export endpoint
        $pdfResponse = $this->actingAs($admin)->get(route('admin.laporan.export.pdf'));
        $pdfResponse->assertSuccessful();
    }

    public function test_all_operator_submodules_load_without_errors(): void
    {
        $operator = User::whereHas('role', fn ($q) => $q->where('name', 'operator'))->firstOrFail();

        $routes = [
            'operator.dashboard',
            'operator.orders',
            'operator.monitoring',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($operator)->get(route($route));
            $this->assertEquals(200, $response->status(), "Route {$route} failed with status {$response->status()}");
        }
    }

    public function test_all_supir_submodules_load_without_errors(): void
    {
        $supirUser = User::whereHas('role', fn ($q) => $q->where('name', 'supir'))->firstOrFail();
        $order = Pemesanan::first();

        $routes = [
            'supir.dashboard',
            'supir.tugas.index',
            'supir.riwayat.index',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($supirUser)->get(route($route));
            $this->assertEquals(200, $response->status(), "Route {$route} failed with status {$response->status()}");
        }

        // Perjalanan aktif can return 200 (no trip) or 302 (redirect to active trip)
        $perjalananResponse = $this->actingAs($supirUser)->get(route('supir.perjalanan.aktif'));
        $this->assertTrue(in_array($perjalananResponse->status(), [200, 302]));

        if ($order) {
            $showResponse = $this->actingAs($supirUser)->get(route('supir.orders.show', $order->id));
            $this->assertEquals(200, $showResponse->status());
        }
    }

    public function test_all_mitra_submodules_load_without_errors(): void
    {
        $this->withoutExceptionHandling();
        $mitra = User::whereHas('role', fn ($q) => $q->where('name', 'mitra'))->firstOrFail();

        $routes = [
            'mitra.dashboard',
            'mitra.ambulans.index',
            'mitra.supir.index',
            'mitra.orders.index',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($mitra)->get(route($route));
            $this->assertEquals(200, $response->status(), "Route {$route} failed with status {$response->status()}");
        }
    }

    public function test_all_masyarakat_public_and_authenticated_features(): void
    {
        $masyarakat = User::whereHas('role', fn ($q) => $q->where('name', 'masyarakat'))->firstOrFail();
        $order = Pemesanan::first();

        // Public routes
        $this->get(route('masyarakat.info'))->assertStatus(200);
        $this->get(route('masyarakat.order.create'))->assertStatus(200);
        $this->get(route('donasi'))->assertStatus(200);
        $this->get(route('mitra.pengemudi'))->assertStatus(200);
        $this->get(route('mitra.armada'))->assertStatus(200);

        if ($order) {
            $this->get(route('masyarakat.tracking', $order->id))->assertStatus(200);
        }

        // Authenticated routes
        $this->actingAs($masyarakat)->get(route('masyarakat.dashboard'))->assertStatus(200);
        $this->actingAs($masyarakat)->get(route('masyarakat.order.index'))->assertStatus(200);
    }
}
