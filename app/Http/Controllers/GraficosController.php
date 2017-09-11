<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Curso;
use Auth;
use App\Http\Requests;

class GraficosController extends Controller
{
    public function index(Request $request){

        $cursos = Curso::with(['tipo.preguntas','secciones.respuestas.pregunta','secciones.profesores','secciones.auxiliares','secciones.coordinadores'])->get();
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
                    foreach ($seccion2->curso->secciones as $seccion) {
                        foreach ($seccion2->auxiliares as $aux) {
                            $auxiliares->push($aux);
                        }
                        foreach ($seccion->coordinadores as $aux) {
                            $auxiliares->push($aux);
                        }
                    }
                } else {
                    $auxiliares = $seccion2->auxiliares;
                }
                $auxiliares = $auxiliares->unique('id');
                $seccion2->auxiliares_all = $auxiliares->toArray();
            }
        }
        //dd($cursos->toArray());
        return view('welcome',['cursos' => $cursos]);
    }

    public function logeado(){
        if (!Auth::check())
        {
            return redirect()->back()->withInput()->with('message', 'No esta logeado');
        }
        $usuario = User::with('secciones.curso')->find(Auth::user()->id);

        $cursos = collect();
        foreach ($usuario->secciones as $seccion)
            $cursos->push(Curso::with(['tipo.preguntas','secciones.respuestas.pregunta','secciones.profesores','secciones.auxiliares','secciones.coordinadores'])
                ->find($seccion->id_curso));
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

        }

        return view('logeado',['cursos' => $cursos]);
    }
}
