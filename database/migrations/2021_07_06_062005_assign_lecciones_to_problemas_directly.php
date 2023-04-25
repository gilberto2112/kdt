<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssignLeccionesToProblemasDirectly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::transaction(function (){
            $problemas = \App\Problema::all();

            foreach($problemas as $problema){
                if($problema->leccionesProblema()->count()>0) {
                    $problema->leccion_id = $problema->leccionesProblema->first()->leccion_id;
                    $problema->posicion = $problema->leccionesProblema->first()->posicion;
                    $problema->save();
                }else {

                    foreach($problema->problemaKarelJsCasos as $caso){
                       $caso->delete();
                    }
                    foreach($problema->problemaCCppCasos as $caso){
                        $caso->delete();
                    }
                    $problema->delete();
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
