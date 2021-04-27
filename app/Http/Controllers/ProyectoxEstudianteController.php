<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoxEstudiante;
use App\Proyecto;
use App\User;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\DB;


class ProyectoxEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/home');
        $proyectoXestudiantes = ProyectoxEstudiante::all();
        return $proyectoXestudiantes;
    }
    public function proyectosAplicados(Request $request)
    {
        if(!$request->ajax()) return redirect('/home');
        $id = Auth()->user()->idUser;
        $proyectos = ProyectoxEstudiante::join('proyecto', 'proyecto.idProyecto', '=','proyectoxestudiante.idProyecto')
        ->join('users', 'proyectoxestudiante.idUser','=','users.idUser')
        ->select('proyecto.idProyecto', 'proyecto.nombre','proyecto.descripcion','proyecto.estado',
        'proyecto.tipo_horas', 'proyecto.cupos', 'proyecto.horario', 'proyecto.encargado','proyecto.fecha_inicio','proyecto.fecha_fin')
        ->where('proyectoxestudiante.idUser','=', $id)
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

    public function pxePorId (Request $request) {
        if(!$request->ajax()) return redirect('/home');
        $req = $request->idUser;
        $pXe = ProyectoxEstudiante::query('SELECT * FROM proyectoxestudiante pxe WHERE pxe.idUser = :req')->get();
        return $pXe;
    }

    public function estudiantesPorProyecto(Request $request){
        if(!$request->ajax()) return redirect('/home');
        $idProyecto = $request->idProyecto;
        //$estudiantes = User::query('SELECT * FROM users u INNER JOIN proyectoxestudiante pe ON u.idUser = pe.idUser WHERE pe.idProyecto = :idProyecto')->get();
        $estudiantes = User::join('proyectoxestudiante', 'users.idUser', '=', 'proyectoxestudiante.idUser')
        ->select('users.nombres', 'users.apellidos', 'users.correo', 'users.genero', 'users.idPerfil', 'users.idCarrera', 'proyectoxestudiante.estado')
        ->where('proyectoxestudiante.idProyecto', '=', $idProyecto)->get();
        return $estudiantes;
    }

    public function aceptarRechazarEstudiante(Request $request){
        //if(!$request->ajax()) return redirect('/home');
        $idProyecto = $request->idProyecto;
        $idUser = $request->idUser;
        dd($idProyecto .$idUser);

        $estado = $request->estado;
        $proXEst = ProyectoxEstudiante::query('SELECT * FROM proyectoxestudiante pe WHERE pe.idProyecto = :idProyecto AND pe.idUser = :idUser')->first();
        //$proXEst->estado = $estado;
        //$proXEst->save();
        $mailData = User::join('proyectoxestudiante', 'users.idUser', '=', 'proyectoxestudiante.idUser')
        ->join('proyecto', 'proyectoxestudiante.idProyecto', '=', 'proyecto.idProyecto')
        ->select('users.nombres', 'users.apellidos', 'users.correo','proyecto.encargado','proyecto.nombre')
        ->where('proyectoxestudiante.idUser', '=', 2)
        ->first();

        
        //$this->sendEmailAceptadoRechazado($mailData, $estado);
    }

    public function aplicar(Request $request)
    {
        $pXe = new ProyectoxEstudiante();
        $pXe->idProyecto = $request->idProyecto;
        $pXe->idUser = $request->idUser;
        $pXe->estado = $request->estado;
        $pXe->modificado_por = $request->modificado_por;
        $pXe->save();

        $user = Auth()->user();
        $user->ya_aplico_hoy = date('d-m-Y');
        $user->save();
        
        $proyecto = ProyectoxEstudiante::join('users', 'users.idUser', '=', 'proyectoxestudiante.idUser')
        ->join('proyecto', 'proyecto.idProyecto','=', 'proyectoxestudiante.idProyecto')
        ->select('proyecto.correo_encargado', 'proyecto.encargado', 'proyecto.nombre', 'users.nombres', 'users.apellidos', 'users.correo')
        ->where('users.idUser', '=', $request->idUser)
        ->where('proyecto.idProyecto','=', $request->idProyecto)->first();
        $this->sendEmail($proyecto);
    }

    public function sendEmail($user){
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

    public function sendEmailAceptadoRechazado($mailData, $estado){
        if($estado == 1){
            Mail::send(
                'emails.aceptado',
                ['data' => $mailData],
                function($message) use ($mailData){
                    $message->from("automatic.noreply.css@gmail.com", "Centro de Servicio Social");
                    $message->to($mailData->correo);
                    $message->subject("Estado de su aplicación. Proyecto: ". $mailData->nombre);
                }
            );
        }
        elseif($estado == 2){
            Mail::send(
                'emails.rechazado',
                ['user' => $user],
                function($message) use ($user){
                    $message->from("automatic.noreply.css@gmail.com", "Centro de Servicio Social");
                    $message->to($user->correo);
                    $message->subject("Estado de su aplicación. Proyecto: ". $user->nombre);
                }
            );
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // mostrar proyectos dependiendo de la carrera
        
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
    {/*
        $proyecto = Proyecto::findOrFail($request->id);
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
        $proyecto->modifiedBy = $request->modifiedBy;
        $proyecto->createdAt = $request->createdAt;
        $proyecto->save();*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function deleteRow(Request $request)
    {
        if(!$request->ajax()) return redirect('/home');
        $idUser = $request->idUser;
        $idProyecto = $request->idProyecto;
        ProyectoxEstudiante::where('idProyecto','=', $idProyecto)
        ->where('idUser','=', $idUser)
        ->delete();
    }
}
