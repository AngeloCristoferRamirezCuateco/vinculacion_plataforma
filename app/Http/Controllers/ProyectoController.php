<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProyectoController extends Controller
{
    // Método para registrar un nuevo proyecto
    public function store(Request $request)
    {
        $request->validate([
            'id_convenio' => 'required|exists:Convenios,id_convenio',
            'proposito' => 'required|string|max:255',
            'metas' => 'required|string|max:255',
            'alcance' => 'required|string|max:255',
            'participantes' => 'required|string|max:255',
        ]);

        Proyecto::create($request->all());

        return response()->json(['message' => 'Proyecto creado exitosamente.'], 201);
    }

    // Método para listar todos los proyectos
    public function index()
    {
        $proyectos = Proyecto::all();
        return response()->json($proyectos, 200);
    }

    // Método para mostrar un proyecto específico
    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return response()->json($proyecto, 200);
    }

    // Método para actualizar un proyecto existente
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'id_convenio' => 'required|exists:Convenios,id_convenio',
                'proposito' => 'required|string|max:255',
                'metas' => 'required|string|max:255',
                'alcance' => 'required|string|max:255',
                'participantes' => 'required|string|max:255',
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $proyecto = Proyecto::findOrFail($id);
            Log::info('Proyecto encontrado.', ['proyecto' => $proyecto]);

            $proyecto->update($validatedData);
            Log::info('Datos actualizados.', ['proyecto' => $proyecto]);

            return response()->json(['message' => 'Proyecto actualizado correctamente.'], 200);

        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('Error al actualizar el proyecto.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar el proyecto.'], 500);
        }
    }

    // Método para eliminar un proyecto existente
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return response()->json(['message' => 'Proyecto eliminado correctamente.'], 200);
    }
}
