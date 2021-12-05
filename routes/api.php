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

////APP ENDPOINTS
Route::middleware(['auth:api'])->group(function () {

    Route::get('/usuario', 'Api\ApiAuthController@obtenerUsuarioPorApiToken');

});


Route::get('/test', function () {
    dd("HOLA");
});