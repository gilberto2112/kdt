<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
class Alumno extends Model
{

    protected  $table = "alumnos";

    public function usuario() {
        return $this->belongsTo(Usuario::class,"user_id","id");
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class,"grupo_id","id");
    }



    public function getNombreCompleto() {
        return $this->nombre.' '.$this->apellido_paterno.' '.$this->apellido_materno;
    }


    /**
     *
     * old
     */

    public function grupos() {
        return $this->belongsToMany(Grupo::class,"grupos_alumnos","alumno_id","grupo_id");
    }


}
