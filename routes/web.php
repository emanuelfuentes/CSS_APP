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

Route::get('/main', function () {
    return view('principal');
});

Route::get('/home', function () {
    return view('home/edashboard');
})->name('main');

Route::get('/admin', function () {
    return view('admin/adashboard');
});

Route::get('/proyecto', 'ProyectoController@index');
Route::put('proyecto/actualizar',  'ProyectoController@update'); 

Route::get('/pxe_estudiante', 'ProyectoxEstudianteController@pxePorId');
Route::post('proyecto/ingresar', 'ProyectoxEstudianteController@store');
Route::get('/mis_proyectos', 'ProyectoxEstudianteController@proyectosPorId');

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/home', 'HomeController@index')->name('home');
