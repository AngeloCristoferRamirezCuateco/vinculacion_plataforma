<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RolController extends Controller

{
    // Método para registrar un nuevo rol
    public function store(Request $request)
    {
        $request->validate([
            'nombreRol' => 'required|string|max:255',
            'rol' => 'required|integer|unique:Roles,rol', 
        ]);

        Rol::create($request->all());

        return response()->json(['message' => 'Rol creado exitosamente.'], 201);
    }

    // Método para listar todos los roles
    public function index()
    {
        $roles = Rol::all();
        return response()->json($roles, 200);
    }

    // Método para mostrar un rol específico
    public function show($id)
    {
        $rol = Rol::findOrFail($id);
        return response()->json($rol, 200);
    }

    // Método para actualizar un rol existente
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'nombreRol' => 'required|string|max:255',
                'rol' => 'required|integer|unique:Roles,rol,' . $id . ',id_rol', // Validar el nuevo campo rol
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $rol = Rol::findOrFail($id);
            Log::info('Rol encontrado.', ['rol' => $rol]);

            $rol->update($validatedData);
            Log::info('Datos actualizados.', ['rol' => $rol]);

            return response()->json(['message' => 'Rol actualizado correctamente.'], 200);

        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('Error al actualizar el rol.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar el rol.'], 500);
        }
    }

    // Método para eliminar un rol existente
    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();

        return response()->json(['message' => 'Rol eliminado correctamente.'], 200);
    }
}
