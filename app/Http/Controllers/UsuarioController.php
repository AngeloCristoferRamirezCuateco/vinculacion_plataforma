<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Registrar usuarios
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'id_empresa' => 'required|exists:Empresas,id_empresa',
            'nombreUsuario' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'nullable|string|max:255',
            'telefonoUsuario' => 'required|string|max:20',
            'correoUsuario' => 'required|email|max:255|unique:Usuarios,correoUsuario',
            'passwordUsuario' => 'required|string|max:255',
            'evaluacionUsuario' => 'nullable|integer|min:1|max:10',
            'curriculumUsuario' => 'nullable|string|max:255',
        ]);

        // Encriptar la contraseña
        $validatedData['passwordUsuario'] = Hash::make($request->passwordUsuario);

        Usuario::create($validatedData);

        return response()->json(['message' => 'Usuario creado exitosamente.'], 201);
    }
    //Mostrar usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios, 200);
    }
    //Buscar usuarios
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario, 200);
    }
    // Actualizar usuario
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'id_empresa' => 'required|exists:Empresas,id_empresa',
                'nombreUsuario' => 'required|string|max:255',
                'apellidoPaterno' => 'required|string|max:255',
                'apellidoMaterno' => 'nullable|string|max:255',
                'telefonoUsuario' => 'required|string|max:20',
                'correoUsuario' => 'required|email|max:255|unique:Usuarios,correoUsuario,' . $id . ',id_usuario',
                'passwordUsuario' => 'nullable|string|max:255', // Hacer nullable para que no sea obligatorio
                'evaluacionUsuario' => 'nullable|integer|min:1|max:10',
                'curriculumUsuario' => 'nullable|string|max:255',
            ]);

            if (!empty($request->passwordUsuario)) {
                $validatedData['passwordUsuario'] = Hash::make($request->passwordUsuario); // Encriptar la contraseña si se proporciona
            }

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $usuario = Usuario::findOrFail($id);
            Log::info('Usuario encontrado.', ['usuario' => $usuario]);

            $usuario->update($validatedData);
            Log::info('Datos actualizados.', ['usuario' => $usuario]);

            return response()->json(['message' => 'Usuario actualizado correctamente.'], 200);

        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('Error al actualizar el usuario.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar el usuario.'], 500);
        }
    }

    //Metodo borrar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.'], 200);
    }
}
