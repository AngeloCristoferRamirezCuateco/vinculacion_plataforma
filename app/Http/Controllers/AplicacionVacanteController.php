<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AplicacionVacante;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class AplicacionVacanteController extends Controller
{
    // Método para registrar una nueva aplicación de vacante
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:Usuarios,id_usuario',
            'id_vacante' => 'required|exists:Vacantes,id_vacante',
        ]);

        AplicacionVacante::create($request->all());

        return response()->json(['message' => 'Aplicación a vacante creada exitosamente.'], 201);
    }

    // Método para listar todas las aplicaciones de vacantes
    public function index()
    {
        $aplicaciones = AplicacionVacante::all();
        return response()->json($aplicaciones, 200);
    }

    // Método para mostrar una aplicación de vacante específica
    public function show($id)
    {
        $aplicacion = AplicacionVacante::findOrFail($id);
        return response()->json($aplicacion, 200);
    }

    // Método para actualizar una aplicación de vacante existente
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'id_usuario' => 'required|exists:Usuarios,id_usuario',
                'id_vacante' => 'required|exists:Vacantes,id_vacante',
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $aplicacion = AplicacionVacante::findOrFail($id);
            Log::info('Aplicación de vacante encontrada.', ['aplicacion' => $aplicacion]);

            $aplicacion->update($validatedData);
            Log::info('Datos actualizados.', ['aplicacion' => $aplicacion]);

            return response()->json(['message' => 'Aplicación de vacante actualizada correctamente.'], 200);

        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('Error al actualizar la aplicación de vacante.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar la aplicación de vacante.'], 500);
        }
    }

    // Método para eliminar una aplicación de vacante existente
    public function destroy($id)
    {
        $aplicacion = AplicacionVacante::findOrFail($id);
        $aplicacion->delete();

        return response()->json(['message' => 'Aplicación de vacante eliminada correctamente.'], 200);
    }
}
