<?php

namespace App\Nova;

use App\Nova\Actions\EstablecerPosicionAction;
use App\Nova\Actions\MoverLeccionHaciaAbajoAction;
use App\Nova\Actions\MoverLeccionHaciaArribaAction;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Usuario;
use App\UsuarioProblema;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Signifly\Nova\Fields\ProgressBar\ProgressBar;

class Leccion extends Resource
{


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Leccion';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nombre';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nombre',
    ];

    public static $orderBy = ['posicion' => 'asc'];

    public static function label()
    {
        return __('Lecciones');
    }
    public static function singularLabel()
    {
        return __('Lección');
    }

    public static function indexQuery(NovaRequest $request, $query)
    {

        return $query;
    }


    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $fields =  [
            ID::make()->sortable(),
            Number::make('Posición','posicion'),
            Boolean::make('Anteriores Obligatorias','completar_anteriores_obligatorio'),
            Text::make("Nombre"),
            Textarea::make("Descripcion"),
            ProgressBar::make("Avance", function () {

                $problemas_ids = $this->problemas->map(function ($q) {
                    return $q->id;
                });

                $usuario_problemas =
                    UsuarioProblema
                    ::whereIn("problema_id", $problemas_ids)
                    ->where("usuario_id", \Auth::user()->id)
                    ->get();

                $total_resueltos = $usuario_problemas->filter(function ($q) {
                    return $q->puntos >= $q->problema->puntos;
                })->count();
                if ($this->problemas->count() === 0) return 0;
                return $total_resueltos / $this->problemas->count();
            }),
            Boolean::make("Completada", function () {
                return $this->completada();
            }),
            BelongsTo::make("Unidad"),
//            HasOne::make('Exámen', 'examen', 'App\Nova\LeccionExamen'),
            HasMany::make("Problemas", "problemas", "App\Nova\Problema"),
        ];

        if(auth()->user()->isAdministrador() || auth()->user()->isMaestro() ){
//             $fields[] = BelongsToMany::make("Grupos", "grupos", "App\Nova\Grupo")->fields(function () {
//                 return [
//                     Boolean::make('Es Exámen','es_examen'),
//                     Number::make('Total Horas','total_horas'),
//                     DateTime::make('Fecha Inicio','fecha_inicio'),
//                     DateTime::make('Fecha Fin','fecha_fin'),
//                 ];
//             });

            $fields[] = HasMany::make("Leccion-Grupo", "leccionGrupos", "App\Nova\LeccionGrupo");
        }

        return $fields;
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
        return [
            new EstablecerPosicionAction,
            new MoverLeccionHaciaArribaAction,
            new MoverLeccionHaciaAbajoAction
        ];
    }

    public static function availableForNavigation(Request $request)
    {
        $role = Usuario::find(\Auth::user()->id)->role;
        return in_array($role, ["administrador"]);
    }
}
