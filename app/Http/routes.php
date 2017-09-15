<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//hola
    Route::get('/', "GraficosController@index");
    Route::get('/docente', "GraficosController@logeado");
    Route::get('/seccion', "GraficosController@getSeccion");
    Route::get('/login', "LoginController@index");
    Route::post('/entrar', "LoginController@entrar");
    Route::get('/rellenar','ExcelController@rellenarUsuarios');

    Route::get('/subir','SubirEncuestaController@index');

    Route::post('/guardar_excel','SubirEncuestaController@guardarExcel');



