<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;
    protected $table = 'instituciones';

    public function usuarios() {
        return $this->belongsToMany(Usuario::class,'instituciones_usuarios','institucion_id','usuario_id');

    }
}
