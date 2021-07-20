<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoxCarrera;
use App\Proyecto;
use App\Carrera;
use Illuminate\Support\Facades\DB;

class ProyectosxCarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyxcarr = ProyectoxCarrera::all();
        return $proyxcarr;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    private function totalCarreras(){
        return Carrera::count();
    }

    public function proyectosPorCarreraEdit(Request $request){
        $proyxcarrera = ProyectoxCarrera::where('idProyecto', '=', $request->idProyecto)->get();
        
        if($this->totalCarreras() == sizeof($proyxcarrera) || $this->totalCarreras()-3 == sizeof($proyxcarrera)){
            $protemp = new ProyectoxCarrera();
            if($this->totalCarreras() == sizeof($proyxcarrera)) $protemp->idCarrera = -1;
            else $protemp->idCarrera = -2;
            $protemp->idFacultad = -1;
            $protemp->limite_inf = $proyxcarrera[0]->limite_inf;
            $protemp->limite_sup = $proyxcarrera[0]->limite_sup;
            $proyxcarrera = array($protemp);
        }

        return $proyxcarrera;
    }

    public function proyectosPorCarrera(Request $request){
        if(!$request->ajax()) return redirect('/home');
        $user = Auth()->user();
        /*
        $proyectos = Proyecto::join('proyectoxcarrera', 'proyecto.idProyecto', '=','proyectoxcarrera.idProyecto')
        ->select('proyecto.idProyecto', 'proyecto.nombre','proyecto.descripcion','proyecto.estado',
        'proyecto.tipo_horas', 'proyecto.cupos_act','proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
        ->where('proyecto.estado','=','1')
        ->where('proyectoxcarrera.limite_inf', '<=', $user->idPerfil)
        ->where('proyectoxcarrera.limite_sup', '>=', $user->idPerfil)
        ->where('proyectoxcarrera.idCarrera', '=', $user->idCarrera)
        ->where('proyecto.fecha_inicio', '>=', date('Y-m-d'))
        ->whereRaw('proyecto.cupos_act < proyecto.cupos')
        ->orderBy('proyecto.idProyecto', 'desc')->paginate(10);*/
        $proyectos = Proyecto::join('proyectoxcarrera', 'proyecto.idProyecto', '=','proyectoxcarrera.idProyecto')
        ->leftJoin('proyectoxestudiante', 'proyectoxestudiante.idProyecto', '=', 'proyecto.idProyecto')
        ->select('proyecto.idProyecto', 'proyecto.nombre','proyecto.descripcion','proyecto.estado',
        'proyecto.tipo_horas', 'proyecto.cupos_act','proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
        ->where('proyecto.estado','=','1')
        ->where('proyectoxcarrera.limite_inf', '<=', $user->idPerfil)
        ->where('proyectoxcarrera.limite_sup', '>=', $user->idPerfil)
        ->where('proyectoxcarrera.idCarrera', '=', $user->idCarrera)
        ->where('proyecto.fecha_inicio', '>=', date('Y-m-d'))
        ->whereRaw('proyectoxestudiante.idUser is null')
        ->whereRaw('proyecto.cupos_act < proyecto.cupos')
        ->orderBy('proyecto.idProyecto', 'desc')->paginate(10);
        
        return [
            'pagination' => [
                'total'         => $proyectos->total(),
                'current_page'  => $proyectos->currentPage(),
                'per_page'      => $proyectos->perPage(),
                'last_page'     => $proyectos->lastPage(),
                'from'          => $proyectos->firstItem(),
                'to'            => $proyectos->lastItem(),
            ],
            'proyectos' => $proyectos
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
