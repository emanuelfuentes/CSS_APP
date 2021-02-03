<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //muestra todos los estudiantes
        $estudiantes = Estudiante::all;
        return $estudiantes;
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
        $estudiante = new Estudiante();
        $estudiante->nombres = $request->nombres;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->carnet = $request->carnet;
        $estudiante->correo = $request->email;
        $estudiante->estado = $request->estado;
        $estudiante->genero = $request->genero;
        $estudiante->default_password = $request->default_password;
        $estudiante->password = $request->password;
        $estudiante->nombres = $request->nombres;
        $estudiante->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //mostrar todos los proyectos a los que aplico
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
    public function update(Request $request)
    {
        $estudiante = Estudiante::findOrFail($request->id);
        $estudiante->nombres = $request->nombres;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->carnet = $request->carnet;
        $estudiante->correo = $request->correo;
        $estudiante->estado = $request->estado;
        $estudiante->genero = $request->genero;
        $estudiante->default_password = $request->default_password;
        $estudiante->password = $request->password;
        $estudiante->nombres = $request->nombres;
        $estudiante->save();
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
