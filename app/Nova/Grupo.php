<?php

namespace App\Nova;

use App\GrupoCodigo;
use App\Nova\Actions\GenerarGrupoCodigo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Usuario;
use Khalin\Nova\Field\Link;
use Laravel\Nova\Fields\BelongsToMany;

class Grupo extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Grupo';

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

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query = $query->withoutGlobalScope('hideNotVisible');
        if (\Auth::user()->role === "administrador") {
            return $query;
        }
        if (\Auth::user()->role === "maestro") {
            $query->where("maestro_id", \Auth::user()->maestro->id);
            return $query;
        }
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
        return [
            ID::make()->sortable(),
            Boolean::make("Visible",'visible'),
            Date::make("Fecha Inicial",'fecha_inicial'),
            Text::make("Nombre"),
            Text::make("Último Código de Grupo", function () {
                $grupoCodigo = GrupoCodigo::where("grupo_id", $this->id)
                    ->orderBy("id", "desc")->first();

                if ($grupoCodigo === null) {
                    return "(No se ha generado ningun código)";
                }

                return $grupoCodigo->codigo;
            }),
            BelongsTo::make("Maestro", "maestro")
                ->showOnIndex(function () {
                    return \Auth::user()->isAdministrador();
                })->showOnDetail(function () {
                    return \Auth::user()->isAdministrador();
                })->showOnCreating(function(){
                    return \Auth::user()->isAdministrador();
                })->showOnUpdating(function(){
                    return \Auth::user()->isAdministrador();
                }),
            HasMany::make("Alumnos", "alumnos"),
            BelongsToMany::make("Unidades", "unidades",'App\Nova\Unidad'),
            BelongsToMany::make("Lecciones", "lecciones", "App\Nova\Leccion")->fields(function () {
                return [
                    Boolean::make('Es Exámen','es_examen'),
                    Number::make('Total Horas','total_horas'),
                    DateTime::make('Fecha Inicio','fecha_inicio'),
                    DateTime::make('Fecha Fin','fecha_fin'),
                ];
            }),
            Text::make('Reporte Progreso Semanal',function(){
                return "<a href=\"/reportes/progreso-grupo-profesor/{$this->id}\">IR</a>";
            })->asHtml(),
            Number::make('Puntos Semanales','puntos_por_semana'),
            HasMany::make('Puntos Minimos Semanales','grupoPuntosMinimos','App\Nova\GrupoPuntosMinimos')

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
        return [
            new GenerarGrupoCodigo()
        ];
    }

    public static function availableForNavigation(Request $request)
    {
        $role = \App\Usuario::find(\Auth::user()->id)->role;
        return in_array($role, ["administrador", "maestro"]);
    }
}
