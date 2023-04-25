<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{

    protected $table = "unidades";

    public function lecciones()
    {
        return $this->hasMany(Leccion::class, "unidad_id", "id");
    }

    /*** post loaded */
    public function totalProblemas()
    {
        $unidadId = $this->id;
        $problemas = Problema::whereHas("leccion", function ($q) use ($unidadId) {
            $q->where("unidad_id", $unidadId);
        })->count();

        return $problemas;
    }

}
