<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class ProgresoSemanualGrupoAlumno extends Model
{

    protected $table = "progreso_semanual_grupo_alumno";


    public function grupo() {
        return $this->belongsTo(Grupo::class,"grupo_id","id");
    }

    public function alumno() {
        return $this->belongsTo(Alumno::class,"alumno_id","id");
    }





}
