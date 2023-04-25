<?php

namespace App\Mail;

use App\Maestro;
use App\Problema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteProgresoSemanalPorGrupo extends Mailable
{
    use Queueable, SerializesModels;

    private $grupos;
    private $maestro;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($grupos,$maestro)
    {
        //
        $this->grupos = $grupos;
        $this->maestro = $maestro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Reporte Semanal ITNL")->view('emails.reporte_semanal_progreso_grupos_profesor',['grupos'=>$this->grupos]);
    }
}
