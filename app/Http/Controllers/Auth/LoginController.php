<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Rules\Captcha;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        if(strpos($request->carnet, '@') == true){
            $user = User::whereCorreo($request->carnet)->first();
            if($user == null){
                return back()
                ->withErrors(['email_inexistente' => trans('auth.cuenta_inexistente')])
                ->withInput(request(['carnet']));
            }
            else{
                $this->validateAdmin($request);
                $email = $request->carnet;
                $psw = $request->contraseña;
                if(Auth::attempt(['correo' => $email, 'password' => $psw])){
                    return redirect()->intended('home');
                }
                else{
                    return back()
                    ->withErrors(['password' => trans('auth.failedPass')])
                    ->withInput(request(['carnet']));
                }
            }
            
        }
        else{
            $this->validateLogin($request);
            $email = $request->carnet . "@uca.edu.sv";
            $psw = $request->contraseña;
            $user = User::whereCorreo($email)->first();
            if($user == null){
                return back()
                ->withErrors(['email_inexistente' => trans('auth.carnet_inexistente')])
                ->withInput(request(['carnet']));
            }
            else{

                if($user->verificado == 0){
                    return back()
                    ->withErrors(['email_inexistente' => trans('auth.aun_no_verificado')])
                    ->withInput(request(['carnet']));
                }
                else{
                    if(Auth::attempt(['correo' => $email, 'password' => $psw])){
                        return redirect()->intended('home');
                    }
                    else{
                        return back()
                        ->withErrors(['contraseña' => trans('auth.failedPass')])
                        ->withInput(request(['carnet']));
                    }
                }
                
            }
        }
        
    }
    protected function validateLogin(Request $request){
        $this->validate($request, [
            'carnet' => 'required|numeric|regex:/[0-9]{8}/',
            'contraseña' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    protected function validateAdmin(Request $request){
        $this->validate($request, [
            'contraseña' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //return view('auth.login');
        return redirect('/');
    }
}
