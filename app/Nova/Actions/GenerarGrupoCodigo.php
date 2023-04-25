<?php

namespace App\Nova\Actions;

use App\GrupoCodigo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class GenerarGrupoCodigo extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $gruposCodigos = [];
        foreach($models as $model){
            $grupoCodigo = new GrupoCodigo();
            $grupoCodigo->codigo = $model->id;
            $grupoCodigo->grupo_id = $model->id;
            $grupoCodigo->save();

            $gruposCodigos[] = $grupoCodigo;
        }

        return Action::message('Se han generado los códigos de los grupos correctamente');

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
