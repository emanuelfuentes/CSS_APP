<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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
        
        $email = $request->email;
        $psw = $request->password;
        $username = $request->username;
        
        $this->createEstudiante($request);

        User::create([
            'idRol' => 2,
            'name' => $username,
            'email' => $email,
            'password' => $psw
        ]);

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

    public function createEstudiante(Request $request)
    {
        $estudiante = new Estudiante();
        $estudiante->nombres = $request->nombres;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->carnet = $request->carnet;
        $estudiante->correo = $request->email;
        $estudiante->estado = $request->estado;
        $estudiante->genero = $request->genero;
        $estudiante->default_password = bcrypt('1234');
        $estudiante->password = bcrypt($request->password);
        $estudiante->nombres = $request->nombres;
        $estudiante->save();
    }
}
