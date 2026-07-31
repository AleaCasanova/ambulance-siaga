<?php

namespace App\Providers;

use App\Repositories\Contracts\AmbulansRepositoryInterface;
use App\Repositories\Contracts\LogAktivitasRepositoryInterface;
use App\Repositories\Contracts\PemesananRepositoryInterface;
use App\Repositories\Contracts\RumahSakitRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\AmbulansRepository;
use App\Repositories\Eloquent\LogAktivitasRepository;
use App\Repositories\Eloquent\PemesananRepository;
use App\Repositories\Eloquent\RumahSakitRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AmbulansRepositoryInterface::class, AmbulansRepository::class);
        $this->app->bind(PemesananRepositoryInterface::class, PemesananRepository::class);
        $this->app->bind(RumahSakitRepositoryInterface::class, RumahSakitRepository::class);
        $this->app->bind(LogAktivitasRepositoryInterface::class, LogAktivitasRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
