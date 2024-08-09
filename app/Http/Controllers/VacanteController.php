<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Vacante;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class VacanteController extends Controller
{
    // Método para registrar una nueva vacante
    public function store(Request $request)
    {
        // Obtener el ID de la empresa del usuario autenticado
        $id_empresa = Auth::user()->id_empresa;

        // Validar los datos del formulario
        $request->validate([
            'proyectoDisponible' => 'required|string|max:255',
            'numeroVacantes' => 'required|integer|min:2',
            'datosVacante' => 'required|string|max:255',
            'estadoVacante' => 'required|string|max:255',
        ]);
        Log::info('Validado');
        // Crear la vacante asociando el ID de la empresa
        Vacante::create([
            'id_empresa' => $id_empresa,
            'proyectoDisponible' => $request->proyectoDisponible,
            'numeroVacantes' => $request->numeroVacantes,
            'datosVacante' => $request->datosVacante,
            'estadoVacante' => $request->estadoVacante,
        ]);
        Log::info('Creado');
        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Vacante creada exitosamente.');
    }


    // Método para listar todas las vacantes
    public function index()
    {
        $vacantes = Vacante::with('empresa')->get();
        return view('dashboars.Alumnos.Vacantes', compact('vacantes'));
    }

    // Método para mostrar una vacante específica
    public function show($id)
    {
        $vacantes = Vacante::findOrFail($id);
    }

    // Método para actualizar una vacante existente
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'id_empresa' => 'nullable|exists:Empresas,id_empresa',
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

            //return response()->json(['message' => 'Vacante actualizada correctamente.'], 200);
            return redirect()->back();
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

        //return response()->json(['message' => 'Vacante eliminada correctamente.'], 200);
        return redirect()->back();
    }

    public function edit($id)
    {
        $vacante = Vacante::findOrFail($id);
        return view('dashboars.Representantes.edicionvacante', compact('vacante'));
    }
}
