<?php

namespace App\Http\Controllers;

use App\Leccion;
use App\LeccionGrupo;
use App\Problema;
use App\UsuarioComienzoLeccionExamen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamenesController extends Controller
{
    public function iniciarExamen($problemaId)
    {

        $problema = Problema::find($problemaId);

        //verificamos que no pertenezca a un examen
        $leccion = $problema->leccion;
        $grupo = auth()->user()->alumno->grupo;
        $leccionGrupo = LeccionGrupo::where('leccion_id',$leccion->id)->where('grupo_id',$grupo->id)->first();


        if(date($leccionGrupo->fecha_fin) < now()) {
            return "El tiempo para comenzar el examen ha terminado";
        }

        if(date($leccionGrupo->fecha_inicio) > now()) {
            return "El tiempo para comenzar el examen aun no ha iniciado";
        }

        return view('iniciarexamen', compact('problemaId'));
    }

    public function iniciarExamenConfirmacion($problemaId)
    {
        if(auth()->user()->alumno===null) {
            throw new \Exception('Solo alumnos pueden presentar examenes. Porque los alumnos están relacionados a grupos y los grupos a lecciones-examen');
        }

        $problema = Problema::find($problemaId);

        //verificamos que no pertenezca a un examen
        $leccion = $problema->leccion;
        $grupo = auth()->user()->alumno->grupo;
        $leccionGrupo = LeccionGrupo::where('leccion_id',$leccion->id)->where('grupo_id',$grupo->id)->first();


        if(date($leccionGrupo->fecha_fin) < now()) {
            return "El tiempo para comenzar el examen ha terminado";
        }

        if(date($leccionGrupo->fecha_inicio) > now()) {
            return "El tiempo para comenzar el examen aun no ha iniciado";
        }

        $comienzoLeccion = UsuarioComienzoLeccionExamen::where('usuario_id', auth()->user()->id)->where('leccion_grupo_id', $leccionGrupo->id);

         if ($comienzoLeccion->count() === 0) {
             $comienzoLeccion = new UsuarioComienzoLeccionExamen();
             $comienzoLeccion->usuario_id = auth()->user()->id;
             $comienzoLeccion->leccion_grupo_id =  $leccionGrupo->id;
             $comienzoLeccion->inicio = now();
             $comienzoLeccion->save();
         }

        $leccion = Leccion::find($leccion->id);
        $comienzoLeccion = UsuarioComienzoLeccionExamen::where('usuario_id', auth()->user()->id)->where('leccion_grupo_id', $leccionGrupo->id);

        if ($comienzoLeccion->count() === 0) {
            $comienzoLeccion = new UsuarioComienzoLeccionExamen();
            $comienzoLeccion->usuario_id = auth()->user()->id;
            $comienzoLeccion->leccion_grupo_id = $leccionGrupo->id;
            $comienzoLeccion->inicio = now();
            $comienzoLeccion->save();
        }

        return redirect("/resolver/" . $problemaId);
    }

    //tiempo restante del exxamen-lección dado un   problema del examen-klección
    public function tiempoRestanteProblema($problemaId)
    {
        $problema = Problema::find($problemaId);
        //verificamos que no pertenezca a un examen
        $leccion = $problema->leccion;

        $grupo = auth()->user()->alumno->grupo;
        $leccionGrupo = LeccionGrupo::where('leccion_id',$leccion->id)->where('grupo_id',$grupo->id)->first();

        $comienzoLeccion = UsuarioComienzoLeccionExamen::where('usuario_id', auth()->user()->id)->where('leccion_grupo_id', $leccionGrupo->id);
        if ($comienzoLeccion->count() > 0) {
            $comienzoLeccion = $comienzoLeccion->first();
            $seconds =  (new Carbon($comienzoLeccion->inicio))->addHours($leccionGrupo->total_horas)->diffInSeconds(Carbon::now());

            return [
                "hours" => floor($seconds / 3600),
                "minutes" => floor(($seconds % 3600) / 60),
                "seconds" => $seconds % 60
            ];
        }
    }
}
