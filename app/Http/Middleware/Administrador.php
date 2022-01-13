<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth()->user();
        if(!$user) {
            return response()->json([ 'error' => 'User not authenticated.' ], 403);
        }

        if($user->idRol != 1) {
            return response()->json([ 'error' => 'User not authorized.' ], 401);
        }

        return $next($request);
    }
}
