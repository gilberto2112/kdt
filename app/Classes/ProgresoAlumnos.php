<?php

namespace App\Classes;

use App\Alumno;
use App\Grupo;
use App\Maestro;
use App\Problema;
use App\ProgresoSemanualGrupoAlumno;
use App\Usuario;
use Exception;
use Illuminate\Support\Collection;

class ProgresoAlumnos {

    public function guardarProgresoPorGrupo(Collection $grupos,$fecha) {


        $totalProblemasPrograma = Problema::whereDoesntHave('leccion.leccionGrupos',function($q){
            $q->where('es_examen',1);
        })->count();


        foreach($grupos as $grupo) {
            foreach($grupo->alumnos as $alumno){
                /** @var Usuario $usuario */
                $usuario = $alumno->usuario;


                $progresoSemanualGrupoAlumno = ProgresoSemanualGrupoAlumno::where('grupo_id',$grupo->id)
                    ->where('alumno_id',$alumno->id)
                    ->where('fecha',$fecha);

                if($progresoSemanualGrupoAlumno->count()===0){
                    $progresoSemanualGrupoAlumno1 = new ProgresoSemanualGrupoAlumno();
                    $progresoSemanualGrupoAlumno1->alumno_id = $alumno->id;
                    $progresoSemanualGrupoAlumno1->grupo_id = $grupo->id;
                    $progresoSemanualGrupoAlumno1->fecha = $fecha;
                    $progresoSemanualGrupoAlumno1->puntos = 0;
                    $progresoSemanualGrupoAlumno1->porcentaje = 0;
                    $progresoSemanualGrupoAlumno1->examen_semanal_puntos = 0;
                    $progresoSemanualGrupoAlumno1->examen_semanal_porcentaje = 0;
                    $progresoSemanualGrupoAlumno1->save();
                }

                $progresoSemanualGrupoAlumno = $progresoSemanualGrupoAlumno->first();

                $progresoSemanualGrupoAlumno->puntos = $usuario->totalPuntosPrograma();
                $progresoSemanualGrupoAlumno->porcentaje = $usuario->problemasResueltosDePrograma()/$totalProblemasPrograma*100;
                $progresoSemanualGrupoAlumno->save();
            }
        }
    }

    /**
     * @throws Exception
     */
    public function obtenerGruposQueCumplenSemanaAlDiaDeHoy() {
        $todayDate = new \DateTime(date('Y-m-d'));

        $grupos = Grupo::whereNotNull('fecha_inicial')->get()->filter(function(Grupo $grupo) use ($todayDate){
            $grupoDate = new \DateTime($grupo->fecha_inicial);
            $intervalo = $todayDate->diff($grupoDate);
            return $intervalo->days % 7 ===0;
        });

        return $grupos;
    }

    /**
     * @throws Exception
     */
    public function llenarTablaSemanalProgreso() {
        $grupos  = $this->obtenerGruposQueCumplenSemanaAlDiaDeHoy();
        $this->guardarProgresoPorGrupo($grupos,date('Y-m-d'));
    }
}
