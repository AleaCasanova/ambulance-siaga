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
                $view->with('namaGsc', \App\Models\SettingAplikasi::getVal('nama_organisasi', 'Yayasan Gerak Sedekah Cilacap (GSC)'));
                $view->with('emailGsc', \App\Models\SettingAplikasi::getVal('email_organisasi', 'info@gsc-cilacap.org'));
                $view->with('alamatGsc', \App\Models\SettingAplikasi::getVal('alamat_kantor', 'Jl. Raya Cilacap No. 10, Sidanegara, Cilacap Tengah'));
                $view->with('tentangGsc', \App\Models\SettingAplikasi::getVal('tentang_gsc', 'Yayasan Gerak Sedekah Cilacap (GSC) adalah lembaga amil zakat profesional...'));
            });
        } catch (\Exception $e) {
            // Ignore during setup/migrations when table may not exist yet
        }
    }
}

