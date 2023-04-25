<?php

namespace App\Nova;

use App\Nova\Actions\EnviarEmailInvitacion1;
use App\Nova\Actions\ExportTop100Action;
use App\Nova\Filters\Leccion;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Usuario;
use App\Problema;
use Signifly\Nova\Fields\ProgressBar\ProgressBar;

class ResultadosPorLeccion extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\ResultadosPorLeccion';


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        "alumno_email", 'grupo_nombre',"alumno_nombre","maestro_nombre"
    ];

    public static $orderBy = ['avance' => 'desc'];

    public static $perPageOptions = [1000];


    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make("Alumno","alumno_nombre")->sortable(),
            Text::make("Email","alumno_email")->sortable(),
            Text::make("Puntos","suma_puntos")->sortable(),
            Text::make("Avance %", function () {
                return number_format($this->avance,1);
            }),
            Text::make("Grupo","grupo_nombre")->sortable(),
            Text::make("Maestro","maestro_nombre"),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Leccion
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new ExportTop100Action,
            (new EnviarEmailInvitacion1)
        ];
    }

     public static function availableForNavigation(Request $request){
        $role = Usuario::find(\Auth::user()->id)->role;
        return in_array($role,["administrador"]);
    }
}
