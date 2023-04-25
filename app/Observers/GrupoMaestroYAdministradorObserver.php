<?php

namespace App\Observers;

use App\Grupo;
use App\GrupoCodigo;
use Illuminate\Support\Facades\Hash;

class GrupoMaestroYAdministradorObserver
{



    /**
     * Handle the grupo "saving" event.
     *
     * @param  \App\Grupo  $grupo
     * @return void
     */
    public function saving(Grupo $grupo)
    {
        if(\Auth::user()->isMaestro()){
            $grupo->maestro_id = \Auth::user()->maestro->id;
        }
    }



    /**
     * Handle the grupo "created" event.
     *
     * @param  \App\Grupo  $grupo
     * @return void
     */
    public function created(Grupo $grupo)
    {
        //

        $grupoCodigo = new GrupoCodigo();
        $grupoCodigo->codigo = Hash::make(uniqid());
        $grupoCodigo->grupo_id = $grupo->id;
        $grupoCodigo->save();

    }

    /**
     * Handle the grupo "updated" event.
     *
     * @param  \App\Grupo  $grupo
     * @return void
     */
    public function updated(Grupo $grupo)
    {
        //
    }

    /**
     * Handle the grupo "deleted" event.
     *
     * @param  \App\Grupo  $grupo
     * @return void
     */
    public function deleted(Grupo $grupo)
    {
        //
    }

    /**
     * Handle the grupo "restored" event.
     *
     * @param  \App\Grupo  $grupo
     * @return void
     */
    public function restored(Grupo $grupo)
    {
        //
    }

    /**
     * Handle the grupo "force deleted" event.
     *
     * @param  \App\Grupo  $grupo
     * @return void
     */
    public function forceDeleted(Grupo $grupo)
    {
        //
    }
}
