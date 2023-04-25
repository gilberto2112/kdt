<?php

namespace App\Policies;

use App\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;
Use App\Leccion;
use App\LeccionGrupo;
use App\Problema;

class LeccionExamenPolicy
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

    public function view(Usuario $usuario, LeccionGrupo $leccionGrupo){
        if(auth()->user()->isMaestro()) {
            if($leccionGrupo->grupo->maestro_id===auth()->user()->maestro->id) {
                return true;
            }
        }
        return in_array($usuario->role,['administrador']);
    }

    public function update(Usuario $usuario, LeccionGrupo $leccionGrupo){

        if(auth()->user()->isMaestro()) {
            if($leccionGrupo->grupo->maestro_id===auth()->user()->maestro->id) {
                return true;
            }
        }
        return $usuario->role==='administrador';
    }

    public function delete(Usuario $usuario){
        return $usuario->role==='administrador';
    }


}
