<?php

namespace App\Policies;

use App\ProblemaKarelJsCaso;
use App\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProblemaKarelJsCasoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any problema karel js casos.
     *
     * @param  \App\Usuario  $user
     * @return mixed
     */
    public function viewAny(Usuario $user)
    {
        //
        return $user->role==='administrador';

    }

    /**
     * Determine whether the user can view the problema karel js caso.
     *
     * @param  \App\Usuario  $user
     * @param  \App\ProblemaKarelJsCaso  $problemaKarelJsCaso
     * @return mixed
     */
    public function view(Usuario $user, ProblemaKarelJsCaso $problemaKarelJsCaso)
    {
        //
        return $user->role==='administrador';

    }

    /**
     * Determine whether the user can create problema karel js casos.
     *
     * @param  \App\Usuario  $user
     * @return mixed
     */
    public function create(Usuario $user)
    {
        //
        return $user->role==='administrador';

    }

    /**
     * Determine whether the user can update the problema karel js caso.
     *
     * @param  \App\Usuario  $user
     * @param  \App\ProblemaKarelJsCaso  $problemaKarelJsCaso
     * @return mixed
     */
    public function update(Usuario $user, ProblemaKarelJsCaso $problemaKarelJsCaso)
    {
        //
        return $user->role==='administrador';

    }

    /**
     * Determine whether the user can delete the problema karel js caso.
     *
     * @param  \App\Usuario  $user
     * @param  \App\ProblemaKarelJsCaso  $problemaKarelJsCaso
     * @return mixed
     */
    public function delete(Usuario $user, ProblemaKarelJsCaso $problemaKarelJsCaso)
    {
        //
        return $user->role==='administrador';

    }

    /**
     * Determine whether the user can restore the problema karel js caso.
     *
     * @param  \App\Usuario  $user
     * @param  \App\ProblemaKarelJsCaso  $problemaKarelJsCaso
     * @return mixed
     */
    public function restore(Usuario $user, ProblemaKarelJsCaso $problemaKarelJsCaso)
    {
        //
        return $user->role==='administrador';

    }

    /**
     * Determine whether the user can permanently delete the problema karel js caso.
     *
     * @param  \App\Usuario  $user
     * @param  \App\ProblemaKarelJsCaso  $problemaKarelJsCaso
     * @return mixed
     */
    public function forceDelete(Usuario $user, ProblemaKarelJsCaso $problemaKarelJsCaso)
    {
        //
        return $user->role==='administrador';

    }
}
