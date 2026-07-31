<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
use App\Models\Role;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin_operasional')->first();
        $dispatcherRole = Role::where('name', 'dispatcher')->first();
        $supirRole = Role::where('name', 'supir')->first();
        $masyarakatRole = Role::where('name', 'masyarakat')->first();

        // 1. Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@gsc.org'],
            [
                'name' => 'Super Admin GSC',
                'password' => Hash::make('password'),
                'role_id' => $superadminRole->id,
                'phone' => '081234560001',
                'is_active' => true,
            ]
        );

        // 2. Admin Operasional
        User::updateOrCreate(
            ['email' => 'admin@gsc.org'],
            [
                'name' => 'Admin Operasional GSC',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'phone' => '081234560002',
                'is_active' => true,
            ]
        );

        // 3. Dispatcher
        User::updateOrCreate(
            ['email' => 'dispatcher@gsc.org'],
            [
                'name' => 'Dispatcher Siaga GSC',
                'password' => Hash::make('password'),
                'role_id' => $dispatcherRole->id,
                'phone' => '081234560003',
                'is_active' => true,
            ]
        );

        // 4. Supir 1
        $supirUser1 = User::updateOrCreate(
            ['email' => 'supir1@gsc.org'],
            [
                'name' => 'Ahmad Supriyadi',
                'password' => Hash::make('password'),
                'role_id' => $supirRole->id,
                'phone' => '081234560004',
                'is_active' => true,
            ]
        );

        Supir::updateOrCreate(
            ['user_id' => $supirUser1->id],
            [
                'nomor_sim' => 'SIM-B1-9988776655',
                'status_online' => true,
                'lokasi_terakhir_lat' => -7.7188,
                'lokasi_terakhir_lng' => 109.0159,
                'rating_rata_rata' => 4.90,
                'total_perjalanan' => 15,
            ]
        );

        // 5. Supir 2
        $supirUser2 = User::updateOrCreate(
            ['email' => 'supir2@gsc.org'],
            [
                'name' => 'Rahmat Hidayat',
                'password' => Hash::make('password'),
                'role_id' => $supirRole->id,
                'phone' => '081234560005',
                'is_active' => true,
            ]
        );

        Supir::updateOrCreate(
            ['user_id' => $supirUser2->id],
            [
                'nomor_sim' => 'SIM-B1-1122334455',
                'status_online' => true,
                'lokasi_terakhir_lat' => -7.7250,
                'lokasi_terakhir_lng' => 109.0080,
                'rating_rata_rata' => 5.00,
                'total_perjalanan' => 8,
            ]
        );

        // 6. Masyarakat 1
        $masyarakatUser1 = User::updateOrCreate(
            ['email' => 'masyarakat@gsc.org'],
            [
                'name' => 'Siti Aminah (Warga Cilacap)',
                'password' => Hash::make('password'),
                'role_id' => $masyarakatRole->id,
                'phone' => '081234560006',
                'is_active' => true,
            ]
        );

        Masyarakat::updateOrCreate(
            ['user_id' => $masyarakatUser1->id],
            [
                'nik' => '3301015006900001',
                'alamat' => 'Jl. Gatot Subroto No. 45, Sidanegara, Cilacap Tengah',
                'tanggal_lahir' => '1990-06-15',
                'jenis_kelamin' => 'P',
                'kontak_darurat' => '081987654321',
            ]
        );

        // 7. Masyarakat 2
        $masyarakatUser2 = User::updateOrCreate(
            ['email' => 'budi@gmail.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role_id' => $masyarakatRole->id,
                'phone' => '081234560007',
                'is_active' => true,
            ]
        );

        Masyarakat::updateOrCreate(
            ['user_id' => $masyarakatUser2->id],
            [
                'nik' => '3301021203850002',
                'alamat' => 'Jl. Letjen Suprapto, Kebonmanis, Cilacap Utara',
                'tanggal_lahir' => '1985-03-12',
                'jenis_kelamin' => 'L',
                'kontak_darurat' => '081299887766',
            ]
        );
    }
}
