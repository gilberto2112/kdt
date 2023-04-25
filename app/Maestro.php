<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{

    protected  $table = "maestros";

    public function usuario() {
        return $this->belongsTo(Usuario::class,"user_id","id");
    }

    public function grupos() {
        return $this->hasMany(Grupo::class,"maestro_id","id");
    }
}
