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
        $email = $request->email;

        if($email == "admin@uca.edu.sv") Auth::loginUsingId(1);
        else if($email == "00170517@uca.edu.sv") Auth::loginUsingId(2);

        //Auth::loginUsingId(3);
        return redirect()->intended('home');

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
