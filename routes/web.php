<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('principal');
});

Route::get('/home', function () {
    return view('home/edashboard');
});

Route::get('/admin', function () {
    return view('admin/adashboard');
});

//proyecto
Route::get('/proyecto', 'ProyectoController@index');

//proyecto x estudiante
Route::post('/proyecto/ingresar', 'ProyectoxEstudianteController@store');

Route::put('/proyecto/actualizar',  'ProyectoController@update');