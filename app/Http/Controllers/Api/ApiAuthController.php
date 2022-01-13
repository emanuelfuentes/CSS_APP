<?php

namespace App\Http\Controllers\Api;

use Mail;
use App\User;
use Carbon\Carbon;
use App\PasswordResetToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    /**
     * Obtiene el api_token del request y retorna el usuario correspondiente
     *
     * @param Request $request
     * @return mixed
     */
    public function obtenerUsuarioPorApiToken(Request $request)
    {
        return response()->json([
            'user' => Auth()->user(),
        ], 200);
    }


    /**
     * Recibe el correo completo (incluyendo el @uca.edu.sv) y contrasena del usuario
     * Lo autentica y retorna el usuario con su api token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo'    => 'required|string',
            'password'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $usuario = User::where('correo', '=', $request->correo)->firstOrFail();

        if (Hash::check($request->password, $usuario->password)) {
            return response()->json([
                'user' => $usuario,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Correo o clave incorrecta.'
            ], 400);
        }
    }

    /**
     * Obtiene los datos del request y crea un nuevo usuario
     * el correo debe incluir @uca.edu.sv
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo' => 'required|string|email|unique:users,correo',
            'nombres' => 'required|string|regex:/([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'apellidos' => 'required|string|regex:/([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'genero' => 'required|in:F,M',
            'carrera' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $usuario = User::create([
            'nombres'               => strtoupper($request->nombres),
            'apellidos'             => strtoupper($request->apellidos),
            'correo'                => $request->correo,
            'estado'                => 1,
            'genero'                => $request->genero,
            'verificado'            => 0,
            'ultima_fecha_contra'   => '1-1-2000',
            'ya_aplico_hoy'         => '1-1-2000',
            'idRol'                 => 2,
            'idPerfil'              => $this->determinarPerfilDeAlumno($request->correo),
            'idCarrera'             => $request->carrera,
            'password'              => bcrypt('temporal'),
            'api_token'             => $this->generarApiToken()
        ]);
        Mail::send(
            'emails.verificar',
            ['user' => $usuario],
            function($message) use ($usuario){
                $message->from("automatic.noreply.css@gmail.com", "Centro de Servicio Social");
                $message->to($usuario->correo);
                $message->subject("Solicitud de creación de cuenta.");
            }
        );

        return response()->json([
            'user' => $usuario,
        ], 200);
    }

    /**
     * Recibe el correo completo (incluyendo el @uca.edu.sv) y genera un PasswordResetToken
     * Luego se envia correo con el token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function olvideClave(Request $request) {
        $validator = Validator::make($request->all(), [
            'correo' => 'required|string|email|exists:users,correo',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $usuario = User::where('correo', '=', $request->correo)->firstOrFail();
        if($usuario->ultima_fecha_contra >= date('d-m-Y')) {
            return response()->json([
                'error' => trans('auth.ya_cambio_contra')
            ], 200);
        } else {
            $token = PasswordResetToken::create([
                'idUser' => $usuario->idUser,
                'token' => strtoupper(Str::random(5)),
                'expires_at' => Carbon::now()->addHour(),
            ]);

            Mail::send(
                'emails.cambiarContra',
                ['user' => $usuario, 'token' => $token->token],
                function($message) use ($usuario){
                    $message->from("automatic.noreply.css@gmail.com", "Centro de Servicio Social");
                    $message->to($usuario->correo);
                    $message->subject("Solicitud para cambiar contraseña.");
                }
            );

            return response()->json([
                'message' => 'Solicitud de cambio de clave recibida, revise su correo electrónico.',
            ], 200);
        }
    }

    public function cambiarClave(Request $request) {
        $validator = Validator::make($request->all(), [
            'token'             => 'required|string',
            'clave'             => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&^#])[A-Za-z\d@$!%*?&^#]{8,}$/',
            'confirmar_clave'   => 'required|same:clave'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $token = PasswordResetToken::where('token', $request->token)->firstOrFail();
        if(Carbon::now() > $token->expires_at) {
            return response()->json([
                'error' => 'Token venció'
            ], 400);
        }

        $usuario = User::where('idUser', '=', $token->idUser)->firstOrFail();
        $usuario->update([
            'password'      => $request->clave,
            'verificado'    => 1
        ]);

        return response()->json([
            'message' => 'Se cambió la clave exitosamente.',
        ], 200);
    }

    // -------------------------------------------------HELPERS-------------------------------------------------

    /**
     * Obtiene el correo del alumno, determina el carnet y en base a los ultimos 2 digitos determina el perfil del alumno
     *
     * @param $correo
     * @return false|int|string
     */
    private function determinarPerfilDeAlumno($correo) {
        $carnet = substr($correo, 0, strpos($correo, "@"));
        $fechaActual = date('y');
        $fechaIngresoEstudiante = substr($carnet, -2);
        $perfil = $fechaActual - $fechaIngresoEstudiante;

        return $perfil > 6 ? 6 : $perfil;
    }
}