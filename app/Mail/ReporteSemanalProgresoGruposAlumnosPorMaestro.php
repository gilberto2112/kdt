<?php

namespace App\Mail;

use App\Maestro;
use App\Problema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteSemanalProgresoGruposAlumnosPorMaestro extends Mailable
{
    use Queueable, SerializesModels;

    private $maestro;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Maestro $maestro)
    {
        //
        $this->maestro = $maestro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $totalProblemas = Problema::has("lecciones")->count();
        return $this->subject("Reporte Semanal ITNL")->view('emails.reporte_semanal_progreso_alumnos_por_maestro',['maestro'=>$this->maestro,'totalProblemas'=>$totalProblemas]);
    }
}
