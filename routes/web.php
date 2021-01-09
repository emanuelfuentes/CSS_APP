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

Route::middleware(['guest'])->group(function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::middleware(['auth'])->group(function () {
    
    Route::middleware(['Administrador'])->group(function () {
        Route::get('/admin_home', function () {
            return view('admin/adashboard');
        });

        Route::get('/proyecto', 'ProyectoController@index');
    });

    Route::middleware(['NormalUser'])->group(function () {
        Route::get('/home', function () {
            return view('home/edashboard');
        })->name('main');

        Route::get('/proyecto', 'ProyectoController@index');
        Route::get('/pxe_estudiante', 'ProyectoxEstudianteController@pxePorId');
        Route::get('/mis_proyectos', 'ProyectoxEstudianteController@proyectosPorId');
    });
});

/*
    Route::put('proyecto/actualizar',  'ProyectoController@update'); 

    Route::post('proyecto/ingresar', 'ProyectoxEstudianteController@store');*/

/*Route::get('/main', function () {
    return view('principal');
});*/








//Route::get('/home', 'HomeController@index')->name('home');
