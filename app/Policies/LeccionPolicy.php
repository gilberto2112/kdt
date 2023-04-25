<?php

namespace App\Policies;

use App\Grupo;
use App\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;
Use App\Leccion;
use App\Problema;
use Illuminate\Support\Arr;

class LeccionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Usuario $usuario){
        return $usuario->role==='administrador';
    }

    public function view(Usuario $usuario,Leccion $leccion){
        if($usuario->role==="alumno"){
            //obtenemos todas las lecciones anteriores
            if($leccion->completar_anteriores_obligatorio){
                $completadas =
                    $leccion
                        ->unidad
                        ->lecciones()
                        ->where("posicion","<",$leccion->posicion)
                        ->get()
                        ->every(function($q){
                            return $q->completada()===true;
                        });

                if(!$completadas) return false;
            }

            if($leccion->grupos->count()>0) {
                $gruposIds = $leccion->grupos->map(function($q) { return $q->id;})->toArray();
                if(!in_array(auth()->user()->alumno->grupo->id,$gruposIds)){
                   return false;
                }
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

    public function attachAnyProblema(Usuario $usuario){
        return $usuario->role==='administrador';
    }

    public function attachProblema(Usuario $usuario, Leccion $leccion, Problema $problema){
        return $usuario->role==='administrador';
    }

    public function detachProblema(Usuario $usuario, Leccion $leccion, Problema $problema){
        return $usuario->role==='administrador';
    }

    public function editAnyProblema(Usuario $usuario, Leccion $leccion, Problema $problema){
        return $usuario->role==='administrador';
    }

    public function viewGrupo(Usuario $usuario){
        return $usuario->role==='administrador';
    }
    public function viewAnyGrupo(Usuario $usuario){
        return $usuario->role==='administrador';
    }
    public function attachAnyGrupo(Usuario $usuario){
        return $usuario->role==='administrador';
    }
    public function attachGrupo(Usuario $usuario, Leccion $leccion, Grupo $grupo){
        return $usuario->role==='administrador';
    }
    public function detachGrupo(Usuario $usuario, Leccion $leccion, Grupo $grupo){
        return $usuario->role==='administrador';
    }
    public function editAnyGrupo(Usuario $usuario, Leccion $leccion, Grupo $grupo){
        return $usuario->role==='administrador';
    }
}
