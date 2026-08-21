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
        $adminRole      = Role::where('name', 'admin')->first();
        $operatorRole   = Role::where('name', 'operator')->first();
        $supirRole      = Role::where('name', 'supir')->first();
        $masyarakatRole = Role::where('name', 'masyarakat')->first();

        // 1. Admin
        User::updateOrCreate(
            ['email' => 'admin@ambulancesiaga.org'],
            [
                'name'     => 'Admin Ambulans Siaga',
                'password' => Hash::make('password'),
                'role_id'  => $adminRole->id,
                'phone'    => '081234560001',
                'is_active' => true,
            ]
        );

        // 2. Operator
        User::updateOrCreate(
            ['email' => 'operator@ambulancesiaga.org'],
            [
                'name'     => 'Operator Ambulans Siaga',
                'password' => Hash::make('password'),
                'role_id'  => $operatorRole->id,
                'phone'    => '081234560002',
                'is_active' => true,
            ]
        );

        // 3. Supir 1
        $supirUser1 = User::updateOrCreate(
            ['email' => 'supir1@ambulancesiaga.org'],
            [
                'name'     => 'Ahmad Supriyadi',
                'password' => Hash::make('password'),
                'role_id'  => $supirRole->id,
                'phone'    => '081234560003',
                'is_active' => true,
            ]
        );

        Supir::updateOrCreate(
            ['user_id' => $supirUser1->id],
            [
                'no_wa'                 => '081234560003',
                'merk_kendaraan'        => 'Toyota HiAce Commuter',
                'plat_nomor'            => 'R 1890 SC',
                'nomor_sim'             => 'SIM-B1-9988776655',
                'nomor_stnk'            => 'STNK-1890-2027',
                'status_online'         => true,
                'lokasi_terakhir_lat'   => -7.7188,
                'lokasi_terakhir_lng'   => 109.0159,
                'rating_rata_rata'      => 4.90,
                'total_perjalanan'      => 15,
            ]
        );

        // 4. Supir 2
        $supirUser2 = User::updateOrCreate(
            ['email' => 'supir2@ambulancesiaga.org'],
            [
                'name'     => 'Rahmat Hidayat',
                'password' => Hash::make('password'),
                'role_id'  => $supirRole->id,
                'phone'    => '081234560004',
                'is_active' => true,
            ]
        );

        Supir::updateOrCreate(
            ['user_id' => $supirUser2->id],
            [
                'no_wa'                 => '081234560004',
                'merk_kendaraan'        => 'Daihatsu Gran Max Ambulance',
                'plat_nomor'            => 'R 1722 TC',
                'nomor_sim'             => 'SIM-B1-1122334455',
                'nomor_stnk'            => 'STNK-1722-2028',
                'status_online'         => true,
                'lokasi_terakhir_lat'   => -7.7250,
                'lokasi_terakhir_lng'   => 109.0080,
                'rating_rata_rata'      => 5.00,
                'total_perjalanan'      => 8,
            ]
        );

        // 5. Masyarakat 1
        $masyarakatUser1 = User::updateOrCreate(
            ['email' => 'masyarakat@ambulancesiaga.org'],
            [
                'name'     => 'Siti Aminah (Masyarakat)',
                'password' => Hash::make('password'),
                'role_id'  => $masyarakatRole->id,
                'phone'    => '081234560005',
                'is_active' => true,
            ]
        );

        Masyarakat::updateOrCreate(
            ['user_id' => $masyarakatUser1->id],
            [
                'nik'             => '3301015006900001',
                'alamat'          => 'Jl. Gatot Subroto No. 45, Sidanegara, Cilacap Tengah',
                'tanggal_lahir'   => '1990-06-15',
                'jenis_kelamin'   => 'P',
                'kontak_darurat'  => '081987654321',
            ]
        );

        // 6. Masyarakat 2
        $masyarakatUser2 = User::updateOrCreate(
            ['email' => 'budi@gmail.com'],
            [
                'name'     => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role_id'  => $masyarakatRole->id,
                'phone'    => '081234560006',
                'is_active' => true,
            ]
        );

        Masyarakat::updateOrCreate(
            ['user_id' => $masyarakatUser2->id],
            [
                'nik'            => '3301021203850002',
                'alamat'         => 'Jl. Letjen Suprapto, Kebonmanis, Cilacap Utara',
                'tanggal_lahir'  => '1985-03-12',
                'jenis_kelamin'  => 'L',
                'kontak_darurat' => '081299887766',
            ]
        );
    }
}
