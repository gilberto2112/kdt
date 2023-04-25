<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class ActualizarTop100 extends Migration
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
                IFNULL(resueltos.resueltos, 0) AS resueltos,
                CONCAT(IFNULL(alumnos.nombre, ''), CONCAT(' ', CONCAT(IFNULL(alumnos.apellido_paterno, ''), CONCAT(' ', IFNULL(alumnos.apellido_materno, ''))))) AS alumno_nombre,
                IFNULL(resueltos.resueltos / total_problemas.total_problemas * 100, 0) AS avance,
                IFNULL(suma_puntos.suma_puntos, 0) AS suma_puntos,
                grupos.nombre AS grupo_nombre,
                CONCAT(IFNULL(maestros.nombre, ''), CONCAT(' ', IFNULL(maestros.apellido_paterno, ''))) AS maestro_nombre,
                alumnos.id AS alumno_id,
                users.email AS alumno_email,
                instituciones.id AS institucion_id,
                instituciones.nombre AS institucion_nombre
            FROM (SELECT
                COUNT(problemas.id) AS total_problemas
                FROM problemas
                INNER JOIN lecciones
                    ON problemas.leccion_id = lecciones.id
                INNER JOIN unidades
                    ON lecciones.unidad_id = unidades.id) total_problemas
                INNER JOIN alumnos
                LEFT OUTER JOIN (SELECT
                    COUNT(SubQuery.id) AS resueltos,
                    users.id AS user_id
                FROM users
                    INNER JOIN (SELECT
                        usuarios_problemas.usuario_id AS usuario_id,
                        usuarios_problemas.id AS id
                    FROM usuarios_problemas
                        INNER JOIN problemas
                        ON usuarios_problemas.problema_id = problemas.id
                        AND problemas.puntos <= usuarios_problemas.puntos) SubQuery
                    ON users.id = SubQuery.usuario_id
                GROUP BY users.id) resueltos
                ON alumnos.user_id = resueltos.user_id
                LEFT OUTER JOIN (SELECT
                    SUM(LEAST(usuarios_problemas.puntos, problemas.puntos)) AS suma_puntos,
                    usuarios_problemas.usuario_id AS usuario_id
                FROM usuarios_problemas
                    INNER JOIN problemas
                    ON usuarios_problemas.problema_id = problemas.id
                GROUP BY usuarios_problemas.usuario_id) suma_puntos
                ON suma_puntos.usuario_id = alumnos.user_id
                LEFT OUTER JOIN grupos
                ON grupos.id = alumnos.grupo_id
                LEFT OUTER JOIN maestros
                ON grupos.maestro_id = maestros.id
                INNER JOIN users
                ON alumnos.user_id = users.id
                LEFT OUTER JOIN instituciones_usuarios
                ON instituciones_usuarios.usuario_id = users.id
                LEFT OUTER JOIN instituciones
                ON instituciones_usuarios.institucion_id = instituciones.id
            ORDER BY resueltos.resueltos / total_problemas.total_problemas * 100 DESC, suma_puntos.suma_puntos DESC
        ";
        Schema::createOrReplaceView('top100',$query);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $query = "
            SELECT
                IFNULL(`resueltos`.`resueltos`, 0) AS `resueltos`,
                CONCAT(IFNULL(`alumnos`.`nombre`, ''), CONCAT(' ', CONCAT(IFNULL(`alumnos`.`apellido_paterno`, ''), CONCAT(' ', IFNULL(`alumnos`.`apellido_materno`, ''))))) AS `alumno_nombre`,
                IFNULL(((`resueltos`.`resueltos` / `total_problemas`.`total_problemas`) * 100), 0) AS `avance`,
                (IFNULL(`suma_puntos`.`suma_puntos`, 0) * 2.276) AS `suma_puntos`,
                `grupos`.`nombre` AS `grupo_nombre`,
                CONCAT(IFNULL(`maestros`.`nombre`, ''), CONCAT(' ', IFNULL(`maestros`.`apellido_paterno`, ''))) AS `maestro_nombre`,
                `alumnos`.`id` AS `alumno_id`,
                `users`.`email` AS `alumno_email`,
                `instituciones`.`id` AS `institucion_id`,
                `instituciones`.`nombre` AS `institucion_nombre`
            FROM (((((((((SELECT
                COUNT(`problemas`.`id`) AS `total_problemas`
                FROM ((`problemas`
                JOIN `lecciones`
                    ON ((`problemas`.`leccion_id` = `lecciones`.`id`)))
                JOIN `unidades`
                    ON ((`lecciones`.`unidad_id` = `unidades`.`id`)))) `total_problemas`
                JOIN `alumnos`)
                LEFT JOIN (SELECT
                    COUNT(`SubQuery`.`id`) AS `resueltos`,
                    `users`.`id` AS `user_id`
                FROM (`users`
                    JOIN (SELECT
                        `usuarios_problemas`.`usuario_id` AS `usuario_id`,
                        `usuarios_problemas`.`id` AS `id`
                    FROM (`usuarios_problemas`
                        JOIN `problemas`
                        ON (((`usuarios_problemas`.`problema_id` = `problemas`.`id`)
                        AND (`problemas`.`puntos` <= `usuarios_problemas`.`puntos`))))) `SubQuery`
                    ON ((`users`.`id` = `SubQuery`.`usuario_id`)))
                GROUP BY `users`.`id`) `resueltos`
                ON ((`alumnos`.`user_id` = `resueltos`.`user_id`)))
                LEFT JOIN (SELECT
                    SUM(LEAST(`usuarios_problemas`.`puntos`, `problemas`.`puntos`)) AS `suma_puntos`,
                    `usuarios_problemas`.`usuario_id` AS `usuario_id`
                FROM (`usuarios_problemas`
                    JOIN `problemas`
                    ON ((`usuarios_problemas`.`problema_id` = `problemas`.`id`)))
                GROUP BY `usuarios_problemas`.`usuario_id`) `suma_puntos`
                ON ((`suma_puntos`.`usuario_id` = `alumnos`.`user_id`)))
                LEFT JOIN `grupos`
                ON ((`grupos`.`id` = `alumnos`.`grupo_id`)))
                LEFT JOIN `maestros`
                ON ((`grupos`.`maestro_id` = `maestros`.`id`)))
                JOIN `users`
                ON ((`alumnos`.`user_id` = `users`.`id`)))
                LEFT JOIN `instituciones_usuarios`
                ON ((`instituciones_usuarios`.`usuario_id` = `users`.`id`)))
                LEFT JOIN `instituciones`
                ON ((`instituciones_usuarios`.`institucion_id` = `instituciones`.`id`)))
            ORDER BY ((`resueltos`.`resueltos` / `total_problemas`.`total_problemas`) * 100) DESC, `suma_puntos`.`suma_puntos` DESC
        ";
        Schema::createOrReplaceView('top100',$query);
    }
}
