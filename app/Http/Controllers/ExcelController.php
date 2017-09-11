<?php

namespace App\Http\Controllers;

use App\Tipo;
use App\Curso;
use App\Seccion;
use App\User;
use App\User_Seccion;
use Illuminate\Http\Request;

use App\Http\Requests;
use Excel;
use Hash;

class ExcelController extends Controller
{
    public function rellenarUsuarios() {
        ini_set('max_execution_time', 18000);
        $curso = null;
        $seccion = null;
        $tipo = null;

        $rows = Excel::load('Equipos_docentes.xlsx')->get();
        foreach($rows as $row) {

            if($row['tipo_curso'] != null){
                $tipo = Tipo::where('nombre',$row['tipo_curso'])->first();
                $curso = new Curso();
                $curso->codigo = $row['codigo'];
                $curso->id_tipo = $tipo->id;
                $curso->save();
            }
            if($row['secc.'] != null){

                $seccion = new Seccion();
                $seccion->numero = $row['secc.'];
                $seccion->id_curso = $curso->id;
                $seccion->save();
            }

            if($row['profesor'] != null){
                $profesor = User::where('name',$row['profesor'])->first();
                if($profesor == null){
                    $profesor = new User();
                    $profesor->name = $row['profesor'];
                    $profesor->password = Hash::make($row['profesor']);
                    $profesor->id_rol = 1;
                    $profesor->save();
                }
                $relacion = new User_Seccion();
                $relacion->id_seccion = $seccion->id;
                $relacion->id_user = $profesor->id;
                $relacion->save();
            }

            if($row['coordinador'] != null){
                $profesor = User::where('name',$row['coordinador'])->first();
                if($profesor == null){
                    $profesor = new User();
                    $profesor->name = $row['coordinador'];
                    $profesor->password = Hash::make($row['coordinador']);
                    $profesor->id_rol = 3;
                    $profesor->save();
                }
                $relacion = new User_Seccion();
                $relacion->id_seccion = $seccion->id;
                $relacion->id_user = $profesor->id;
                $relacion->save();
            }

            if($row['prof._auxiliar'] != null){
                $profesor = User::where('name',$row['prof._auxiliar'])->first();
                if($profesor == null){
                    $profesor = new User();
                    $profesor->name = $row['prof._auxiliar'];
                    $profesor->password = Hash::make($row['prof._auxiliar']);
                    $profesor->id_rol = 2;
                    $profesor->save();
                }
                $relacion = new User_Seccion();
                $relacion->id_seccion = $seccion->id;
                $relacion->id_user = $profesor->id;
                $relacion->save();
            }

        }
        return "ok";
    }
}
