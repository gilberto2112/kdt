<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class GrupoAlumno extends Model
{

    protected  $table = "grupos_alumnos";

    public function grupo() {
        return $this->belongsTo(Grupo::class,"grupo_id","id");
    }

    public function alumno() {
        return $this->belongsTo(Alumno::class,"alumno_id","id");
    }

}
