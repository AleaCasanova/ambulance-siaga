<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            \Illuminate\Support\Facades\View::composer('*', function ($view) {
                $view->with('hotlineGsc', \App\Models\SettingAplikasi::getVal('telepon_darurat', '0812-3456-7890'));
                $view->with('namaGsc', \App\Models\SettingAplikasi::getVal('nama_organisasi', 'Ambulans Siaga'));
                $view->with('emailGsc', \App\Models\SettingAplikasi::getVal('email_organisasi', 'info@ambulansiaga.org'));
                $view->with('alamatGsc', \App\Models\SettingAplikasi::getVal('alamat_kantor', 'Pusat Koordinasi Layanan Ambulans Siaga'));
                $view->with('tentangGsc', \App\Models\SettingAplikasi::getVal('tentang_gsc', 'Ambulans Siaga adalah platform tanggap darurat terpadu 24 jam yang menghubungkan armada ambulans lintas-mitra untuk melayani evakuasi medis, rujukan, dan gawat darurat secara cepat dan transparan.'));
            });
        } catch (\Exception $e) {
            // Ignore during setup/migrations when table may not exist yet
        }
    }
}

