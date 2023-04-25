<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class UsuarioProblema extends Model
{

    protected  $table = "usuarios_problemas";

    public function usuario() {
        return $this->belongsTo(Usuario::class,"usuario_id","id");
    }

    public function problema() {
        return $this->belongsTo(Problema::class,"problema_id","id");
    }

    public function scopeCurrentUser($query){
        return $query->where('usuario_id',auth()->user()->id);
    }

}
