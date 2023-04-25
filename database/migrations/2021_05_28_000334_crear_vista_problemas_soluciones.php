<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class CrearVistaProblemasSoluciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $query  = "
            SELECT
                IF(alumnos.nombre = '' AND alumnos.apellido_paterno = '' AND alumnos.apellido_materno = '',
                CONCAT(CONCAT(CONCAT(alumnos.nombre, ' '), CONCAT(alumnos.apellido_paterno, ' ')), alumnos.apellido_materno),
                users.name)
                AS alumno_nombre_completo,
                grupos.nombre AS grupo_nombre,
                maestros.nombre AS grupo_maestro,
                grupos.id AS grupo_id,
                maestros.id AS maestro_id,
                alumnos.id AS alumno_id,
                usuarios_problemas.puntos AS puntos,
                usuarios_problemas.ultimo_codigo,
                usuarios_problemas.problema_id,
                usuarios_problemas.id
            FROM usuarios_problemas
                INNER JOIN problemas
                ON usuarios_problemas.problema_id = problemas.id
                INNER JOIN users
                ON usuarios_problemas.usuario_id = users.id
                INNER JOIN alumnos
                ON alumnos.user_id = users.id
                INNER JOIN grupos_alumnos
                ON grupos_alumnos.alumno_id = alumnos.id
                INNER JOIN grupos
                ON grupos_alumnos.grupo_id = grupos.id
                INNER JOIN maestros
                ON grupos.maestro_id = maestros.id
            ORDER BY grupo_nombre, alumno_nombre_completo , grupo_maestro

        ";
        Schema::createOrReplaceView('problemas_soluciones_alumnos',$query);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropView('problemas_soluciones_alumnos');
    }
}
