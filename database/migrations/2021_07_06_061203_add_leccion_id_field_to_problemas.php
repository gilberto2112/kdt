<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeccionIdFieldToProblemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problemas', function (Blueprint $table) {
            $table->bigInteger('leccion_id')->unsigned()->nullable();
            $table->foreign('leccion_id')->references('id')->on('lecciones');
            $table->integer('posicion')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('problemas', function (Blueprint $table) {
            $table->dropForeign(['leccion_id']);
            $table->dropColumn('leccion_id');
            $table->dropColumn('posicion');
        });
    }
}
