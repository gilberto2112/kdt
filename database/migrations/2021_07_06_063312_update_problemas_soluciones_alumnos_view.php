<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class UpdateProblemasSolucionesAlumnosView extends Migration
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
              IF(((`alumnos`.`nombre` = '') AND (`alumnos`.`apellido_paterno` = '') AND (`alumnos`.`apellido_materno` = '')), CONVERT(CONCAT(CONCAT(CONCAT(`alumnos`.`nombre`, ' '), CONCAT(`alumnos`.`apellido_paterno`, ' ')), `alumnos`.`apellido_materno`) USING utf8mb4), `users`.`name`) AS `alumno_nombre_completo`,
              `grupos`.`nombre` AS `grupo_nombre`,
              `maestros`.`nombre` AS `grupo_maestro`,
              `grupos`.`id` AS `grupo_id`,
              `maestros`.`id` AS `maestro_id`,
              `alumnos`.`id` AS `alumno_id`,
              `usuarios_problemas`.`puntos` AS `puntos`,
              `usuarios_problemas`.`ultimo_codigo` AS `ultimo_codigo`,
              `usuarios_problemas`.`problema_id` AS `problema_id`,
              `usuarios_problemas`.`id` AS `id`
            FROM `usuarios_problemas`
              JOIN `problemas`
                ON `usuarios_problemas`.`problema_id` = `problemas`.`id`
              JOIN `users`
                ON `usuarios_problemas`.`usuario_id` = `users`.`id`
              JOIN `alumnos`
                ON `alumnos`.`user_id` = `users`.`id`
              JOIN `grupos`
                ON `alumnos`.`grupo_id` = `grupos`.`id`
              JOIN `maestros`
                ON `grupos`.`maestro_id` = `maestros`.`id`
            ORDER BY `grupos`.`nombre`, IF(((`alumnos`.`nombre` = '') AND (`alumnos`.`apellido_paterno` = '') AND (`alumnos`.`apellido_materno` = '')), CONVERT(CONCAT(CONCAT(CONCAT(`alumnos`.`nombre`, ' '), CONCAT(`alumnos`.`apellido_paterno`, ' ')), `alumnos`.`apellido_materno`) USING utf8mb4), `users`.`name`), `maestros`.`nombre`
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
        $query  = /** @lang MySQL */
            "
               SELECT
                  IF(((`alumnos`.`nombre` = '') AND (`alumnos`.`apellido_paterno` = '') AND (`alumnos`.`apellido_materno` = '')), CONVERT(CONCAT(CONCAT(CONCAT(`alumnos`.`nombre`, ' '), CONCAT(`alumnos`.`apellido_paterno`, ' ')), `alumnos`.`apellido_materno`) USING utf8mb4), `users`.`name`) AS `alumno_nombre_completo`,
                  `grupos`.`nombre` AS `grupo_nombre`,
                  `maestros`.`nombre` AS `grupo_maestro`,
                  `grupos`.`id` AS `grupo_id`,
                  `maestros`.`id` AS `maestro_id`,
                  `alumnos`.`id` AS `alumno_id`,
                  `usuarios_problemas`.`puntos` AS `puntos`,
                  `usuarios_problemas`.`ultimo_codigo` AS `ultimo_codigo`,
                  `usuarios_problemas`.`problema_id` AS `problema_id`,
                  `usuarios_problemas`.`id` AS `id`
                FROM ((((((`usuarios_problemas`
                  JOIN `problemas`
                    ON ((`usuarios_problemas`.`problema_id` = `problemas`.`id`)))
                  JOIN `users`
                    ON ((`usuarios_problemas`.`usuario_id` = `users`.`id`)))
                  JOIN `alumnos`
                    ON ((`alumnos`.`user_id` = `users`.`id`)))
                  JOIN `grupos_alumnos`
                    ON ((`grupos_alumnos`.`alumno_id` = `alumnos`.`id`)))
                  JOIN `grupos`
                    ON ((`grupos_alumnos`.`grupo_id` = `grupos`.`id`)))
                  JOIN `maestros`
                    ON ((`grupos`.`maestro_id` = `maestros`.`id`)))
                ORDER BY `grupos`.`nombre`, IF(((`alumnos`.`nombre` = '') AND (`alumnos`.`apellido_paterno` = '') AND (`alumnos`.`apellido_materno` = '')), CONVERT(CONCAT(CONCAT(CONCAT(`alumnos`.`nombre`, ' '), CONCAT(`alumnos`.`apellido_paterno`, ' ')), `alumnos`.`apellido_materno`) USING utf8mb4), `users`.`name`), `maestros`.`nombre`
        ";
        Schema::createOrReplaceView('problemas_soluciones_alumnos',$query);
    }
}
