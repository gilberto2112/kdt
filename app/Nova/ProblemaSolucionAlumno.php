<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;


class ProblemaSolucionAlumno extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\ProblemaSolucionAlumnoView';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'alumno_nombre_completo';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'alumno_nombre_completo'
    ];

    public static $orderBy = ['grupo_nombre'=>'asc','alumno_nombre_completo'=>'asc'];

    public static $perPageViaRelationship = 1000;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
           Text::make('Alumno','alumno_nombre_completo'),
           Text::make('Grupo','grupo_nombre'),
           Text::make('Profesor','grupo_maestro'),
           Text::make('Puntos','puntos'),
           Code::make('Ultimo Código','ultimo_codigo')->language('javascript')->onlyOnDetail(),
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
        $role = \App\Usuario::find(\Auth::user()->id)->role;
        return in_array($role,["administrador"]);
    }
}
