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

class login extends Controller
{
    public function loginUser(Request $request)
    {
        $this->checkRateLimiting($request);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'correoUsuario' => $request->email,
            'passwordUsuario' => $request->password,
        ];

        $user = Usuario::where('correoUsuario', $request->email)->first();

        if ($user && Hash::check($request->password, $user->passwordUsuario)) {
            Auth::login($user);
            Session::forget('login_attempts');
            RateLimiter::clear($this->throttleKey($request));

            $usuarioRol = UsuarioRol::where('id_usuario', $user->id_usuario)->first();
            if ($usuarioRol) {
                $rol = Rol::find($usuarioRol->id_rol);
                switch ($rol->rol) {
                    case 1:
                        return redirect()->route('alumno.panelInicio');
                    case 2:
                        return redirect()->route('docente.panelInicio');
                    case 3:
                        return redirect()->route('representante.panelInicio');
                    case 4:
                        return redirect()->route('dashboard.index');
                    default:
                        return response()->json(['message' => 'Rol no reconocido'], 200);
                }
            } else {
                return response()->json(['message' => 'Rol no asignado'], 200);
            }
        } else {
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