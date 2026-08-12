<?php

use App\Http\Controllers\LaporanExportController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AmbulansIndex as AdminAmbulansIndex;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\JadwalIndex as AdminJadwalIndex;
use App\Livewire\Admin\LaporanIndex as AdminLaporanIndex;
use App\Livewire\Admin\LogAktivitasIndex as AdminLogAktivitasIndex;
use App\Livewire\Admin\RumahSakitIndex as AdminRumahSakitIndex;
use App\Livewire\Admin\SettingIndex as AdminSettingIndex;
use App\Livewire\Admin\UsersIndex as AdminUsersIndex;
use App\Livewire\Operator\Dashboard as OperatorDashboard;
use App\Livewire\Operator\LiveMonitoring as OperatorLiveMonitoring;
use App\Livewire\Operator\OrderIndex as OperatorOrderIndex;
use App\Livewire\Masyarakat\Beranda;
use App\Livewire\Masyarakat\InfoGsc;
use App\Livewire\Masyarakat\Donasi;
use App\Livewire\Masyarakat\MitraPengemudi;
use App\Livewire\Masyarakat\MitraArmada;
use App\Livewire\Masyarakat\OrderComplete;
use App\Livewire\Masyarakat\OrderCreate;
use App\Livewire\Masyarakat\OrderIndex as MasyarakatOrderIndex;
use App\Livewire\Masyarakat\OrderTracking;
use App\Livewire\Supir\Dashboard as SupirDashboard;
use App\Livewire\Supir\OrderShow as SupirOrderShow;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes GSC SIAGA - Yayasan Gerak Sedekah Cilacap
|--------------------------------------------------------------------------
*/

// Halaman utama: Beranda GSC SIAGA
Route::get('/', Beranda::class)->name('home');

// Halaman Tentang Kami GSC
Route::get('/tentang-kami', InfoGsc::class)->name('masyarakat.info');

// Halaman Donasi GSC
Route::get('/donasi', Donasi::class)->name('donasi');

// Halaman Kemitraan
Route::get('/mitra/pengemudi', MitraPengemudi::class)->name('mitra.pengemudi');
Route::get('/mitra/armada', MitraArmada::class)->name('mitra.armada');

// Halaman Buat Pesanan Darurat (Dapat diakses langsung)
Route::get('/order/new', OrderCreate::class)->name('masyarakat.order.create');
Route::get('/order/{id}/complete', OrderComplete::class)->middleware('auth')->name('masyarakat.order.complete');
Route::get('/order/{id}/tracking', OrderTracking::class)->name('masyarakat.tracking');

// Smart Redirector untuk /dashboard berdasarkan Role
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $user = auth()->user();

    // Redirect dashboard based on role
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('operator')) {
        return redirect()->route('operator.dashboard');
    } elseif ($user->hasRole('supir')) {
        return redirect()->route('supir.dashboard');
    }

    return redirect()->route('masyarakat.order.index');
})->name('dashboard');

// Group Protected Routes
Route::middleware('auth')->group(function () {
    // Profile Controller Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 1. MODUL MASYARAKAT
    Route::prefix('masyarakat')->name('masyarakat.')->group(function () {
        Route::get('/orders', MasyarakatOrderIndex::class)->name('order.index');
        Route::get('/orders-list', MasyarakatOrderIndex::class)->name('orders.index');
    });

    // 2. MODUL OPERATOR
    Route::middleware('role:operator')->prefix('operator')->name('operator.')->group(function () {
        Route::get('/dashboard', OperatorDashboard::class)->name('dashboard');
        Route::get('/orders', OperatorOrderIndex::class)->name('orders');
        Route::get('/orders-index', OperatorOrderIndex::class)->name('order.index');
        Route::get('/orders-list', OperatorOrderIndex::class)->name('orders.index');
        Route::get('/monitoring', OperatorLiveMonitoring::class)->name('monitoring');
    });

    // 3. MODUL SUPIR AMBULANS (Role: superadmin, supir)
    Route::middleware('role:supir')->prefix('supir')->name('supir.')->group(function () {
        Route::get('/dashboard', SupirDashboard::class)->name('dashboard');
        Route::get('/tugas', \App\Livewire\Supir\TugasIndex::class)->name('tugas.index');
        Route::get('/perjalanan-aktif', \App\Livewire\Supir\PerjalananAktif::class)->name('perjalanan.aktif');
        Route::get('/orders/{id}', SupirOrderShow::class)->name('orders.show');
        Route::get('/tugas/{id}', SupirOrderShow::class)->name('tugas.detail');
    });

    // 4. MODUL ADMIN
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/users', AdminUsersIndex::class)->name('users.index');
        Route::get('/supir', AdminUsersIndex::class)->name('supir.index');
        Route::get('/ambulans', AdminAmbulansIndex::class)->name('ambulans.index');
        Route::get('/jadwal', AdminJadwalIndex::class)->name('jadwal.index');
        Route::get('/rumahsakit', AdminRumahSakitIndex::class)->name('rumahsakit.index');
        Route::get('/laporan', AdminLaporanIndex::class)->name('laporan.index');
        Route::get('/laporan/export-pdf', [LaporanExportController::class, 'exportPdf'])->name('laporan.export.pdf');
        Route::get('/laporan/export-excel', [LaporanExportController::class, 'exportExcel'])->name('laporan.export.excel');
        Route::get('/orders', OperatorOrderIndex::class)->name('orders.index');
        Route::get('/logs', AdminLogAktivitasIndex::class)->name('logs.index');
        Route::get('/audit', AdminLogAktivitasIndex::class)->name('audit.index');
        Route::get('/settings', AdminSettingIndex::class)->name('settings.index');
    });
});

require __DIR__.'/auth.php';
