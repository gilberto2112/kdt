<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaLeccionesExamenGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecciones_grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leccion_id');
            $table->unsignedBigInteger('grupo_id');

            $table->foreign("leccion_id")->references("id")->on('lecciones');
            $table->foreign("grupo_id")->references("id")->on('grupos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('lecciones_grupos');
    }
}
