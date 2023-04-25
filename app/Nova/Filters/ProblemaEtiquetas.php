<?php

namespace App\Nova\Filters;

use App\Etiqueta;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class ProblemaEtiquetas extends BooleanFilter
{
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
        $trueValues = collect($value)->filter(function($q){
            return $q===true;
        })->map(function($q,$k){
            return $k;
        })->values();

        if($trueValues->count() <= 0) {
            return;
        }
        $query->whereHas("etiquetas",function($q) use ($trueValues){
            $q->whereIn("etiquetas.id",$trueValues);
        });
    
        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $etiquetas = Etiqueta::all()->mapWithKeys(function($item){
            return [$item->nombre=>$item->id];
        });
        return $etiquetas;
    }
}
