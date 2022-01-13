<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//AUTH ENDPOINTS
Route::post('/login',               'Api\ApiAuthController@login'       );
Route::post('/registro',            'Api\ApiAuthController@registro'    );
Route::post('/olvide-clave',        'Api\ApiAuthController@olvideClave' );
Route::post('/cambiar-clave',       'Api\ApiAuthController@cambiarClave');


//Obtener todas las facultades
Route::get('getFacultades', 'Api\FacultadController@getFacultades');

// Obtener Carreras por ID de Facultad
Route::get('getCarrerasPorFacultad/{idFacultad}', 'Api\CarreraController@getCarrerasPorFacultad');


////APP ENDPOINTS
Route::middleware(['auth:api', ])->group(function () {
    Route::get('/usuario', 'Api\ApiAuthController@obtenerUsuarioPorApiToken');

    // STUDENT ROUTES
//    Route::get('/ya_aplico', 'Api\UserController@yaAplico');
//    Route::get('/pxe_estudiante', 'Api\ProyectoxEstudianteController@pxePorId');
//    Route::get('/proyectos_aplicados', 'Api\ProyectoxEstudianteController@proyectosAplicados');
//    Route::get('/mi_carrera', 'Api\CarreraController@miCarrera');
//    Route::get('/proyectos_carrera', 'Api\ProyectosxCarreraController@proyectosPorCarrera');
//    Route::post('/proyecto/aplicar', 'Api\ProyectoxEstudianteController@aplicar');
//    Route::post('/proyecto/desaplicar', 'Api\ProyectoxEstudianteController@deleteRow');


    // ADMIN ROUTES
    Route::middleware(['Administrador'])->group(function () {
        Route::prefix('admin')->group(function () {

//            Route::get('/todos_proyectos', 'Api\ProyectoController@index');
//            Route::get('/historial_proyectos', 'Api\ProyectoController@proyectosNoDisponibles');
//            Route::post('/proyecto/insertar', 'Api\ProyectoController@store');
//            Route::put('/proyecto/actualizar', 'Api\ProyectoController@update');
//            Route::put('/proyecto/estado', 'Api\ProyectoController@state');
//            Route::get('/carrera', 'Api\CarreraController@index');
//            Route::get('/perfil', 'Api\PerfilController@index');
//            Route::get('/proyectosxcarrera', 'Api\ProyectosxCarreraController@proyectosPorCarreraEdit');
//            Route::get('/estudiantesxproyecto', 'Api\ProyectoxEstudianteController@estudiantesPorProyecto');
//            Route::put('/aplicarestudiante', 'Api\ProyectoxEstudianteController@aceptarRechazarEstudiante');
//            Route::put('/rechazarestudiante', 'Api\ProyectoxEstudianteController@rechazarEstudiante');
//            Route::post('/aplicarporadmin', 'Api\ProyectoxEstudianteController@aplicarPorAdmin');
//            Route::get('/estudiante_por_carnet', 'Api\UserController@estudiantePorCarnet');
//            Route::get('/facultad', 'Api\FacultadController@index');
//            Route::put('/estudiante/actualizar', 'Api\UserController@actualizarEstudiante');
//            Route::get('/cupos_actuales', 'Api\ProyectoController@cuposActuales');

        });
    });
});