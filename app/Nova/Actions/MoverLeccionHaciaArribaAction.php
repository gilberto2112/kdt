<?php

namespace App\Nova\Actions;

use App\Leccion;
use App\LeccionProblema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class MoverLeccionHaciaArribaAction extends Action
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
        //

        foreach($models as $model){

            $leccion = Leccion::find($model->id);

            $leccionSiguiente =  Leccion::where('unidad_id',$leccion->unidad_id)->where('posicion',$leccion->posicion-1)->first();
            if($leccionSiguiente) {
                $leccion->posicion--;
                $leccion->save();

                $leccionSiguiente->posicion++;
                $leccionSiguiente->save();
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
