<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        if($request->carnet == 'admin@uca.edu.sv'){
            $this->validateAdmin($request);
            $email = $request->carnet;
            $psw = $request->password;
            if(Auth::attempt(['correo' => $email, 'password' => $psw])){
                return redirect()->intended('home');
            }
            else{
                return back()
                ->withErrors(['password' => trans('auth.failedPass')])
                ->withInput(request(['carnet']));
            }
        }
        else{
            $this->validateLogin($request);
            $email = $request->carnet . "@uca.edu.sv";
            $psw = $request->password;
            $user = User::whereCorreo($email)->first();
            if($user == null){
                return back()
                ->withErrors(['email_existente' => trans('auth.carnet_inexistente')])
                ->withInput(request(['carnet']));
            }
            else{
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
        
    }
    protected function validateLogin(Request $request){
        $this->validate($request, [
            'carnet' => 'required|numeric|regex:/[0-9]{8}/',
            'password' => 'required|string'
        ]);
    }

    protected function validateAdmin(Request $request){
        $this->validate($request, [
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
