<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitucionUsuario extends Model
{
    use HasFactory;

    protected $table = 'instituciones_usuarios';
}
