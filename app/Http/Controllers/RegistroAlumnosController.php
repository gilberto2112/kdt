<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\GrupoAlumno;
use App\GrupoCodigo;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistroAlumnosController extends Controller
{
    public function registrar(Request $r){

        if(Usuario::where("email",$r->get("email"))->count()>0){
            return redirect()->back()->withInput()->withErrors(["email"=>"El correo electrónico proporcionado ya está registrado"]);
        }

       if(GrupoCodigo::where("codigo", $r->get("codigo_profesor"))->count()===0){
            return redirect()->back()->withInput()->withErrors(["codigo_profesor"=>"El código de profesor proporcionado no existe"]);
       }



        //registramos primero el usuario
        DB::transaction(function () use ($r){

            $usuario = Usuario::create([
                'name' => $r->get('name'),
                'email' => $r->get('email'),
                'password' => Hash::make($r->get('password')),
                'role' => 'alumno',
                'active' => true
            ]);

            $grupoCodigo = GrupoCodigo::where("codigo", $r->get("codigo_profesor"))->first();
            //registramos el alumno

            $alumno = new Alumno();
            $alumno->nombre = $r->get("name");
            $alumno->apellido_paterno = $r->get("apellido_paterno");
            $alumno->apellido_materno = $r->get("apellido_materno");
            $alumno->telefono = $r->get("telefono");
            $alumno->numero_control = $r->get("numero_control");
            $alumno->user_id = $usuario->id;
            $alumno->grupo_id = $grupoCodigo->grupo_id;
            $alumno->save();

            //lo asignamos al grupo del profesor
        });

        $credentials = $r->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect("/nova");
        }

        return redirect()->back();


    }
}
