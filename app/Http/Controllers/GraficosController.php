<?php

namespace App\Http\Controllers;

use App\Seccion;
use App\User;
use Illuminate\Http\Request;
use App\Curso;
use Auth;
use App\Http\Requests;

class GraficosController extends Controller
{
    public function index(Request $request){

        $cursos = Curso::with(['tipo.preguntas','secciones.profesores','secciones.auxiliares','secciones.coordinadores'])->get();

        return view('welcome',['cursos' => $cursos]);
    }

    public function getSeccion(Request $request){
        $seccion = Seccion::with(['auxiliares','profesores','coordinadores','respuestas','curso'])->find($request['seccion']);
        $auxiliares = collect();
        if($seccion->curso->id_tipo == 3) {
            foreach ($seccion->curso->secciones as $seccion2) {
                foreach ($seccion2->auxiliares as $aux) {
                    $auxiliares->push($aux);
                }
                foreach ($seccion2->coordinadores as $aux) {
                    $auxiliares->push($aux);
                }
            }
        } else if($seccion->curso->id_tipo == 4) {
            $auxiliares = $seccion->auxiliares;
            foreach ($seccion->curso->secciones as $seccion2) {
                foreach ($seccion2->coordinadores as $aux) {
                    $auxiliares->push($aux);
                }
            }
        } else {
            $auxiliares = $seccion->auxiliares;
        }
            $auxiliares = $auxiliares->unique('id');
            $seccion->auxiliares_all = $auxiliares->toArray();
        return $seccion;
    }

    public function logeado(){
        if (!Auth::check())
        {
            return redirect()->back()->withInput()->with('message', 'No esta logeado');
        }
        $usuarios = User::with('secciones.curso')->find(Auth::user()->id);


        $cursos = collect();
        foreach ($usuarios->secciones as $seccion) {
                $cursos->push(Curso::with(['tipo.preguntas', 'secciones.profesores', 'secciones.auxiliares', 'secciones.coordinadores'])
                    ->find($seccion->id_curso));
        }
        foreach ($usuarios->usuarios as $usuario) {
            foreach ($usuario->secciones as $seccion) {
                $cursos->push(Curso::with(['tipo.preguntas', 'secciones.profesores', 'secciones.auxiliares', 'secciones.coordinadores'])
                    ->find($seccion->id_curso));
            }
        }
        $cursos = $cursos->unique('id');
        foreach($cursos as $curso){
            foreach ($curso->secciones as $seccion2){
                $auxiliares = collect();
                if($curso->id_tipo == 3) {
                    foreach ($seccion2->curso->secciones as $seccion) {
                        foreach ($seccion->auxiliares as $aux) {
                            $auxiliares->push($aux);
                        }
                        foreach ($seccion->coordinadores as $aux) {
                            $auxiliares->push($aux);
                        }
                    }
                } else if($curso->id_tipo == 4) {
                    foreach ($seccion2->auxiliares as $aux) {
                        $auxiliares->push($aux);
                    }
                    foreach ($seccion2->curso->secciones as $seccion) {
                        foreach ($seccion->coordinadores as $aux) {
                            $auxiliares->push($aux);
                        }
                    }
                } else {
                    $auxiliares = $seccion2->auxiliares;
                }
                $seccion2->auxiliares_all = $auxiliares->toArray();
            }
            foreach($cursos as $curso){
                if($curso->id_tipo != 3 && $curso->id_tipo != 4) {
                    foreach ($curso->secciones as $key => $seccion2) {
                        $esta = false;
                        foreach ($usuarios->usuarios as $usuario) {
                            if ($usuario->secciones->find($seccion2->id)) ;
                            $esta = true;
                        }
                        if ($usuarios->secciones->find($seccion2->id))
                            $esta = true;
                        if (!$esta) {
                            $curso->secciones->forget($key);
                        }
                    }
                }
            }
        }

        return view('logeado',['cursos' => $cursos]);
    }
}
