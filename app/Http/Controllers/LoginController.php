<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Requests;

class LoginController extends Controller
{
    public function index(Request $request){
        if (Auth::check())
        {
            Auth::logout();
        }
        $guardado =$request->session()->get("message");
        return view('login',['message'=>$guardado]);
    }

    public function entrar(Request $request){
        $userdata = array(
            'name' => $request->user,
            'password'=> $request->password
        );
        //dd($request->all());

        $user = User::where([['name', $request->user]])->first();

        if($user==null){
            return redirect()->back()->withInput()->with('message', 'Login Failed');
        }
        if(Auth::attempt($userdata, true))
        {
            return redirect()->to(action('GraficosController@logeado'));
        } else {
            //en caso contrario mostramos un error
            return redirect()->back()->withInput()->with('message', 'Login Failed');
        }

        return redirect()->to('login')->with('message', 'Se ha equivocado en su usuario y/o contraseña');
    }
}
