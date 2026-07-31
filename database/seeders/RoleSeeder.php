<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'superadmin',
                'label' => 'Super Admin',
                'description' => 'Akses penuh ke seluruh konfigurasi sistem dan manajemen pengguna',
            ],
            [
                'name' => 'admin_operasional',
                'label' => 'Admin Operasional',
                'description' => 'Mengelola armada ambulans, supir, rumah sakit, dan laporan',
            ],
            [
                'name' => 'dispatcher',
                'label' => 'Dispatcher',
                'description' => 'Menerima order masyarakat, menugaskan supir & ambulans, monitoring perjalanan',
            ],
            [
                'name' => 'supir',
                'label' => 'Supir Ambulans',
                'description' => 'Menerima tugas dari dispatcher, navigasi medis, update status & GPS',
            ],
            [
                'name' => 'masyarakat',
                'label' => 'Masyarakat',
                'description' => 'Memesan ambulans darurat, tracking posisi secara realtime, memberi ulasan',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
