<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioRol;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UsuarioRolController extends Controller
{
    // Método para registrar una nueva relación usuario-rol
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:Usuarios,id_usuario',
            'id_rol' => 'required|exists:Roles,id_rol',
        ]);

        UsuarioRol::create($request->all());

        return response()->json(['message' => 'Relación usuario-rol creada exitosamente.'], 201);
    }

    // Método para listar todas las relaciones usuario-rol
    public function index()
    {
        $usuarioRoles = UsuarioRol::all();
        return response()->json($usuarioRoles, 200);
    }

    // Método para mostrar una relación usuario-rol específica
    public function show($id)
    {
        $usuarioRol = UsuarioRol::findOrFail($id);
        return response()->json($usuarioRol, 200);
    }

    // Método para actualizar una relación usuario-rol existente
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'id_usuario' => 'required|exists:Usuarios,id_usuario',
                'id_rol' => 'required|exists:Roles,id_rol',
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $usuarioRol = UsuarioRol::findOrFail($id);
            Log::info('Relación usuario-rol encontrada.', ['usuarioRol' => $usuarioRol]);

            $usuarioRol->update($validatedData);
            Log::info('Datos actualizados.', ['usuarioRol' => $usuarioRol]);

            return response()->json(['message' => 'Relación usuario-rol actualizada correctamente.'], 200);

        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('Error al actualizar la relación usuario-rol.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar la relación usuario-rol.'], 500);
        }
    }

    // Método para eliminar una relación usuario-rol existente
    public function destroy($id)
    {
        $usuarioRol = UsuarioRol::findOrFail($id);
        $usuarioRol->delete();

        return response()->json(['message' => 'Relación usuario-rol eliminada correctamente.'], 200);
    }
}
