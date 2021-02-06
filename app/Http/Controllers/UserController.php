<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getId(Request $request){
        if(!$request->ajax()) return redirect('/home');
        $id = Auth()->user()->idUser;
        return $id;
    }
}
