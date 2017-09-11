<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = "cursos";
    //return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id'); example many to many
    public function secciones(){
        return $this->hasMany('App\Seccion','id_curso');
    }

    public function tipo(){
        return $this->belongsTo('App\Tipo','id_tipo');
    }
}
