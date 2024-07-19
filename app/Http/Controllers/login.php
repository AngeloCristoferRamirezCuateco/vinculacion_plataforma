<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class login extends Controller
{
     // Función para iniciar sesión
     public function loginUser(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required|string',
         ]);
 
         $credentials = [
             'correoUsuario' => $request->email,
             'passwordUsuario' => $request->password,
         ];
 
         // Verificar las credenciales
         $user = Usuario::where('correoUsuario', $request->email)->first();
 
         if ($user && Hash::check($request->password, $user->passwordUsuario)) {
             Auth::login($user);
 
             // Obtener el rol del usuario
             $usuarioRol = UsuarioRol::where('id_usuario', $user->id_usuario)->first();
             if ($usuarioRol) {
                 $rol = Rol::find($usuarioRol->id_rol);
                 switch ($rol->rol) {
                     case 1:
                        return response()->json(['message' => 'Usted es un estudiante'], 200);
                     case 2:
                        return response()->json(['message' => 'Usted es un docente'], 200);
                     case 3:
                        return response()->json(['message' => 'Usted es un representante'], 200);
                    case 4:
                        return response()->json(['message' => 'Usted es un administrador'], 200);
                     default:
                         return response()->json(['message' => 'Rol no reconocido'], 200);
                 }
             } else {
                 return response()->json(['message' => 'Rol no asignado'], 200);
             }
         } else {
             return response()->json(['message' => 'Fallo en el inicio de sesión'], 401);
         }
     }
}
