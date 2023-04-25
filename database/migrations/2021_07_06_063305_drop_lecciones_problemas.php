<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropLeccionesProblemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('lecciones_problemas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('lecciones_problemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leccion_id');
            $table->unsignedBigInteger('problema_id');

            $table->foreign("leccion_id")->references("id")->on('lecciones');
            $table->foreign("problema_id")->references("id")->on('problemas');
            $table->timestamps();
        });
    }
}
