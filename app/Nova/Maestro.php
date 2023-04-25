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
use AliAwwad\CreateRelationOnResource\BelongsToWithCreate;
use App\Nova\Actions\ActivarMaestroAction;
use App\Usuario;
use App\Nova\Actions\CrearMaestroCustom;
use App\Nova\Actions\DesactivarMaestroAction;
use Laravel\Nova\Fields\Boolean;

class Maestro extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Maestro';

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
            Text::make("Nombre"),
            Text::make("Apellido Paterno","apellido_paterno"),
            Text::make("Apellido Materno","apellido_materno"),
            Text::make("Teléfono","telefono"),
            Text::make("Número de Empleado","numero_empleado"),
            Text::make("Email",function(){
                if($this->usuario){
                    return $this->usuario->email;
                }

                return "(Sin Usuario)";
            }),
            BelongsToWithCreate::make("Usuario")->quickCreate(),
            Boolean::make("Activo",function() {

                if($this->usuario) {
                    return $this->usuario->active;
                }

                return false;
            })
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
            new CrearMaestroCustom,
            new ActivarMaestroAction,
            new DesactivarMaestroAction
        ];
    }

    public static function availableForNavigation(Request $request){
        $role = Usuario::find(\Auth::user()->id)->role;
        return in_array($role,["administrador"]);
    }
}
