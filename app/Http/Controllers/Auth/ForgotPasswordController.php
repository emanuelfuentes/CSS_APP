<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\User;

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

    public function formulario($email){
        $user = User::whereCorreo($email)->first();
        return view('auth.cambiarContra')->with(['user'=>$user]);
    }

    public function cambiar(Request $request, $email){
        /*$this->validate($request, [
            'password' => 'required|min:7|max:12|confirmed',
            'password_confirm' => 'required|min:7|max:12|confirmed'
        ]);*/
        $user = User::whereCorreo($email)->first();
        $user->update(['password'=> Hash::make('hola')]);
        
        return redirect('/');
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
