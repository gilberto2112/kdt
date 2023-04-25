<?php


namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{

    protected  $table = "grupos";

    protected $casts = [
        'fecha_inicial'=>'date'
    ];


    public function grupoAlumnos() {
        return $this->hasMany(GrupoAlumno::class,"grupo_id","id");
    }

    public function maestro() {
        return $this->belongsTo(Maestro::class,"maestro_id","id");
    }

    public function alumnos() {
        return $this->hasMany(Alumno::class,"grupo_id","id");
    }

    public function unidades()
    {
        return $this->belongsToMany(Unidad::class, "unidades_grupos", "grupo_id", "unidad_id");
    }


    public function lecciones()
    {
        return $this->belongsToMany(Leccion::class, "lecciones_grupos", "grupo_id", "leccion_id")
            ->withPivot(['es_examen', 'total_horas', 'fecha_inicio', 'fecha_fin'])->using(LeccionGrupo::class);
    }

    public function progresoSemanualGrupoAlumno() {
        return $this->hasMany(ProgresoSemanualGrupoAlumno::class,'grupo_id','id');
    }

    public function grupoPuntosMinimos() {
        return $this->hasMany(GrupoPuntosMinimos::class,'grupo_id','id');
    }

    protected static function booted()
    {
        static::addGlobalScope('hideNotVisible', function (Builder $builder) {
            $builder->where('visible', 1);
        });
    }
}
