<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropGruposAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('grupos_alumnos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('grupos_alumnos', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('grupo_id');
            $table->unsignedBigInteger('alumno_id');

            $table->foreign("grupo_id")->references("id")->on('grupos');
            $table->foreign("alumno_id")->references("id")->on('alumnos');

            $table->timestamps();
        });
    }
}
