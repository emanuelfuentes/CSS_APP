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
    Route::get('/getProyectosDisponibles', 'Api\ProyectoController@getProyectosDisponibles');
    Route::get('/getMisProyectos', 'Api\ProyectoController@getMisProyectos');


    // ADMIN ROUTES
    Route::middleware(['Administrador'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/getAllStudents', 'Api\EstudianteController@getAllStudents');
            Route::get('/getPerfiles', 'Api\EstudianteController@getPerfiles');
            Route::put('/updateEstudiante', 'Api\EstudianteController@updateEstudiante');
        });
    });
});