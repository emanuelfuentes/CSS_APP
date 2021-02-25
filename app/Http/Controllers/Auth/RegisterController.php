<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Estudiante;
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
        return view('auth.register');
    }

    public function registrar(Request $request){
        //$this->validator($request);
        
        $nombre = $request->nombres;
        $apellido = $request->apellidos;
        $email = $request->email;
        $carnet = explode('@', $email);
        $genero = $request->genero;

         
        $nombreEvento = "cuenta_no_verificada_" . $carnet[0];
        $query = DB::unprepared('
        CREATE EVENT ' . $nombreEvento . ' ON SCHEDULE
                AT CURRENT_TIMESTAMP + INTERVAL 1 DAY
            DO
                DELETE FROM users WHERE verificado = 0;');

        User::create([
            'nombres' => $nombre,
            'apellidos' => $apellido,
            'correo' => $email,
            'estado' => 1,
            'genero' => $genero,
            'verificado' => 0,
            'idRol' => 2,
            'idPerfil' => 4,
            'idCarrera' => 1,
            'password' => bcrypt('temporal')
        ]);
        $user = User::whereCorreo($email)->first();
        $this->sendEmail($user);
        
        return redirect('/');
    }

    protected function validator(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
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
