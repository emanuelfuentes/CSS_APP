<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        $this->validateLogin($request);

        Auth::loginUsingId(1);

        /*
        if(Auth::attempt(['email' => '00170517@uca.edu.sv', 'password' => '1234'])){
            return redirect()->intended('main');
        }
        else{
            return back()
            ->withErrors(['password' => trans('auth.failedPass')])
            ->withInput(request(['email']));
        }
        */
    }
    protected function validateLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
