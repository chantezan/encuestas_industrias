<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    public function pregunta(){
        return $this->belongsTo('App\Pregunta','id_pregunta');
    }

    public function usuario(){
        return $this->belongsTo('App\User','id_user');
    }

    public function seccion(){
        return $this->belongsTo('App\Seccion','id_seccion');
    }
}
