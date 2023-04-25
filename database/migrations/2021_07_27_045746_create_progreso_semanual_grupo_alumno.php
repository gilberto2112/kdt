<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresoSemanualGrupoAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progreso_semanual_grupo_alumno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_id');
            $table->unsignedBigInteger('alumno_id');
            $table->date('fecha');
            $table->integer('puntos');
            $table->decimal('porcentaje',10,2);
            $table->integer('examen_semanal_puntos');
            $table->decimal('examen_semanal_porcentaje',10,2);
            $table->timestamps();

            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progreso_semanual_grupo_alumno');
    }
}
