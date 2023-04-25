<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{

    protected $table = "problemas";

    protected $attributes = ['solucion_inicial'=>'class program {
    program () {
        // TODO poner codigo aqui
        turnoff();
    }
}'];

    public function etiquetas()
    {
        return $this->belongsToMany(
            Etiqueta::class,
            "problemas_etiquetas",
            "problema_id",
            "etiqueta_id");
    }
    public function usuariosProblema() {
        return $this->hasMany(UsuarioProblema::class,"problema_id","id");
    }

    public function problemaSolucionAlumno() {
        return $this->hasMany(ProblemaSolucionAlumnoView::class,"problema_id","id");
    }

    public function solucionPorUsuario(){
        return $this->hasOne(UsuarioProblema::class,"problema_id","id")->currentUser();
    }


    //lecciones a las que pertenece este problema
    public function leccion() {
        return $this->belongsTo(Leccion::class,"leccion_id","id");
    }


    public function problemaKarelJsCasos() {
        return $this->hasMany(ProblemaKarelJsCaso::class,"problema_id","id");
    }

    public function problemaCCppCasos()
    {
        return $this->hasMany(ProblemaCCppCaso::class, "problema_id", "id");
    }

    /** old  */

    public function leccionesProblema() {
        return $this->hasMany(LeccionProblema::class,"problema_id","id");
    }



}
