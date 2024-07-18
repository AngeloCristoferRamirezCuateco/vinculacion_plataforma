<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacante;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class VacanteController extends Controller
{
    // Método para registrar una nueva vacante
    public function store(Request $request)
    {
        $request->validate([
            'id_empresa' => 'required|exists:Empresas,id_empresa',
            'proyectoDisponible' => 'required|string|max:255',
            'numeroVacantes' => 'required|integer|min:1',
            'datosVacante' => 'required|string|max:255',
            'estadoVacante' => 'required|string|max:255',
        ]);

        Vacante::create($request->all());

        return response()->json(['message' => 'Vacante creada exitosamente.'], 201);
    }

    // Método para listar todas las vacantes
    public function index()
    {
        $vacantes = Vacante::all();
        return response()->json($vacantes, 200);
    }

    // Método para mostrar una vacante específica
    public function show($id)
    {
        $vacante = Vacante::findOrFail($id);
        return response()->json($vacante, 200);
    }

    // Método para actualizar una vacante existente
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'id_empresa' => 'required|exists:Empresas,id_empresa',
                'proyectoDisponible' => 'required|string|max:255',
                'numeroVacantes' => 'required|integer|min:1',
                'datosVacante' => 'required|string|max:255',
                'estadoVacante' => 'required|string|max:255',
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $vacante = Vacante::findOrFail($id);
            Log::info('Vacante encontrada.', ['vacante' => $vacante]);

            $vacante->update($validatedData);
            Log::info('Datos actualizados.', ['vacante' => $vacante]);

            return response()->json(['message' => 'Vacante actualizada correctamente.'], 200);

        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('Error al actualizar la vacante.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar la vacante.'], 500);
        }
    }

    // Método para eliminar una vacante existente
    public function destroy($id)
    {
        $vacante = Vacante::findOrFail($id);
        $vacante->delete();

        return response()->json(['message' => 'Vacante eliminada correctamente.'], 200);
    }
}
