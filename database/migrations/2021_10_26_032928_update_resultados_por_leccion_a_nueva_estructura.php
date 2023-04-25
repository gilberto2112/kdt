<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class UpdateResultadosPorLeccionANuevaEstructura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $query = "
           SELECT
            IFNULL(`resueltos`.`resueltos`, 0) AS `resueltos`,
            CONCAT(`alumnos`.`nombre`, CONCAT(' ', CONCAT(`alumnos`.`apellido_paterno`, CONCAT(' ', `alumnos`.`apellido_materno`)))) AS `alumno_nombre`,
            IFNULL(((`resueltos`.`resueltos` / `total_problemas`.`total_problemas`) * 100), 0) AS `avance`,
            IFNULL(`suma_puntos`.`suma_puntos`, 0) AS `suma_puntos`,
            `grupos`.`nombre` AS `grupo_nombre`,
            CONCAT(`maestros`.`nombre`, CONCAT(' ', `maestros`.`apellido_paterno`)) AS `maestro_nombre`,
            `alumnos`.`id` AS `alumno_id`,
            `users`.`email` AS `alumno_email`,
            `total_problemas`.`leccion_id` AS `leccion_id`
            FROM ((((((((SELECT
                COUNT(`problemas`.`id`) AS `total_problemas`,
                `lecciones`.`id` AS `leccion_id`
            FROM ((`problemas`
                JOIN `lecciones`
                ON ((problemas.`leccion_id` = `lecciones`.`id`)))
                JOIN `unidades`
                ON ((`lecciones`.`unidad_id` = `unidades`.`id`)))
            GROUP BY `lecciones`.`id`) `total_problemas`
            JOIN `alumnos`)
            LEFT JOIN (SELECT
                COUNT(`SubQuery`.`id`) AS `resueltos`,
                `users`.`id` AS `user_id`,
                `SubQuery`.`leccion_id` AS `leccion_id`
                FROM (`users`
                JOIN (SELECT
                    `usuarios_problemas`.`usuario_id` AS `usuario_id`,
                    `usuarios_problemas`.`id` AS `id`,
                    lecciones.id AS `leccion_id`
                    FROM ((`usuarios_problemas`
                    JOIN `problemas`
                        ON (((`usuarios_problemas`.`problema_id` = `problemas`.`id`)
                        AND (`problemas`.`puntos` <= `usuarios_problemas`.`puntos`))))
                    JOIN lecciones
                        ON ((lecciones.id = `problemas`.leccion_id)))) `SubQuery`
                    ON ((`users`.`id` = `SubQuery`.`usuario_id`)))
                GROUP BY `users`.`id`,
                        `SubQuery`.`leccion_id`) `resueltos`
                ON (((`alumnos`.`user_id` = `resueltos`.`user_id`)
                AND (`total_problemas`.`leccion_id` = `resueltos`.`leccion_id`))))
            LEFT JOIN (SELECT
                SUM(LEAST(`usuarios_problemas`.`puntos`, `problemas`.`puntos`)) AS `suma_puntos`,
                `usuarios_problemas`.`usuario_id` AS `usuario_id`,
                lecciones.id AS `leccion_id`
                FROM ((`usuarios_problemas`
                JOIN `problemas`
                    ON ((`usuarios_problemas`.`problema_id` = `problemas`.`id`)))
                JOIN lecciones
                    ON ((lecciones.id = problemas.leccion_id)))
                GROUP BY `usuarios_problemas`.`usuario_id`,
                        lecciones.id) `suma_puntos`
                ON (((`suma_puntos`.`usuario_id` = `alumnos`.`user_id`)
                AND (`suma_puntos`.`leccion_id` = `total_problemas`.`leccion_id`)))))
            LEFT JOIN `grupos`
                ON ((`grupos`.id = alumnos.grupo_id)))
            LEFT JOIN `maestros`
                ON ((`grupos`.`maestro_id` = `maestros`.`id`)))
            JOIN `users`
                ON ((`alumnos`.`user_id` = `users`.`id`)))
            ORDER BY ((`resueltos`.`resueltos` / `total_problemas`.`total_problemas`) * 100) DESC, `suma_puntos`.`suma_puntos` DESC
        ";
        Schema::createOrReplaceView('resultados_por_leccion',$query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        $query = "
            SELECT
                IFNULL(`resueltos`.`resueltos`, 0) AS `resueltos`,
                CONCAT(`alumnos`.`nombre`, CONCAT(' ', CONCAT(`alumnos`.`apellido_paterno`, CONCAT(' ', `alumnos`.`apellido_materno`)))) AS `alumno_nombre`,
                IFNULL(((`resueltos`.`resueltos` / `total_problemas`.`total_problemas`) * 100), 0) AS `avance`,
                IFNULL(`suma_puntos`.`suma_puntos`, 0) AS `suma_puntos`,
                `grupos`.`nombre` AS `grupo_nombre`,
                CONCAT(`maestros`.`nombre`, CONCAT(' ', `maestros`.`apellido_paterno`)) AS `maestro_nombre`,
                `alumnos`.`id` AS `alumno_id`,
                `users`.`email` AS `alumno_email`,
                `total_problemas`.`leccion_id` AS `leccion_id`
            FROM ((((((((SELECT
                COUNT(`problemas`.`id`) AS `total_problemas`,
                `lecciones`.`id` AS `leccion_id`
                FROM (((`lecciones_problemas`
                JOIN `problemas`
                    ON ((`lecciones_problemas`.`problema_id` = `problemas`.`id`)))
                JOIN `lecciones`
                    ON ((`lecciones_problemas`.`leccion_id` = `lecciones`.`id`)))
                JOIN `unidades`
                    ON ((`lecciones`.`unidad_id` = `unidades`.`id`)))
                GROUP BY `lecciones`.`id`) `total_problemas`
                JOIN `alumnos`)
                LEFT JOIN (SELECT
                    COUNT(`SubQuery`.`id`) AS `resueltos`,
                    `users`.`id` AS `user_id`,
                    `SubQuery`.`leccion_id` AS `leccion_id`
                FROM (`users`
                    JOIN (SELECT
                        `usuarios_problemas`.`usuario_id` AS `usuario_id`,
                        `usuarios_problemas`.`id` AS `id`,
                        `lecciones_problemas`.`leccion_id` AS `leccion_id`
                    FROM ((`usuarios_problemas`
                        JOIN `problemas`
                        ON (((`usuarios_problemas`.`problema_id` = `problemas`.`id`)
                        AND (`problemas`.`puntos` <= `usuarios_problemas`.`puntos`))))
                        JOIN `lecciones_problemas`
                        ON ((`lecciones_problemas`.`problema_id` = `problemas`.`id`)))) `SubQuery`
                    ON ((`users`.`id` = `SubQuery`.`usuario_id`)))
                GROUP BY `users`.`id`,
                        `SubQuery`.`leccion_id`) `resueltos`
                ON (((`alumnos`.`user_id` = `resueltos`.`user_id`)
                AND (`total_problemas`.`leccion_id` = `resueltos`.`leccion_id`))))
                LEFT JOIN (SELECT
                    SUM(LEAST(`usuarios_problemas`.`puntos`, `problemas`.`puntos`)) AS `suma_puntos`,
                    `usuarios_problemas`.`usuario_id` AS `usuario_id`,
                    `lecciones_problemas`.`leccion_id` AS `leccion_id`
                FROM ((`usuarios_problemas`
                    JOIN `problemas`
                    ON ((`usuarios_problemas`.`problema_id` = `problemas`.`id`)))
                    JOIN `lecciones_problemas`
                    ON ((`lecciones_problemas`.`problema_id` = `problemas`.`id`)))
                GROUP BY `usuarios_problemas`.`usuario_id`,
                        `lecciones_problemas`.`leccion_id`) `suma_puntos`
                ON (((`suma_puntos`.`usuario_id` = `alumnos`.`user_id`)
                AND (`suma_puntos`.`leccion_id` = `total_problemas`.`leccion_id`))))
                LEFT JOIN `grupos_alumnos`
                ON ((`grupos_alumnos`.`alumno_id` = `alumnos`.`id`)))
                LEFT JOIN `grupos`
                ON ((`grupos_alumnos`.`grupo_id` = `grupos`.`id`)))
                LEFT JOIN `maestros`
                ON ((`grupos`.`maestro_id` = `maestros`.`id`)))
                JOIN `users`
                ON ((`alumnos`.`user_id` = `users`.`id`)))
            ORDER BY ((`resueltos`.`resueltos` / `total_problemas`.`total_problemas`) * 100) DESC, `suma_puntos`.`suma_puntos` DESC";
        Schema::createOrReplaceView('resultados_por_leccion',$query);
    }
}
