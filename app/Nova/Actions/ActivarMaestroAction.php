<?php

namespace App\Nova\Actions;

use App\Maestro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ActivarMaestroAction extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Activar Maestro(s)";

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //
        foreach($models as $model){
            $maestro = Maestro::find($model->id);

            if($maestro->usuario) {
                $maestro->usuario->active = 1;
                $maestro->usuario->save();
            }
        }
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
