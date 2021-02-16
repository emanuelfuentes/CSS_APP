<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(Request $request){
        if(!$request->ajax()) return redirect('/home');
        $user = Auth()->user();
        return $user;
    }
}
