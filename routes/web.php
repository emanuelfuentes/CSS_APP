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

    Route::get('/carreraxfacultad', 'CarreraController@carreraPorFact')->name('carreraxfact');

    Route::get('/register_form', 'Auth\RegisterController@showForm');
    Route::post('/register', 'Auth\RegisterController@registrar')->name('registrar');   

    Route::get('/verificar_usuario/{correo}', 'Auth\ForgotPasswordController@formularioVerificar');  
    Route::post('/verificar_usuario/{correo}', 'Auth\ForgotPasswordController@verificarUsuario');

    Route::get('/contra_olvidada_form', 'Auth\ForgotPasswordController@formularioEnviarCorreoContraOlvidada');
    Route::post('/contra_olvidada_correo', 'Auth\ForgotPasswordController@enviarCorreoContraOlvidada')->name('olvido_contrasenia'); 

    Route::get('/cambiar_contra_olvidada/{correo}', 'Auth\ForgotPasswordController@formularioOlvidoContrsenia');  
    Route::post('/cambiar_contra_olvidada/{correo}', 'Auth\ForgotPasswordController@cambiarContraseniaOlvidada');
});


Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', function () {
        return view('home/dashboard');
    })->name('main');
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/get_user', 'UserController@getUser');

    Route::middleware(['Administrador'])->group(function () {
        Route::get('/todos_proyectos', 'ProyectoController@index');
        Route::get('/historial_proyectos', 'ProyectoController@proyectosNoDisponibles');
        Route::post('/proyecto/insertar', 'ProyectoController@store');
        Route::put('/proyecto/actualizar', 'ProyectoController@update'); 
        Route::put('/proyecto/estado', 'ProyectoController@state');
        Route::get('/carrera', 'CarreraController@index');
        Route::get('/perfil', 'PerfilController@index');
        Route::get('/proyectosxcarrera', 'ProyectosxCarreraController@proyectosPorCarreraEdit');
        Route::get('/estudiantesxproyecto', 'ProyectoxEstudianteController@estudiantesPorProyecto');
        Route::put('/aplicarestudiante', 'ProyectoxEstudianteController@aceptarRechazarEstudiante');
        Route::put('/rechazarestudiante', 'ProyectoxEstudianteController@rechazarEstudiante');
        Route::post('/aplicarporadmin', 'ProyectoxEstudianteController@aplicarPorAdmin');
        Route::get('/estudiante_por_carnet', 'UserController@estudiantePorCarnet');
        Route::get('/facultad', 'FacultadController@index');
        Route::put('/estudiante/actualizar', 'UserController@actualizarEstudiante');
        Route::get('/cupos_actuales', 'ProyectoController@cuposActuales');
    });

    Route::middleware(['NormalUser'])->group(function () {
        
        Route::get('/ya_aplico', 'UserController@yaAplico');
        Route::get('/pxe_estudiante', 'ProyectoxEstudianteController@pxePorId');
        Route::get('/proyectos_aplicados', 'ProyectoxEstudianteController@proyectosAplicados');
        Route::get('/mi_carrera', 'CarreraController@miCarrera');
        Route::get('/proyectos_carrera', 'ProyectosxCarreraController@proyectosPorCarrera');

        Route::post('/proyecto/aplicar', 'ProyectoxEstudianteController@aplicar');
        Route::post('/proyecto/desaplicar', 'ProyectoxEstudianteController@deleteRow');
    });
});

  

   
