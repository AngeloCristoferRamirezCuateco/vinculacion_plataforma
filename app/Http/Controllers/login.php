<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use App\Models\Rol;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class login extends Controller
{
    public function loginUser(Request $request)
    {
        // Control de limitación de tasa
        $this->checkRateLimiting($request);

        // Validación de los campos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Credenciales de usuario
        $credentials = [
            'correoUsuario' => $request->email,
            'passwordUsuario' => $request->password,
        ];

        // Buscar usuario por correo
        $user = Usuario::where('correoUsuario', $request->email)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($user && Hash::check($request->password, $user->passwordUsuario)) {
            // Autenticar al usuario
            Auth::login($user);
            
            //Guardamos inforamcion de la sesion 
            $request->session()->put('user_name', $user->nombreUsuario);
            $info = $request;
            

            //Regenerar ID de sesión para prevenir ataques de fijación de sesión
            $request->session()->regenerate();

            // Regenerar token CSRF
            $request->session()->regenerateToken();

            // Limpiar intentos de inicio de sesión
            Session::forget('login_attempts');
            RateLimiter::clear($this->throttleKey($request));

            // Log del estado de la sesión
            Log::info('Estado de la sesión después del inicio de sesión', [
                'user_id' => $user->id_usuario,
                'session_id' => session()->getId(),
                'session_data' => session()->all(),
            ]);

            // Obtener el rol del usuario
            $usuarioRol = UsuarioRol::where('id_usuario', $user->id_usuario)->first();
            if ($usuarioRol) {
                $rol = Rol::find($usuarioRol->id_rol);
                switch ($rol->rol) {
                    case 1:
                        $userId = Auth::id();
                        $user = Auth::user();
                        return redirect()->route('alumno.panelInicio', [
                            'userId' => $userId,
                            'user' => $user,
                        ]);
                    case 2:
                        $userId = Auth::id();
                        $user = Auth::user();
                        return redirect()->route('docente.panelInicio', [
                            'userId' => $userId,
                            'user' => $user,
                        ]);
                    case 3:
                        $userId = Auth::id();
                        $user = Auth::user();
                        $Rol = Rol::all();
                        Log::info('User Name from Session:', ['user_name' => $request->session()->get('user_name')]);

                        Log::info('Id de usuario -> '.$userId);
                        Log::info('Usuario -> ' . json_encode($user));
                            
                        return view('dashboars.Representantes.dashboardRepresentantes', [
                            'userId' => $userId,
                            'user' => $user,
                            'Rol' => $Rol
                        ]);
                    case 4:
                        return redirect()->route('dashboard.index');
                    default:
                        return response()->json(['message' => 'Rol no reconocido'], 200);
                }
            } else {
                return response()->json(['message' => 'Rol no asignado'], 200);
            }
        } else {
            // Incrementar intentos de inicio de sesión en caso de falla
            Session::put('login_attempts', Session::get('login_attempts', 0) + 1);
            $this->incrementLoginAttempts($request);
            $attempts = Session::get('login_attempts');
            return redirect()->back()->withErrors(['message' => "Email o contraseña incorrectos. Intentos: $attempts"]);
        }
    }

    protected function checkRateLimiting(Request $request)
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 3)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.throttle', ['seconds' => RateLimiter::availableIn($this->throttleKey($request))])],
            ]);
        }
    }

    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request), 900);
    }

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')).'|'.$request->ip();
    }

}