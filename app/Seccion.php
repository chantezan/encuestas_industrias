<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Seccion extends Model
{
    protected $table = "secciones";
    //return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    public function profesores(){
        return $this->belongsToMany(User::class,'relacion_users_secciones',
            'id_seccion','id_user')->where('id_rol',1);
    }

    public function auxiliares(){
        return $this->belongsToMany(User::class,'relacion_users_secciones',
            'id_seccion','id_user')->where('id_rol',2);
    }

    public function coordinadores(){
        return $this->belongsToMany(User::class,'relacion_users_secciones',
            'id_seccion','id_user')->where('id_rol',3);
    }

    public function curso(){
        return $this->belongsTo(Curso::class,'id_curso');
    }

    public function respuestas(){
        return $this->hasMany("App\Respuesta",'id_seccion')->select('*', DB::raw('count(*) as total'))
            ->groupBy('id_user','id_pregunta','respuesta');
    }

}
