<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemaKarelJsCaso extends Model
{
    //
    protected $table = "problemas_kareljs_casos";

    public function problema() {
        return $this->belongsTo(Problema::class,"problema_id","id");
    }
}
