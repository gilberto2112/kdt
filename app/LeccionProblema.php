<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class LeccionProblema extends Model
{

    protected  $table = "lecciones_problemas";

    public function leccion() {
        return $this->belongsTo(Leccion::class,"leccion_id","id");
    }

    public function problema() {
        return $this->belongsTo(Problema::class,"problema_id","id");
    }

}
