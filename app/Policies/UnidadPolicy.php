<?php

namespace App\Policies;

use App\Alumno;
use App\Grupo;
use App\Nova\GrupoAlumno;
use App\Unidad;
use App\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnidadPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function create(Usuario $usuario){
        return $usuario->role==='administrador';
    }


    public function view(Usuario $usuario, Unidad $unidad){


        if(in_array($usuario->role,['alumno'])) {
            $grupo = $usuario->alumno->grupo;
            if($grupo->unidades->count()>0){
                return $grupo->unidades->filter(function($q) use ($usuario,$unidad){
                    return $q->id===$unidad->id;
                })->count() > 0;
            }
            return true;
        }
        return in_array($usuario->role,['administrador','alumno',"maestro"]);
    }

    public function update(Usuario $usuario){
        return $usuario->role==='administrador';
    }

    public function delete(Usuario $usuario){
        return $usuario->role==='administrador';
    }

}
