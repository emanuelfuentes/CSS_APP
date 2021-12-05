<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Genera una clave (string aleatorio) y la encripta para usarla como api_token
     *
     * @return mixed
     */
    public function generarApiToken() {
        $clave              = Str::random(60);
        $claveEncriptada    = Hash::make($clave);

        return $claveEncriptada;
    }
}
