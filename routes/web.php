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
    Route::post('/login', 'Auth\LoginController@authenticate')->name('login');

    Route::get('/register_form', 'Auth\RegisterController@showForm')->name('register_form');
    Route::post('/register', 'Auth\RegisterController@registrar')->name('register');   
});


Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', function () {
        return view('home/dashboard');
    })->name('main');
    Route::get('/proyecto', 'ProyectoController@index');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::middleware(['Administrador'])->group(function () {
        Route::post('/proyecto/insertar', 'ProyectoController@store');
        Route::put('/proyecto/actualizar', 'ProyectoController@update'); 
        Route::put('/proyecto/estado', 'ProyectoController@state');
        Route::get('/carrera', 'CarreraController@index');
        Route::get('/perfil', 'PerfilController@index');
        Route::get('/proyectosxcarrera', 'ProyectosxCarreraController@index');
    });

    Route::middleware(['NormalUser'])->group(function () {
        Route::get('/get_user', 'UserController@getUser'); 
        Route::get('/pxe_estudiante', 'ProyectoxEstudianteController@pxePorId');
        Route::get('/mis_proyectos', 'ProyectoxEstudianteController@proyectosPorId');
        Route::get('/mi_carrera', 'CarreraController@carreraPorId');

        Route::post('/proyecto/ingresar', 'ProyectoxEstudianteController@store');
        Route::post('/proyecto/eliminar', 'ProyectoxEstudianteController@deleteRow');
    });
});
/*
Route::get('/mail', function () {
    $details = [
        'title' => 'Mail from CSS rout msg',
        'body' => 'Probando correo automatico'
    ];
    \Mail::to('00017917@uca.edu.sv')->send(new \App\Mail\VerifyMail($details));
    echo 'Email has been sent';
});*/

Route::get('/cambiar_contra/{correo}', 'Auth\ForgotPasswordController@formulario');  
Route::post('/cambiar_contra/{correo}', 'Auth\ForgotPasswordController@cambiar');  

   
