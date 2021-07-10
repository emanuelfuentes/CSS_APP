<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\ProyectoxCarrera;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/home');
        $proyectos = Proyecto::where('estado','=','1')->paginate(5);
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

    public function proyectosNoDisponibles(Request $request)
    {
        if(!$request->ajax()) return redirect('/home');
        $proyectos = Proyecto::where('estado','=','0')->paginate(5);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proyecto = new Proyecto();
        $proyecto->estado = $request->estado;
        $proyecto->contraparte = $request->contraparte;
        $proyecto->cupos = $request->cupos;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->encargado = $request->encargado;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->horario = $request->horario;
        $proyecto->nombre = $request->nombre;
        $proyecto->tipo_horas = $request->tipo_horas;
        $proyecto->modificado_por = $request->modificado_por;
        $proyecto->creado_en = $request->createdAt;
        $proyecto->save();

        $arraycp = $request->carreraPerfil;

        for($i = 0; $i < count($arraycp); $i++){
            $pxc = new ProyectoxCarrera();
            $pxc->idProyecto = $proyecto->idProyecto;
            $pxc->idCarrera = $arraycp[$i][0];
            $pxc->limite_inf = $arraycp[$i][1];
            $pxc->limite_sup = $arraycp[$i][2];
            $pxc->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

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

    public function update(Request $request)
    {
        $proyecto = Proyecto::findOrFail($request->idProyecto);
        $proyecto->estado = $request->estado;
        $proyecto->contraparte = $request->contraparte;
        $proyecto->cupos = $request->cupos;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->encargado = $request->encargado;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->horario = $request->horario;
        $proyecto->nombre = $request->nombre;
        $proyecto->tipo_horas = $request->tipo_horas;
        $proyecto->modificado_por = $request->modificado_por;
        $proyecto->creado_en = $request->createdAt;
        $proyecto->save();

        ProyectoxCarrera::where('idProyecto', '=', $request->idProyecto)->delete();

        $arraycp = $request->carreraPerfil;

        for($i = 0; $i < count($arraycp); $i++){
            $pxc = new ProyectoxCarrera();
            $pxc->idProyecto = $proyecto->idProyecto;
            $pxc->idCarrera = $arraycp[$i][0];
            $pxc->limite_inf = $arraycp[$i][1];
            $pxc->limite_sup = $arraycp[$i][2];
            $pxc->save();
        }
    }
    
    
    public function state(Request $request)
    {
        $proyecto = Proyecto::findOrFail($request->idProyecto);
        $proyecto->estado = $request->estado;
        $proyecto->save();
    }
}