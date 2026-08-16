<?php

namespace Tests\Feature;

use App\Models\Notifikasi;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class DriverMitraNotificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_admin_receives_in_app_and_email_notification_when_new_driver_registers(): void
    {
        Mail::fake();

        $adminRole = Role::where('name', 'admin')->first();
        $admin = User::factory()->create([
            'email' => 'admin_test_' . uniqid() . '@test.com',
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        $uniqueDriverEmail = 'driver_' . uniqid() . '@test.com';

        $response = $this->post('/register-supir', [
            'name' => 'Driver Baru',
            'email' => $uniqueDriverEmail,
            'phone' => '081299998888',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'nomor_sim' => 'SIM-B1-123456',
            'plat_nomor' => 'R 1234 AB',
        ]);

        $response->assertRedirect(route('verification.otp.show'));

        // Cek bahwa Notifikasi ke Admin tersimpan di database
        $this->assertDatabaseHas('notifikasi', [
            'user_id' => $admin->id,
            'title' => 'Pendaftaran Driver Baru',
        ]);

        // Cek bahwa email notifikasi terkirim
        Mail::assertSent(\App\Mail\AdminNewUserRegisteredMail::class, function ($mail) use ($admin) {
            return $mail->hasTo($admin->email) && $mail->accountType === 'Driver Ambulans';
        });
    }

    public function test_admin_receives_notification_when_mitra_registers(): void
    {
        Mail::fake();

        $adminRole = Role::where('name', 'admin')->first();
        $admin = User::factory()->create([
            'email' => 'admin_mitra_test_' . uniqid() . '@test.com',
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        $uniqueMitraEmail = 'mitra_' . uniqid() . '@test.com';

        $response = $this->post('/register-mitra', [
            'nama_lembaga' => 'RS Harapan Sehat',
            'name' => 'Koordinator Mitra',
            'email' => $uniqueMitraEmail,
            'phone' => '081255554444',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('verification.otp.show'));

        $this->assertDatabaseHas('notifikasi', [
            'user_id' => $admin->id,
            'title' => 'Pendaftaran Mitra Baru',
        ]);
    }
}
