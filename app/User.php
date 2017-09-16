<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function secciones(){
        return $this->belongsToMany('App\Seccion','relacion_users_secciones',
            'id_user','id_seccion');
    }

    public function usuarios(){
        return $this->hasMany('App\User','id_user');
    }

    public function real(){
        return $this->belongsTo('App\User','id_user');
    }

}
