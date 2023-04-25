<?php

namespace App\Nova\Actions;

use App\Mail\GenericEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class EnviarEmailInvitacion1 extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Enviar Correo Genérico";
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach($models as $model) {
            Mail::to($model->alumno_email)->send(new GenericEmail($fields["msg"],$fields["subject"]));
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make("Asunto","subject"),
            Textarea::make("Mensaje","msg")
        ];
    }
}
