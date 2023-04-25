<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemaCCppCaso extends Model
{
    //
    protected $table = 'problemas_ccpp_casos';


    public function problema()
    {
        return $this->belongsTo(Problema::class, "problema_id", "id");
    }

}
