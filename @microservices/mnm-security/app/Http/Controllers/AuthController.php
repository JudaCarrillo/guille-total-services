<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
            $usuario = User::where('status', 'A')->where('email', $request->email)->first();
            if (!$usuario) {
                return response()->json(['resp' => 'Usuario no registrado'], 400);
            }
            if (!password_verify($request->password, $usuario->password)) {
                return response()->json(['resp' => 'Contraseña incorrecta'], 400);
            }
            $acceso_token = hash('sha256', Str::random(60));
            $refresh_token = hash('sha256', Str::random(60));
            $expiracion_acceso = Carbon::now()->addMinutes(30);
            $expiracion_refresh = Carbon::now()->addDays(30);

            $token = Token::create([
                'user_id' => $usuario->user_id,
                'access_token' => $acceso_token,
                'refresh_token' => $refresh_token,
                'access_token_expires_at' => $expiracion_acceso,
                'refresh_token_expires_at' => $expiracion_refresh,
            ]);
            return response()->json([
                "usuario" =>
                [
                    'user_id' => $usuario->user_id,
                    'name' => $usuario->name,
                    'paternal_surname' => $usuario->paternal_surname,
                    'maternal_surname' => $usuario->maternal_surname,
                    'data_of_birth' => $usuario->data_of_birth,
                    'email' => $usuario->email,
                    'user_type' => $usuario->user_type,
                    'verified_state' => $usuario->verified_state,
                    'verified_at' => $usuario->verified_at,
                ],
                "token" =>
                [
                    'access_token' => $acceso_token,
                    'refresh_token' => $refresh_token,
                    'access_token_expires_at' => $expiracion_acceso,
                    'refresh_token_expires_at' => $expiracion_refresh,
                ]
            ], 200);
        } catch (TooManyRequestsHttpException $e) {
            return response()->json(['message' => 'Demasiados intentos fallidos. Inténtalo de nuevo en 1 minutos'], 400);
        } catch (\Exception $e) {
            return response()->json(["error" => "Algo salió mal", "message" => $e->getMessage()], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required|string',
                'paternal_surname' => 'required|string',
                'maternal_surname' => 'required|string',
                'data_of_birth' => 'required|date',
                'email' => 'required|email',
                'password' => 'required|string|min:4',
            ]);
            $usuario_existente=User::where('status','A')->where('email', $request->email)->first();
            if($usuario_existente){
                return response()->json(['resp' => 'El correo ya se encuentra registrado'], 400);
            }
            User::create([
                'user_id' => User::max('user_id') + 1,
                'name' => $request->name,
                'paternal_surname' => $request->paternal_surname,
                'maternal_surname' => $request->maternal_surname,
                'data_of_birth' => $request->data_of_birth,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'user_type' => 2,
                'verified_state' => 'V',
                'verified_at' => now(),
            ]);
            DB::commit();
            return response()->json(['resp'=>'Registrado Correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["error" => "Algo salió mal", "message" => $e->getMessage()], 500);
        }
    }
}
