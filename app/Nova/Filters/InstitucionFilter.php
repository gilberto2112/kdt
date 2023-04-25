<?php

namespace App\Nova\Filters;

use App\Institucion;
use App\Leccion as AppLeccion;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class InstitucionFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where("institucion_id",$value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {

        $lecciones = Institucion::all()->mapWithKeys(function($q){return [$q->nombre=>$q->id];});
        return $lecciones->toArray();
    }
}
