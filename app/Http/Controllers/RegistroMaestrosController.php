<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\GrupoAlumno;
use App\GrupoCodigo;
use App\Maestro;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroMaestrosController extends Controller
{
    //
    public function registrar(Request $r){
        //registramos primero el usuario
        $usuario = Usuario::create([
            'name' => $r->get('name'),
            'email' => $r->get('email'),
            'password' => Hash::make($r->get('password')),
            'role'=>'maestro',
            'active'=>false
        ]);

        //registramos el maestro
        $maestro = new Maestro();
        $maestro->nombre = $r->get("name");
        $maestro->apellido_paterno = $r->get("apellido_paterno");
        $maestro->apellido_materno = $r->get("apellido_materno");
        $maestro->telefono = $r->get("telefono");
        $maestro->numero_empleado = $r->get("numero_control");
        $maestro->user_id = $usuario->id;
        $maestro->save();

        return redirect("/login")->withErrors(['active'=>["Por favor contacte a su administrador para activar su usuario como Maestro."]]);

    }
}
