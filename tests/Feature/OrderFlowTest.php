<?php

namespace Tests\Feature;

use App\Models\Ambulans;
use App\Models\Role;
use App\Models\Supir;
use App\Models\User;
use App\Models\Masyarakat;
use App\Services\PemesananService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_complete_order_flow()
    {
        // 1. Setup Roles & Users
        $roleMasyarakat = Role::where('name', 'masyarakat')->first() ?? Role::create(['name' => 'masyarakat', 'label' => 'Masyarakat']);
        $roleOperator = Role::where('name', 'operator')->first() ?? Role::create(['name' => 'operator', 'label' => 'Operator']);
        $roleSupir = Role::where('name', 'supir')->first() ?? Role::create(['name' => 'supir', 'label' => 'Supir']);

        $userMasyarakat = User::factory()->create(['role_id' => $roleMasyarakat->id]);
        Masyarakat::create(['user_id' => $userMasyarakat->id, 'nik' => '1234567890123456']);

        $userOperator = User::factory()->create(['role_id' => $roleOperator->id]);

        $userSupir = User::factory()->create(['role_id' => $roleSupir->id]);
        $supir = Supir::create([
            'user_id' => $userSupir->id,
            'nomor_sim' => '12345',
            'status_online' => true
        ]);

        $ambulans = Ambulans::create([
            'kode_ambulans' => 'AMB-001',
            'plat_nomor' => 'B 1234 CD',
            'jenis_ambulans' => 'Basic',
            'status' => 'Tersedia',
        ]);

        $service = new PemesananService();

        // 2. Masyarakat Creates Order
        $this->actingAs($userMasyarakat);
        $orderData = [
            'nama_pasien' => 'John Doe',
            'kondisi_pasien' => 'Sakit perut parah',
            'lokasi_jemput' => 'Jalan A',
            'jemput_lat' => -7.1,
            'jemput_lng' => 109.1,
        ];
        
        $order = $service->createOrder($orderData, $userMasyarakat->id);
        $this->assertEquals('menunggu', $order->status);
        $this->assertDatabaseHas('pemesanan', ['id' => $order->id, 'status' => 'menunggu']);

        // 3. Operator Assigns Order to Supir
        $this->actingAs($userOperator);
        $service->assignAmbulanceAndDriver($order->id, $ambulans->id, $supir->id, $userOperator->id);
        
        $order->refresh();
        $this->assertEquals('menunggu_konfirmasi_supir', $order->status);
        $this->assertEquals($supir->id, $order->supir_id);

        // 4. Supir Accepts Order
        $this->actingAs($userSupir);
        $service->updateStatus($order->id, 'diproses', 'Supir menerima', $userSupir->id);
        
        $order->refresh();
        $this->assertEquals('diproses', $order->status);

        // 5. Supir Completes Order
        $service->updateStatus($order->id, 'selesai', 'Selesai', $userSupir->id);
        
        $order->refresh();
        $this->assertEquals('selesai', $order->status);
        $ambulans->refresh();
        $this->assertEquals('Tersedia', $ambulans->status); // Status ambulans harus kembali tersedia
        $this->assertNotNull($order->waktu_selesai);
    }
}
