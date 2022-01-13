<?php

namespace App\Http\Controllers\Api;

use App\Facultad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacultadController extends Controller
{
    public function getFacultades(){
        $facultades = Facultad::all();
        return response()->json($facultades);
    }
}
