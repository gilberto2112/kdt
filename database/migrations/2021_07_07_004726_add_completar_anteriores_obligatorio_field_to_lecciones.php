<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompletarAnterioresObligatorioFieldToLecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lecciones', function (Blueprint $table) {
            //
            $table->boolean('completar_anteriores_obligatorio')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lecciones', function (Blueprint $table) {
            $table->dropColumn('completar_anteriores_obligatorio');
        });
    }
}
