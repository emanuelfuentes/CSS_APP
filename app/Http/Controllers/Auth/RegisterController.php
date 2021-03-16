<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Estudiante;
use App\Facultad;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showForm(){
        $facultades = Facultad::all();
        return view('auth.register')->with('fact', $facultades);
    }

    public function registrar(Request $request){
        $this->validator($request);
        
        $email = $request->carnet . "@uca.edu.sv";
        $user = User::whereCorreo($email)->first();

        if($user == null){
            $nombre = $request->nombres;
            $apellido = $request->apellidos;
            $carnet = explode('@', $email);
            $genero = $request->genero;
            $carrera = $request->carrera;

            $nombreEvento = "cuenta_no_verificada_" . $carnet[0];
            DB::unprepared('SET GLOBAL event_scheduler = ON;');
            DB::unprepared('
            CREATE EVENT ' . $nombreEvento . ' ON SCHEDULE
                    AT CURRENT_TIMESTAMP + INTERVAL 1 MINUTE
                DO
                    DELETE FROM users WHERE verificado = 0 AND users.correo = "' . $email .'";');
            User::create([
                'nombres' => $nombre,
                'apellidos' => $apellido,
                'correo' => $email,
                'estado' => 1,
                'genero' => $genero,
                'verificado' => 0,/*
                'ultima_fecha' => '1-1-2021',*/
                'idRol' => 2,
                'idPerfil' => 4,
                'idCarrera' => $carrera,
                'password' => bcrypt('temporal')
            ]);
            $user = User::whereCorreo($email)->first();
            $this->sendEmail($user);
            return redirect('/');
        }
        elseif($user != null && $user->verificado == 0){
            return back()
            ->withErrors(['email_existente' => trans('auth.aun_no_verificado')])
            ->withInput(request(['carnet', 'apellidos', 'nombres']));  
        }
        else{
            return back()
            ->withErrors(['email_existente' => trans('auth.ya_verificado')])
            ->withInput(request(['carnet', 'apellidos', 'nombres']));
        }
    }

    protected function validator(Request $request)
    {
        $this->validate($request, [
            'carnet' => 'required|numeric|regex:/[0-9]{8}/',
            'nombres' => 'required|string',
            'apellidos' => 'required|string'
        ]);
    }

    public function sendEmail($user){
        Mail::send(
            'emails.verificar',
            ['user' => $user],
            function($message) use ($user){
                $message->to($user->correo);
                $message->subject("Solicitud de creación de cuenta.");
            }
        );
    }
}
