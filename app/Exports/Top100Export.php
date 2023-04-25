<?php

namespace App\Exports;

use App\Top100;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class Top100Export implements FromCollection
{
    private $top100;
    public function __construct($top100) {
        $this->top100 = $top100;
    }

    public function collection()
    {
        $rows = [];
        $rows[] = ['Alumno','Email','Puntos','%','Grupo','Maestro'];

        foreach($this->top100 as $row){
            $rows[] = [
                $row->alumno_nombre,
                $row->alumno_email,
                $row->suma_puntos,
                $row->avance,
                $row->grupo_nombre,
                $row->maestro_nombre,
            ];

        }

        return collect($rows);
    }
}
