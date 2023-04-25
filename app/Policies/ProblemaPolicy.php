<?php

namespace App\Policies;

use App\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProblemaPolicy
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

    public function view(Usuario $usuario){

        return in_array($usuario->role,['administrador','alumno','maestro']);
    }

    public function update(Usuario $usuario){
        return in_array($usuario->role,['administrador',]);
    }

    public function delete(Usuario $usuario){
        return in_array($usuario->role,['administrador',]);
    }


}
