<?php

namespace App\Http\Controllers;

use App\Classes\EvaluadorKarel;
use App\LeccionGrupo;
use App\Problema;
use App\ProblemaKarelJsCaso;
use App\UsuarioComienzoLeccionExamen;
use App\UsuarioProblema;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResolvedorController extends Controller
{
    //

    public function index($problemaId)
    {
        $problema = Problema::find($problemaId);

        $caso = ProblemaKarelJsCaso::where("problema_id", $problemaId)->orderBy("posicion", "asc")->first();
        $usuarioProblema = UsuarioProblema::where("problema_id", $problemaId)->where("usuario_id", auth()->user()->id);
        $ultimoCodigo = $problema->solucion_inicial;

        if ($usuarioProblema->count() > 0) {
            $ultimoCodigo = $usuarioProblema->first()->ultimo_codigo;
        }

        $mundoInicialXml = null;

        if ($caso) {
            $mundoInicialXml = $caso->mundo_inicial_xml;
        }

        if ($mundoInicialXml === null) {
            return view("error", ["message" => 'Problema en reparación']);
        }


        if(auth()->user()->alumno===null) {
            // throw new \Exception('Solo alumnos pueden presentar examenes. Porque los alumnos están relacionados a grupos y los grupos a lecciones-examen');
            return view("resolvedor", ["mundoInicial" => $mundoInicialXml, 'problemaId' => $problemaId, 'ultimoCodigo' => $ultimoCodigo, 'problema' => $problema]);
        }

        //verificamos que no pertenezca a un examen
        $leccion = $problema->leccion;
        $grupo = auth()->user()->alumno->grupo;
        $leccionGrupo = LeccionGrupo::where('leccion_id',$leccion->id)->where('grupo_id',$grupo->id)->first();

        if ($leccionGrupo && $leccionGrupo->es_examen) {
            $comienzoLeccion = UsuarioComienzoLeccionExamen::where('usuario_id', auth()->user()->id)->where('leccion_grupo_id', $leccionGrupo->id);

            if ($comienzoLeccion->count() === 0) {
                return redirect("/examenes/iniciar-examen/{$problemaId}");
            }

            //entonces significa que ya está presentando el examen, vamos a checar si no se le ha acabado el tiempo
            $comienzoLeccion = $comienzoLeccion->first();

            $maxEndTime = (new Carbon($comienzoLeccion->inicio))->addHours($leccion->examen->total_horas);
            if($maxEndTime->lessThan(Carbon::now())){
                return "Se ha terminado su tiempo de examen";
            }
        }



        return view("resolvedor", ["mundoInicial" => $mundoInicialXml, 'problemaId' => $problemaId, 'ultimoCodigo' => $ultimoCodigo, 'problema' => $problema]);
    }



    public function evaluar(Request $r)
    {
        $problemaId = $r->get("problema_id");
        $codigo = $r->get("solucion");


        $problema = Problema::find($problemaId);

        $casos = ProblemaKarelJsCaso::where("problema_id", $problemaId)->orderBy("posicion", "asc")->get();

        $evaluadorKarel = new EvaluadorKarel();

        $pasa = 0;

        foreach ($casos as $caso) {
            if ($evaluadorKarel->evaluar($codigo, $caso->mundo_inicial_xml, $caso->mundo_final_xml)) {
                $pasa++;
            }
        }

        $usuarioProblema =  UsuarioProblema::where("usuario_id", auth()->user()->id)->where("problema_id", $problemaId);

        if ($usuarioProblema->count() === 0) {
            $usuarioProblema = new UsuarioProblema();
            $usuarioProblema->usuario_id = auth()->user()->id;
            $usuarioProblema->problema_id = $problemaId;
            $usuarioProblema->puntos = 0;
            $usuarioProblema->ultimo_codigo = "";
            $usuarioProblema->save();
        }

        $usuarioProblema = UsuarioProblema::where("usuario_id", auth()->user()->id)->where("problema_id", $problemaId)->first();


        $usuarioProblema->puntos =  $casos->count() === $pasa ? $problema->puntos : ($pasa/$casos->count()) * $problema->puntos;
        $usuarioProblema->ultimo_codigo = $codigo;
        $usuarioProblema->save();


        return [
            "total_casos" => $casos->count(),
            "total_casos_resueltos" => $pasa,
            "puntos"=>$usuarioProblema->puntos
        ];
    }
}
