<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\User;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    //se muestra el formulario para verificar la cuenta, solo se puede usar 1 vez
    public function formularioVerificar($email){
        $user = User::whereCorreo($email)->first();
        if($user->verificado == 0){
            return view('auth.verificarCuenta')->with(['user'=>$user]);
        }
        else{
            return redirect('/');
        }
    }

    //se verifica la cuenta y redirige al login
    public function verificarUsuario(Request $request, $email){
        
        /*$this->validate($request, [
            'password' => 'required|min:7|max:12|confirmed',
            'password_confirm' => 'required|min:7|max:12|confirmed'
        ]);*/

        $user = User::whereCorreo($email)->first();
        $user->update(['password'=> $request->password, 'verificado' => 1]);
        return redirect('/');
    }

    //Se muestra el formulario para solicitar nueva contraseña
    public function formularioEnviarCorreoContraOlvidada(Request $request){
        return view('auth.enviarCorreoContraOlvidada');
    }

    //Se envía al correo ingresado un link para cambiar la contraseña
    public function enviarCorreoContraOlvidada(Request $request){
        $this->validateMail($request);
        $user = User::whereCorreo($request->email)->first();
        
        if($user == null) {
            return back()
            ->withErrors(['correo_inexistente' => trans('auth.correo_inexistente')])
            ->withInput(request(['email']));
        }
        elseif($user->verificado == 0){
            return back()
            ->withErrors(['no_verificado' => trans('auth.correo_no_verificado')])
            ->withInput(request(['email']));
        }
        else{
            $this->sendEmail($user);
        }
        
        return redirect('/');
    }

    //Se muestra el formulario para cambiar la contraseña olvidada
    public function formularioOlvidoContrsenia($email){
        $user = User::whereCorreo($email)->first();
        return view('auth.verificarCuenta')->with(['user'=>$user]);
        return view('auth.contraOlvidada');
    }

    public function cambiarContraseniaOlvidada(Request $request, $email){
        $user = User::whereCorreo($email)->first();
        $user->update(['password'=> $request->password]);
        return redirect('/');
    }
    //Función que envía correos
    public function sendEmail($user){
        Mail::send(
            'emails.cambiarContra',
            ['user' => $user],
            function($message) use ($user){
                $message->to($user->correo);
                $message->subject("Solicitud para cambiar contraseña.");
            }
        );
    }

    protected function validateMail(Request $request){
        $this->validate($request, [
            'email' => 'required|string'
        ]);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
