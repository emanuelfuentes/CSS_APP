<?php

namespace App\Http\Controllers\Api;

use App\Perfil;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
    /**
     * Responde con todos los usuarios con rol de estudiante
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllStudents() {
        $estudiantes = User::where('idRol', 2)->with(['rol', 'perfil', 'carrera.facultad'])->get();

        return response()->json($estudiantes);
    }

    /**
     * Responde con todos los perfiles disponibles para alumnos
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPerfiles() {
        $perfiles = Perfil::all();

        return response()->json($perfiles);
    }

    /**
     * Permite actualizar el correo, carrera y perfil de un usuario por medio de su ID
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateEstudiante(Request $request) {
        $validator = Validator::make($request->all(), [
            'idUsuario' => 'required',
            'correo'    => 'required|string',
            'carrera'   => 'required',
            'perfil'    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $estudiante = User::where('idUser', '=', $request->idUsuario)->firstOrFail();
            $estudiante->correo = $request->correo;
            $estudiante->idCarrera = $request->carrera;
            $estudiante->idPerfil = $request->perfil;
            $estudiante->save();

        return response()->json($estudiante);
    }
}
