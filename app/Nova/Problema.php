<?php

namespace App\Nova;

use App\LeccionProblema;
use App\Nova\Actions\EstablecerPosicionAction;
use App\Nova\Actions\MoverProblemaHaciaAbajoAction;
use App\Nova\Actions\MoverProblemaHaciaArribaAction;
use App\Nova\Filters\ProblemaEtiquetas;
use App\Usuario;
use App\UsuarioProblema;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Guillaumeferron\PostContent\PostContent;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Khalin\Nova\Field\Link;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Waynestate\Nova\CKEditor;

class Problema extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Problema';

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
    public static $search = ['nombre',];

    public static $with = ['leccion'];

    public static $perPageViaRelationship = 30;

    public static $perPageOptions = [1000];

    public static function orderBy()
    {
        return ['posicion' => 'asc', 'id' => 'asc'];
    }

    // public static function relatableQuery(NovaRequest $request, $query)
    // {
    //     return $query->doesntHave("lecciones");
    // }

    public static function indexQuery(NovaRequest $request, $query)
    {
        // You can modify your base query here.

        $query = $query->orderBy('posicion', 'asc');
        return $query;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        $fields[] = ID::make()->sortable()->hideFromIndex();
        $fields[] = Number::make('Posición','posicion');
        $fields[] = Text::make("Nombre");
        $fields[] = CKEditor::make("Descripción", "descripcion")->hideFromIndex()->hideFromDetail();
        $fields[] = Text::make("Puntos", function () {
            $usuarioProblema =
                UsuarioProblema
                    ::where("usuario_id", Auth::user()->id)
                    ->where("problema_id", $this->id);

            //puesto a que solo puede existir 1 registro por el índice único
            if ($usuarioProblema->count() === 1) {
                return $usuarioProblema->first()->puntos . "/" . $this->puntos;
            }
            return "0/" . $this->puntos;
        });
        $fields[] = Number::make("Puntos")->hideFromIndex();
        //$fields[] = Number::make("Dificultad");
        // $fields[] = BelongsToManyField::make('Etiquetas', 'etiquetas', 'App\Nova\Etiqueta')
        //     ->optionsLabel("nombre")
        //     ->hideFromIndex(function () use ($request) {
        //         return in_array($request->viaResource, ['leccions']);
        //     });
        $fields[] = Boolean::make("Resuelto", function () {
            $puntos = 0;
            $usuarioProblema = UsuarioProblema::where("usuario_id", Auth::user()->id)->where("problema_id", $this->id);
            //puesto a que solo puede existir 1 registro por el índice único
            if ($usuarioProblema->count() === 1) {
                $puntos = $usuarioProblema->first()->puntos;
            }
            return $puntos >= $this->puntos;
        });
        $fields[] = Select::make('Tipo', 'tipo')->options(['kareljs' => 'kareljs', 'nclab' => 'nclab','ccpp'=> 'c/c++']);

        $fields[] = HasOne::make('SolucionPorUsuario');


        $fields[] = Link::make('Evaluador Karel', 'id')->url(function () {
            return "/resolver/{$this->id}";
        })->text("Ir a Evaluador")->blank()->onlyOnDetail()->hideFromDetail(function () {
            return $this->tipo != 'kareljs';
        });

        $fields[] = Link::make('Evaluador C/C++', 'id')->url(function () {
            return "/resolver-ccpp/{$this->id}";
        })->text("Ir a Evaluador")->blank()->onlyOnDetail()->hideFromDetail(function () {
            return $this->tipo != 'ccpp';
        });
        $fields[] = BelongsTo::make("Lección", 'leccion','App\Nova\Leccion')->hideFromIndex(function () use ($request) {
            return in_array($request->viaResource, ['leccions']);
        });


        $fields[] = Code::make("Solución Inicial", "solucion_inicial")->language('javascript');

        //SOLO ADMINISTRADOR

        if(auth()->user()->isAdministrador()) {
            $fields[] = HasMany::make("Karel JS Casos", "problemaKarelJsCasos", 'App\Nova\ProblemaKarelJsCaso')
                ->showOnDetail(function(){
                    return $this->tipo==='kareljs';
                });

            $fields[] = HasMany::make("C/C++ Casos", "problemaCCppCasos", 'App\Nova\ProblemaCCppCaso')
                ->showOnDetail(function(){
                    return $this->tipo==='ccpp';
                });
            $fields[] = HasMany::make('Soluciones por Usuario','problemaSolucionAlumno','App\Nova\ProblemaSolucionAlumno');
        }



        return $fields;
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ProblemaEtiquetas(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        $actions = [];

        $actions[] = new EstablecerPosicionAction();
        $actions[] = new MoverProblemaHaciaArribaAction();
        $actions[] = new MoverProblemaHaciaAbajoAction();

        return $actions;
    }

    public static function availableForNavigation(Request $request)
    {
        $role = Usuario::find(\Auth::user()->id)->role;
        return in_array($role, ["administrador"]);
    }
}
