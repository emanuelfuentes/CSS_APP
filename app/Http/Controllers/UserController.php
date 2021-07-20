<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Carrera;
class UserController extends Controller
{
    public function getUser(Request $request){
        if(!$request->ajax()) return redirect('/home');
        $user = Auth()->user();
        return $user;
    }

    public function yaAplico(Request $request){
        if(!$request->ajax()) return redirect('/home');
        $user = Auth()->user();
        if($user->ya_aplico_hoy == date('d-m-Y') ) {
            return 1;
        }
        else{
            return 0;
        }
    }

    public function estudiantePorCarnet(Request $request){
        if(!$request->ajax()) return redirect('/home');
        $estudiante = User::where('correo', '=', $request->carnet . '@uca.edu.sv')->first();
        $carrera = null;
        if($estudiante){
            $carrera = Carrera::where('idCarrera', '=', $estudiante->idCarrera)->first();
        }
        return [$estudiante, $carrera];
    }

    public function actualizarEstudiante(Request $request){
        if(!$request->ajax()) return redirect('/home');
        $estudiante = User::where('correo', '=', $request->carnet . '@uca.edu.sv')->first();
        $estudiante->idCarrera = $request->idCarrera;
        $estudiante->idPerfil = $request->idPerfil;
        $estudiante->save();
    }

    public static function ruta(){
        return '/css-proyecto/public'; 
    }
}
