<?php

namespace App\Nova\Actions;

use App\Maestro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class EstablecerPosicionAction extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Establecer Posición";

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if($models->count()>1) return;

        $fmodel = $models->first();
        $fmodel->posicion = $fields['posicion'];
        $fmodel->save();

        return;
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Number::make("Posicion","posicion"),
        ];
    }
}
