<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Routing\Middleware\ThrottleRequests;
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
                "usuario"=>
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
                "token"=>
                [
                    'access_token' => $acceso_token,
                    'refresh_token' => $refresh_token,
                    'access_token_expires_at' => $expiracion_acceso,
                    'refresh_token_expires_at' => $expiracion_refresh,
                ]
            ],200);
        } catch (TooManyRequestsHttpException $e) {
            return response()->json(['message' => 'Demasiados intentos fallidos. Inténtalo de nuevo en 1 minutos'], 400);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data invalida'], 400);
        }
    }
}
