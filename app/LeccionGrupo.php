<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LeccionGrupo extends Pivot
{
    //
    protected $table = 'lecciones_grupos';
    public $incrementing = true;
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];


    public function grupo()
    {
        return $this->belongsTo(Grupo::class, "grupo_id", "id");
    }
}
