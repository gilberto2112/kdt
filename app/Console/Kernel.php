<?php

namespace App\Console;

use App\Classes\ProgresoAlumnos;
use App\Maestro;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function(){
            $maestros = \App\Maestro::all();
            foreach($maestros as $maestro){
                Log::info("Enviando correo a {$maestro->usuario->email}");
                Mail::to($maestro->usuario->email)->send(new \App\Mail\ReporteSemanalProgresoGruposAlumnosPorMaestro($maestro));
            }
        })->weekly();

        $schedule->call(function(){
            $progreso = new ProgresoAlumnos();
            $progreso->llenarTablaSemanalProgreso();

            $grupos = $progreso->obtenerGruposQueCumplenSemanaAlDiaDeHoy();

            foreach($grupos->groupBy('maestro_id') as $maestroId=>$grupos) {
                $maestro = Maestro::find($maestroId);
                Mail::to($maestro->usuario->email)->send(new \App\Mail\ReporteProgresoSemanalPorGrupo($grupos,$maestro));
            }

        })->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
