<?php

namespace App\Nova;

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

class Alumno extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Alumno';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nombre';

    public static $perPageOptions = [100];
    public static $perPageViaRelationship = 500;

    public function title() {
        return $this->nombre . " " . $this->apellido_paterno . " " . $this->apellido_materno;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nombre','apellido_paterno','apellido_materno','telefono','numero_control'
    ];

    public static $searchRelations = [
        'usuario' => ['email'],
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {

        $totalProblemas = Problema::count();

        return [
            // ID::make()->sortable(),
            Text::make("Nombre")->sortable(),
            Text::make("Apellido Paterno","apellido_paterno")->sortable(),
            Text::make("Apellido Materno","apellido_materno")->sortable(),
            ProgressBar::make("Avance",function() use ($totalProblemas){
                return $this->usuario->problemasResueltosDePrograma()/$totalProblemas;
            }),
            Text::make('Puntos',function(){
                return $this->usuario->totalPuntosPrograma();
            }),
            Text::make("Email",function(){
                return $this->usuario->email;
            }),
            Text::make("Teléfono","telefono")->sortable(),
            // Text::make("Número de Control","numero_control")->sortable(),

            BelongsTo::make("Usuario"),

            BelongsTo::make("Su Grupo",'grupo','App\Nova\Grupo')
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
        return [];
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
        return [];
    }

     public static function availableForNavigation(Request $request){
        $role = Usuario::find(\Auth::user()->id)->role;
        return in_array($role,["administrador"]);
    }
}
