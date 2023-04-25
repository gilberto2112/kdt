<?php

namespace App\Providers;

use App\Grupo;
use App\Maestro;
use App\Observers\GrupoMaestroYAdministradorObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Grupo::observe([
            GrupoMaestroYAdministradorObserver::class
        ]);
    }
}
