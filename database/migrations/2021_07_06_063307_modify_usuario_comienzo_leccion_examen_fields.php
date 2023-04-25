<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsuarioComienzoLeccionExamenFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_comienzo_leccion_examen', function (Blueprint $table) {
            $table->dropForeign(['leccion_examen_id']);
            $table->dropColumn('leccion_examen_id');
            $table->unsignedBigInteger('leccion_grupo_id')->nullable();
            $table->foreign("leccion_grupo_id")->references("id")->on('lecciones_grupos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_comienzo_leccion_examen', function (Blueprint $table) {
            $table->dropForeign(['leccion_grupo_id']);
            $table->dropColumn('leccion_grupo_id');
            $table->unsignedInteger('leccion_examen_id')->nullable();
            $table->foreign("leccion_examen_id")->references("id")->on('lecciones_examen');
        });
    }
}
