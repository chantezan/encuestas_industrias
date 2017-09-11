<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    public function preguntas(){
        return $this->hasMany('App\Pregunta','id_tipo');
    }
}
