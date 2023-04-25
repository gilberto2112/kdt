<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyGruposAddExamenFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lecciones_grupos', function (Blueprint $table) {
            $table->boolean('es_examen')->nullable()->default(false);
            $table->integer('total_horas')->unsigned()->nullable();
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lecciones_grupos', function (Blueprint $table) {
            $table->dropColumn('es_examen');
            $table->dropColumn('total_horas');
            $table->dropColumn('fecha_inicio');
            $table->dropColumn('fecha_fin');
        });
    }
}
