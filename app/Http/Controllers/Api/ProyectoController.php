<?php

namespace App\Http\Controllers\Api;

use App\ProyectoxCarrera;
use Mail;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Carrera;
use App\Proyecto;
use App\ProyectoxEstudiante;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{
    public function getPermisoAplicar() {
        $user = Auth()->user();
        if($user->ya_aplico_hoy == date('d-m-Y') ) {
            return response()->json([
                'mensaje' => 'No tiene permiso',
                'permiso' => 0
            ], 403);
        }
        else{
            return response()->json([
                'mensaje' => 'Si tiene permiso',
                'permiso' => 1
            ]);
        }
    }

    /**
     * Responde con todos los proyectos disponibles para que estudiantes puedan aplicar
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProyectosDisponibles(){
        $user = Auth()->user();
        $idPerfil = $user->idPerfil != null ? $user->idPerfil : 1;
        $idCarrera = $user->idCarrera != null ? $user->idCarrera : Carrera::first()->idCarrera;

        $proyectos = Proyecto::join('proyectoxcarrera', 'proyecto.idProyecto', '=','proyectoxcarrera.idProyecto')
            ->leftJoin('proyectoxestudiante', 'proyectoxestudiante.idProyecto', '=', 'proyecto.idProyecto')
            ->select('proyecto.idProyecto', 'proyecto.nombre','proyecto.descripcion','proyecto.estado', 'proyecto.tipo_horas', 'proyecto.cupos_act','proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
            ->where('proyecto.estado','=','1')
//            ->where('proyecto.fecha_inicio', '>=', date('Y-m-d'))
            ->where('proyectoxcarrera.limite_inf', '<=', $idPerfil)
            ->where('proyectoxcarrera.limite_sup', '>=', $idPerfil)
            ->where('proyectoxcarrera.idCarrera', '=', $idCarrera)
            ->whereRaw('(proyectoxestudiante.idUser !=' . $user->idUser . ' OR proyectoxestudiante.idUser IS NULL)')
            ->whereRaw('proyecto.idProyecto NOT IN (SELECT p.idProyecto FROM proyecto p, proyectoxestudiante pe WHERE p.idProyecto = pe.idProyecto AND pe.idUser = ' . $user->idUser . ')')
            ->whereRaw('proyecto.cupos_act < proyecto.cupos')
            ->groupBy('proyecto.idProyecto', 'proyecto.nombre', 'proyecto.descripcion', 'proyecto.estado', 'proyecto.tipo_horas', 'proyecto.cupos_act', 'proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
            ->orderBy('proyecto.created_at', 'desc')->get();

        $proyectos->load(['carreras', 'estudiantes.carrera.facultad']);

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
        $proyectos = $user->proyectos()
                            ->with(['carreras', 'estudiantes.carrera.facultad'])
                            ->orderBy('created_at', 'desc')
                            ->get();

        return response()->json($proyectos);
    }

    /**
     * Responde con todos los proyectos activos para admin
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTodosLosProyectos() {
        $proyectos = Proyecto::where('estado', 1)
                                ->with(['carreras', 'estudiantes.carrera.facultad'])
                                ->orderBy('created_at', 'desc')
                                ->get();

        return response()->json($proyectos);
    }

    /**
     * Responde con todos los proyectos inactivos
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHistorialDeProyectos() {
        $proyectos = Proyecto::where('estado', 0)
                                ->with(['carreras', 'estudiantes.carrera.facultad'])
                                ->orderBy('created_at', 'desc')
                                ->get();

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

    public function postApplyStudent(Request $request) {
        $correo = $request->carnet . '@uca.edu.sv';
        $student = User::whereCorreo($correo)->firstOrFail();
        $verify = ProyectoxEstudiante::where('proyectoxestudiante.idProyecto', '=', $request->idProyecto)
                                    ->where('proyectoxestudiante.idUser', '=', $student->idUser)
                                    ->first();
        if($verify == null){
            $pXe = new ProyectoxEstudiante();
            $pXe->idProyecto = $request->idProyecto;
            $pXe->idUser = $student->idUser;
            $pXe->estado = $request->estado;
            $pXe->save();

            $restarCupo = Proyecto::where('proyecto.idProyecto', '=', $request->idProyecto)->first();
            $restarCupo->cupos_act = $restarCupo->cupos_act + 1;
            $restarCupo->save();

            $proyecto = ProyectoxEstudiante::join('users', 'users.idUser', '=', 'proyectoxestudiante.idUser')
                ->join('proyecto', 'proyecto.idProyecto','=', 'proyectoxestudiante.idProyecto')
                ->select('proyecto.encargado', 'proyecto.nombre', 'users.nombres', 'users.apellidos', 'users.correo')
                ->where('users.idUser', '=', $student->idUser)
                ->where('proyecto.idProyecto','=', $request->idProyecto)->first();
            $this->sendEmail($proyecto,2);

            return response()->json(['message' => 'Alumno agregado']);
        }
        else
        {
            return response()->json(['message' => 'El estudiante ya está en el proyecto o tiene una solicitud de aplicar'], 400);
        }
    }


    public function sendEmail($user, $mailType){
        if($mailType == 1){
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
        else{
            Mail::send(
                'emails.agregadoPorAdmin',
                ['user' => $user],
                function($message) use ($user){
                    $message->from("automatic.noreply.css@gmail.com", "Centro de Servicio Social");
                    $message->to($user->correo);
                    $message->subject("Actualización de ingreso a proyecto de horas sociales");
                }
            );
        }

    }
}
