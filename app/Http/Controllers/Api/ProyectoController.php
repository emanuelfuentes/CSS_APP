<?php

namespace App\Http\Controllers\Api;

use App\ProyectoxCarrera;
use Mail;
use Carbon\Carbon;
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

        $proyectos = Proyecto::join('proyectoxcarrera', 'proyecto.idProyecto', '=','proyectoxcarrera.idProyecto')
            ->leftJoin('proyectoxestudiante', 'proyectoxestudiante.idProyecto', '=', 'proyecto.idProyecto')
            ->select('proyecto.idProyecto', 'proyecto.nombre','proyecto.descripcion','proyecto.estado', 'proyecto.tipo_horas', 'proyecto.cupos_act','proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
            ->where('proyecto.estado','=','1')
//            ->where('proyecto.fecha_inicio', '>=', date('Y-m-d'))
            ->where('proyectoxcarrera.limite_inf', '<=', $user->idPerfil)
            ->where('proyectoxcarrera.limite_sup', '>=', $user->idPerfil)
            ->where('proyectoxcarrera.idCarrera', '=', $user->idCarrera)
            ->whereRaw('(proyectoxestudiante.idUser !=' . $user->idUser . ' OR proyectoxestudiante.idUser IS NULL)')
            ->whereRaw('proyecto.idProyecto NOT IN (SELECT p.idProyecto FROM proyecto p, proyectoxestudiante pe WHERE p.idProyecto = pe.idProyecto AND pe.idUser = ' . $user->idUser . ')')
            ->whereRaw('proyecto.cupos_act < proyecto.cupos')
            ->groupBy('proyecto.idProyecto', 'proyecto.nombre', 'proyecto.descripcion', 'proyecto.estado', 'proyecto.tipo_horas', 'proyecto.cupos_act', 'proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
            ->orderBy('proyecto.idProyecto', 'desc')->get();

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

    public function putUpdateProyecto(Request $request) {
        $validator = Validator::make($request->all(), [
            'idProyecto'        => 'required',
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

        $proyecto = Proyecto::findOrFail($request->idProyecto);
            $proyecto->nombre = $request->nombre;
            $proyecto->contraparte = $request->contraparte;
            $proyecto->cupos = $request->cupos;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->encargado = $request->encargado;
            $proyecto->fecha_inicio = $request->fecha_inicio;
            $proyecto->fecha_fin = $request->fecha_fin;
            $proyecto->horario = $request->horario;
            $proyecto->tipo_horas = $request->tipo_horas;
            $proyecto->correo_encargado = $request->correo_encargado;
        $proyecto->save();

        $arraycp = $request->carreraPerfil;

        if($arraycp) {
            ProyectoxCarrera::where('idProyecto', '=', $request->idProyecto)->delete();

            for($i = 0; $i < count($arraycp); $i++){
                if($arraycp[$i][0] == -1 || $arraycp[$i][0] == -2){
                    $this->todasLasCarreras($proyecto->idProyecto, $arraycp[$i]);
                }
                else{
                    $pxc = new ProyectoxCarrera();
                    $pxc->idProyecto = $proyecto->idProyecto;
                    $pxc->idCarrera = $arraycp[$i][0];
                    $pxc->limite_inf = $arraycp[$i][1];
                    $pxc->limite_sup = $arraycp[$i][2];
                    $pxc->save();
                }
            }
        }

        return response()->json($proyecto);
    }

    private function todasLasCarreras(int $idProyecto, array $options){
        $carreras = Carrera::all();
        for($i = 0; $i < count($carreras); $i++){
            if($options[0] == -1 || ($options[0] == -2 && ($carreras[$i]->idCarrera != 3 && $carreras[$i]->idCarrera != 9 && $carreras[$i]->idCarrera != 10))){
                $pxc = new ProyectoxCarrera();
                $pxc->idProyecto = $idProyecto;
                $pxc->idCarrera = $carreras[$i]->idCarrera;
                $pxc->limite_inf = $options[1];
                $pxc->limite_sup = $options[2];
                $pxc->save();
            }
        }
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
