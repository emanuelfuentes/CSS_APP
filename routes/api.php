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


Route::get('getFacultades', 'Api\FacultadController@getFacultades');
Route::get('getCarreras', 'Api\CarreraController@getCarreras');
Route::get('getCarrerasPorFacultad/{idFacultad}', 'Api\CarreraController@getCarrerasPorFacultad');


////APP ENDPOINTS
Route::middleware(['auth:api', ])->group(function () {
    // ESTUDIANTES
    Route::get('/getPermisoAplicar', 'Api\ProyectoController@getPermisoAplicar');
    Route::get('/getProyectosDisponibles', 'Api\ProyectoController@getProyectosDisponibles');
    Route::get('/getMisProyectos', 'Api\ProyectoController@getMisProyectos');

    Route::post('/postAplicarProyecto', 'ProyectoxEstudianteController@aplicar');
    Route::post('/postDesaplicarProyecto', 'ProyectoxEstudianteController@deleteRow');

    // ADMIN ROUTES
    Route::middleware(['Administrador'])->group(function () {
        Route::prefix('admin')->group(function () {
            // PROYECTOS
            Route::get('/getTodosLosProyectos', 'Api\ProyectoController@getTodosLosProyectos');
            Route::get('/getHistorialDeProyectos', 'Api\ProyectoController@getHistorialDeProyectos');
            Route::put('/updateEstadoProyecto', 'Api\ProyectoController@updateEstadoProyecto');
            Route::put('/putUpdateProyecto', 'ProyectoController@update');
            Route::put('/putAplicarEnProyecto', 'ProyectoxEstudianteController@aceptarRechazarEstudiante');
            Route::post('/storeProyecto', 'ProyectoController@store');
            Route::post('/postApplyStudent', 'Api\ProyectoController@postApplyStudent');

            // ESTUDIANTES
            Route::get('/getAllStudents', 'Api\EstudianteController@getAllStudents');
            Route::get('/getPerfiles', 'Api\EstudianteController@getPerfiles');
            Route::put('/updateEstudiante', 'Api\EstudianteController@updateEstudiante');
        });
    });
});