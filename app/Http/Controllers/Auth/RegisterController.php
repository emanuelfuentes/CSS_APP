<?php

namespace App\Http\Controllers\Auth;

use App\User;
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

    public function create(){
        return view('auth.register');
    }

    public function registrar(Request $request){
        $this->validator($request);
        $email = $request->email;
        $psw = $request->password;
        $username = $request->username;
        
        $user = User::create([
            'id' => 4,
            'idRol' => 2,
            'name' => $username,
            'email' => $email,
            'password' => $psw
        ]);


        auth()->login('$user');

        return redirect()->intended('home');
    }

    protected function validator(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
    }
}
