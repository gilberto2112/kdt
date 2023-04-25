<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{

    protected $table = "lecciones";

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, "unidad_id", "id");
    }

    public function problemas()
    {
        return $this->hasMany(Problema::class, "leccion_id", "id");
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, "lecciones_grupos", "leccion_id", "grupo_id")
            ->withPivot(['es_examen', 'total_horas', 'fecha_inicio', 'fecha_fin'])->using(LeccionGrupo::class);
    }
    public function leccionGrupos()
    {
        return $this->hasMany(LeccionGrupo::class, "leccion_id", "id");
    }


    /**
     * Post Loading
     * @return bool
     */
    public function completada(): bool
    {
        $problemas_ids = $this->problemas->map(function ($q) {
            return $q->id;
        });

        $usuario_problemas = UsuarioProblema::whereIn("problema_id", $problemas_ids)
            ->where("usuario_id", \Auth::user()->id)
            ->get();

        $total_resueltos = $usuario_problemas->filter(function ($q) {
            return $q->puntos >= $q->problema->puntos;
        })->count();

        if ($this->problemas->count() === 0) {
            return 0;
        }

        return $total_resueltos === $this->problemas->count();
    }


    public function examen()
    {
        return $this->hasOne(LeccionGrupo::class, "leccion_id", "id");
    }
}
