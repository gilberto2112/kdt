<?php

namespace App\Providers;

use App\LeccionGrupo;
use App\Policies\LeccionExamenPolicy;
use App\Policies\ProblemaPolicy;
use App\Policies\UnidadPolicy;
use App\Problema;
use App\Unidad;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Problema::class => ProblemaPolicy::class,
        LeccionGrupo::class => LeccionExamenPolicy::class,
        Unidad::class=>UnidadPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
