<?php

namespace App\Nova\Actions;

use App\Leccion;
use App\LeccionProblema;
use App\Problema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class MoverProblemaHaciaAbajoAction extends Action
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

            $problema = Problema::find($model->id);

            $problemaSiguiente =  Problema::where('leccion_id',$problema->leccion_id)->where('posicion',$problema->posicion+1)->first();
            if($problemaSiguiente) {
                $problema->posicion++;
                $problema->save();

                $problemaSiguiente->posicion--;
                $problemaSiguiente->save();
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
