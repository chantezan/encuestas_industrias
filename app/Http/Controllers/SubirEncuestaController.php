<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Seccion;
use App\Respuesta;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Excel;
use App\Http\Requests;

class SubirEncuestaController extends Controller
{
    public function index(Request $request){
        $guardado = $request->session()->get("guardado");
        $fallo = $request->session()->get("fallo");
        $cursos = Curso::with('secciones')->get();
        //dd($cursos->toArray());
        return view('subir_excel',['cursos' => $cursos,'fallo'=>$fallo,'guardado'=>$guardado]);
    }

    function normaliza ($cadena){
        //$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
//ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        //      $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
//bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $some_special_chars = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "Ñ"," ",",","¿","?","“","”","'");
        $replacement_chars  = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N","_","","","","","","");

        $cadena    = str_replace($some_special_chars, $replacement_chars, $cadena);

        $cadena = strtolower($cadena);
        //$cadena = utf8_decode($cadena);
        //$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        //$cadena = strtolower($cadena);
        return $cadena;
    }

    public function guardarExcel(Request $request){
        ini_set('max_execution_time', 18000);
        $rows = Excel::load($request->file)->get();

        $seccion = Seccion::with(['profesores','auxiliares','curso.secciones.auxiliares','coordinadores'])->find($request->seccion);

        $profesores = collect();
        foreach ($seccion->profesores as $profesor) {
            if($profesor->real)
                $profesor->name = $profesor->real->name;
            $profesores->push($profesor);
        }
        $auxiliares = collect();
        if($seccion->curso->id_tipo == 3){
            foreach($seccion->curso->secciones as $aux_sec){
                foreach($aux_sec->auxiliares as $aux){
                    $auxiliares->push($aux);
                }
                foreach($aux_sec->coordinadores as $aux2){
                    $auxiliares->push($aux2);
                }
            }
        } else if ($seccion->curso->id_tipo == 4){
            $auxiliares = $seccion->auxiliares;
            foreach($seccion->coordinadores as $aux_sec){
                $auxiliares->push($aux_sec);
            }

        } else {
            $auxiliares = $seccion->auxiliares;
        }
        $auxiliares = $auxiliares->unique("id");
        //dd($auxiliares);
        $preguntas_aux = $seccion->curso->tipo->preguntas;
        $preguntas = collect();
        $respuestas = collect();
        foreach($preguntas_aux as $pregunta_aux){
            if($pregunta_aux->profesor){
                foreach($profesores as $profesor){
                    $pregunta_clonada = clone $pregunta_aux;
                    $pregunta_clonada->nombre = str_replace("REEMPLAZAR", $profesor->name, $pregunta_aux->nombre);
                    $pregunta_clonada->docente = $profesor->id;
                    $preguntas->push($pregunta_clonada);
                }
            } else if($pregunta_aux->auxiliar){
                foreach($auxiliares as $auxiliar){
                    $pregunta_clonada = clone $pregunta_aux;
                    $pregunta_clonada->nombre = str_replace("REEMPLAZAR", $auxiliar->name, $pregunta_aux->nombre);
                    $pregunta_clonada->docente = $auxiliar->id;
                    $preguntas->push($pregunta_clonada);
                }
            } else {
                $preguntas->push($pregunta_aux);
            }
        }


        foreach($rows as $row){
            foreach($preguntas as $pregunta){
                //dd($row);
                $nombre_aux = $this->normaliza($pregunta->nombre);
                $respuesta = new Respuesta();
                $respuesta->id_seccion = $seccion->id;
                $respuesta->id_pregunta = $pregunta->id;
                if($pregunta->profesor){
                    $nombre_aux = str_replace('el/la_profesor/a','el_profesor',$nombre_aux);
                    if(!array_key_exists($nombre_aux,$row->toArray())){
                        $nombre_aux = $this->normaliza($pregunta->nombre);
                        $nombre_aux = str_replace('el/la_profesor/a','la_profesora',$nombre_aux);
                    }
                    $respuesta->id_user = $pregunta->docente;
                }

                if($pregunta->auxiliar){

                    $nombre_aux = str_replace('el/la_auxiliar','el_profesor',$nombre_aux);

                    if(!array_key_exists($nombre_aux,$row->toArray())){

                        $nombre_aux = $this->normaliza($pregunta->nombre);
                        $nombre_aux = str_replace('el/la_auxiliar','la_profesora',$nombre_aux);
                    }

                    $respuesta->id_user = $pregunta->docente;
                }

                if(!array_key_exists($nombre_aux,$row->toArray())){
                    dd($nombre_aux);
                    $request->session()->flash('fallo', "Error en el formato.");
                    return redirect()->back();
                }

                if($row[$nombre_aux] != null){
                    $respuesta->respuesta = $row[$nombre_aux];
                    $respuestas->push($respuesta);
                }
            }
        }
        $borrar_respuestas = Respuesta::where('id_seccion',$seccion->id)->get();

        foreach($borrar_respuestas as $respuesta){
            $respuesta->delete();
        }
        foreach($respuestas as $respuesta)
        {
            $respuesta->save();
        }


        $request->session()->flash('guardado', "Excel guardado con exito!.");
        return redirect()->back();
    }
}
