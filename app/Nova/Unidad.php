<?php

namespace App\Nova;

use App\Alumno;
use App\Usuario;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\UsuarioProblema;
use Ek0519\Quilljs\Quilljs;
use Froala\NovaFroalaField\Froala;
use Guillaumeferron\PostContent\PostContent;
use Signifly\Nova\Fields\ProgressBar\ProgressBar;

class Unidad extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Unidad';

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


    public static function label()
    {
        return __('Unidades');
    }

    public static function singularLabel()
    {
        return __('Unidad');
    }

    public static $orderBy = ['id' => 'asc'];

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
            Textarea::make("Descripcion"),
            ProgressBar::make("Avance",function() {
                 $problemasResueltos = Usuario::find(\Auth::user()->id)->problemasResueltosDeUnidad($this->id);
                 $problemasDeUnidad = $this->totalProblemas();
                 if($problemasDeUnidad===0) return 0;

                 $totalLecciones = $this->lecciones->count();

                 return $problemasResueltos/$problemasDeUnidad;
            }),
            HasMany::make("Lecciones","lecciones","App\Nova\Leccion")
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
}
