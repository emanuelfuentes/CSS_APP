<?php

namespace App\Http\Controllers\Api;

use App\Proyecto;
use App\Http\Controllers\Controller;
use App\ProyectoxEstudiante;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Responde con todos los proyectos disponibles para que estudiantes puedan aplicar
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProyectosDisponibles(){
        $user = Auth()->user();
//        $proyectos = Proyecto::join('proyectoxcarrera', 'proyecto.idProyecto', '=','proyectoxcarrera.idProyecto')
//                    ->leftJoin('proyectoxestudiante', 'proyectoxestudiante.idProyecto', '=', 'proyecto.idProyecto')
//                    ->select('proyecto.idProyecto', 'proyecto.nombre','proyecto.descripcion','proyecto.estado', 'proyecto.tipo_horas', 'proyecto.cupos_act','proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
//                    ->where('proyecto.estado','=','1')
//                    ->where('proyectoxcarrera.limite_inf', '<=', $user->idPerfil)
//                    ->where('proyectoxcarrera.limite_sup', '>=', $user->idPerfil)
//                    ->where('proyectoxcarrera.idCarrera', '=', $user->idCarrera)
//                    ->where('proyecto.fecha_inicio', '>=', date('Y-m-d'))
//                    ->whereRaw('(proyectoxestudiante.idUser !=' . $user->idUser . ' OR proyectoxestudiante.idUser IS NULL)')
//                    ->whereRaw('proyecto.idProyecto NOT IN (SELECT p.idProyecto FROM proyecto p, proyectoxestudiante pe WHERE p.idProyecto = pe.idProyecto AND pe.idUser = ' . $user->idUser . ')')
//                    ->whereRaw('proyecto.cupos_act < proyecto.cupos')
//                    ->groupBy('proyecto.idProyecto', 'proyecto.nombre', 'proyecto.descripcion', 'proyecto.estado', 'proyecto.tipo_horas', 'proyecto.cupos_act', 'proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
//                    ->orderBy('proyecto.idProyecto', 'desc');

        $proyectos = Proyecto::all();

        return response()->json($proyectos);
    }

    /**
     * Retorna todos los proyectos en los que el estudiante autenticado aplicó
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMisProyectos(Request $request) {
//        $req = $request->idUser;
//        $pXe = ProyectoxEstudiante::query('SELECT * FROM proyectoxestudiante pxe WHERE pxe.idUser = :req')->get();
//        return $pXe;

        $proyectos = Proyecto::all();
        return response()->json($proyectos);
    }
}
