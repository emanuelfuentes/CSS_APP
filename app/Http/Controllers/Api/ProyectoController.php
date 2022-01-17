<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Carrera;
use App\Proyecto;
use App\ProyectoxEstudiante;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{
    /**
     * Responde con todos los proyectos disponibles para que estudiantes puedan aplicar
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProyectosDisponibles(){
//        falta validar limite inferior, limite superior, cantidad de cupos
        $proyectos = Auth()->user()
                            ->carrera
                            ->proyectos
                            ->where('estado', 1);
//                            ->where('cupos_act', '>', 'cupos');


        return response()->json($proyectos);
    }

    /**
     * Retorna todos los proyectos en los que el estudiante autenticado aplicó
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMisProyectos(Request $request) {
        $user = Auth::user();
        $proyectos = $user->proyectos;
        return response()->json($proyectos);
    }

    public function postAplicarProyecto(Request $request) {
        $validator = Validator::make($request->all(), [
            'idProyecto'            => 'required',
            'idUser'       => 'required',
            'estado'             => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $pXe = new ProyectoxEstudiante();
            $pXe->idProyecto = $request->idProyecto;
            $pXe->idUser = $request->idUser;
            $pXe->estado = $request->estado;
        $pXe->save();

        $user = Auth()->user();
        $user->ya_aplico_hoy = date('d-m-Y');
        $user->save();

        $proyecto = ProyectoxEstudiante::join('users', 'users.idUser', '=', 'proyectoxestudiante.idUser')
            ->join('proyecto', 'proyecto.idProyecto','=', 'proyectoxestudiante.idProyecto')
            ->join('carrera', 'carrera.idCarrera', '=', 'users.idCarrera')
            ->select('proyecto.correo_encargado', 'proyecto.encargado', 'proyecto.nombre', 'users.nombres', 'users.apellidos', 'users.correo', 'carrera.nombre AS n_carrera')
            ->where('users.idUser', '=', $request->idUser)
            ->where('proyecto.idProyecto','=', $request->idProyecto)->first();

        Mail::send(
            'emails.estudianteAplico',
            ['user' => $user],
            function($message) use ($user){
                $message->from("automatic.noreply.css@gmail.com", "Centro de Servicio Social");
                $message->to($user->correo_encargado);
                $message->subject("Aplicación de un estudiante en su proyecto.");
            }
        );
    }

    public function postDesaplicarProyecto(Request $request){
        $validator = Validator::make($request->all(), [
            'idProyecto' => 'required',
            'idUser'     => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $pxe = ProyectoxEstudiante::where('idProyecto','=', $request->idProyecto)->where('idUser','=', $request->idUser)->firstOrFail();

        if($pxe->estado == 1){
            $p = Proyecto::where('idProyecto', '=', $pxe->idProyecto)->first();
            $p->cupos_act = $p->cupos_act-1;
            $p->save();
        }

        $pxe->delete();

        return response()->json([
            'message' => 'Estudiante eliminado de proyecto exitosamente'
        ]);
    }

    /**
     * Responde con todos los proyectos activos para admin
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTodosLosProyectos() {
        $proyectos = Proyecto::where('estado', 1)->get();
        return response()->json($proyectos);
    }

    /**
     * Responde con todos los proyectos inactivos
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHistorialDeProyectos() {
        $proyectos = Proyecto::where('estado', 0)->get();
        return response()->json($proyectos);
    }

    public function updateEstadoProyecto(Request $request) {
        $validator = Validator::make($request->all(), [
            'idProyecto' => 'required',
            'estado' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $proyecto = Proyecto::findOrFail($request->idProyecto);
            $proyecto->estado = $request->estado;
        $proyecto->save();

        return response()->json([
            'message' => 'Proyecto Actualizado Exitosamente'
        ]);
    }

    /**
     * Guarda un proyecto en la DB
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeProyecto(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre'            => 'required',
            'contraparte'       => 'required',
            'cupos'             => 'required',
            'descripcion'       => 'required',
            'encargado'         => 'required',
            'fecha_inicio'      => 'required',
            'fecha_fin'         => 'required',
            'horario'           => 'required',
            'tipo_horas'        => 'required',
            'correo_encargado'  => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $proyecto = new Proyecto();
            $proyecto->nombre = $request->nombre;
            $proyecto->estado = 1;
            $proyecto->contraparte = $request->contraparte;
            $proyecto->cupos_act = 0;
            $proyecto->cupos = $request->cupos;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->encargado = $request->encargado;
            $proyecto->fecha_inicio = $request->fecha_inicio;
            $proyecto->fecha_fin = $request->fecha_fin;
            $proyecto->horario = $request->horario;
            $proyecto->tipo_horas = $request->tipo_horas;
            $proyecto->correo_encargado = $request->correo_encargado;
        $proyecto->save();

        return response()->json($proyecto);
    }
}
