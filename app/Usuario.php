<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    protected $table = "users";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function maestro()
    {
        return $this->hasOne(Maestro::class, "user_id", "id");
    }

    public function alumno()
    {
        return $this->hasOne(Alumno::class, "user_id", "id");
    }

    public function instituciones()
    {
        return $this->belongsToMany(Institucion::class, "instituciones_usuarios", "usuario_id",'institucion_id');
    }


    /****
     * post loaded
     */

    public function totalPuntosPrograma() {
        $usuario = Usuario::find($this->id);
        $problemasResueltos = UsuarioProblema::where("usuario_id", $usuario->id)->sum('puntos');
        return $problemasResueltos;

    }

    public function problemasResueltosDePrograma()
    {
        $usuario = Usuario::find($this->id);

        //solo problemas que no pertenezcan a una lección que esté asignada a un examen
        $problemasResueltos = UsuarioProblema::whereDoesntHave('problema.leccion.leccionGrupos',function($q){
            $q->where('es_examen',1)
              ->where('grupo_id',$this->alumno->grupo->id);

        })->where("usuario_id", $usuario->id)->count();

        return $problemasResueltos;
    }

    public function problemasResueltosDeUnidad($unidadId)
    {
        $usuario = Usuario::find($this->id);

        $problemasResueltos = UsuarioProblema::where("usuario_id", $usuario->id)
            ->whereHas("problema", function ($q) use ($unidadId) {
                $q->whereHas("leccion", function ($q1) use ($unidadId) {
                    $q1->where("unidad_id", $unidadId);
                });
            })->count();

        return $problemasResueltos;
    }

    public function isAlumno()
    {
        return $this->role === "alumno";
    }


    public function isMaestro()
    {
        return $this->role === "maestro";
    }

    public function isAdministrador()
    {
        return $this->role === "administrador";
    }

}
