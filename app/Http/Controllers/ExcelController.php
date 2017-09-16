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

        $rows = Excel::load('Equipos_Docentes.xlsx')->get();
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
                if($profesor->id_rol == 2 || $profesor->id_rol == 3){
                    $profesor2 = User::where('name',$row['profesor'].".")->first();
                    if($profesor2==null){
                        $profesor2 = new User();
                    }
                    $profesor2->name = $row['profesor'].".";
                    $profesor2->password = Hash::make($row['profesor']);
                    $profesor2->id_rol = 1;
                    $profesor2->id_user = $profesor->id;
                    $profesor2->save();
                    $profesor = $profesor2;
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
                if($profesor->id_rol == 1){
                    $profesor2 = new User();
                    $profesor2->name = $row['coordinador'].".";
                    $profesor2->password = Hash::make($row['coordinador']);
                    $profesor2->id_rol = 3;
                    $profesor2->id_user = $profesor->id;
                    $profesor2->save();
                    $profesor = $profesor2;
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
                if($profesor->id_rol == 1){
                    $profesor2 = new User();
                    $profesor2->name = $row['prof._auxiliar'].".";
                    $profesor2->password = Hash::make($row['prof._auxiliar']);
                    $profesor2->id_rol = 1;
                    $profesor2->id_user = $profesor->id;
                    $profesor2->save();
                    $profesor = $profesor2;
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
