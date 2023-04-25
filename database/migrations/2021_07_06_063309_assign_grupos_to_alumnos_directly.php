<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssignGruposToAlumnosDirectly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::transaction(function (){
            $alumnos = \App\Alumno::all();

            foreach($alumnos as $alumno){
                if($alumno->grupos()->count()>0) {
                    $alumno->grupo_id = $alumno->grupos->first()->id;
                    $alumno->save();
                }else {
                    $alumno->delete();
                }
            }
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
