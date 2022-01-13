<?php

namespace App\Http\Controllers\Api;

use App\Carrera;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarreraController extends Controller
{
    public function getCarrerasPorFacultad($idFacultad){
        $carreras = Carrera::where('idFacultad', '=', $idFacultad)->get();

        return response()->json($carreras);
    }
}
