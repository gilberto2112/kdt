<?php

namespace App\Imports;

use App\Alumno;
use App\Grupo;
use App\GrupoAlumno;
use App\Usuario;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Row;

class AlumnosManualImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        //creamos el usuario

        $grupoId = 29;

        //buscamos si existe el usuario

        $user = Usuario::where("email",$row[4]);
        if(Usuario::where("email", $row[4])->count()==0){
            $userN = new Usuario();
            $userN->name = $row[3];
            $userN->email = $row[4];
            $userN->password = Hash::make("karel2020");
            $userN->save();
        }

        $user = Usuario::where("email", $row[4])->first();

        if(Alumno::where("user_id", $user->id)->count()==0){
            //creamos el alumno
            $alumnoN  = new Alumno();
            $alumnoN->nombre = $row[3];
            $alumnoN->apellido_paterno = $row[1];
            $alumnoN->apellido_materno = $row[2];
            $alumnoN->numero_control = $row[0];
            $alumnoN->user_id = $user->id;
            $alumnoN->save();
        }

        $alumno = Alumno::where("user_id", $user->id)->first();



        if(GrupoAlumno::where("grupo_id", $grupoId)->where("alumno_id",$alumno->id)->count()==0){
            $grupoAlumnoN = new GrupoAlumno();
            $grupoAlumnoN->grupo_id = $grupoId;
            $grupoAlumnoN->alumno_id = $alumno->id;
            $grupoAlumnoN->save();
        }

    }
}
