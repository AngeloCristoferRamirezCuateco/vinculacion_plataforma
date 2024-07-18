<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class ConvenioController extends Controller
{
    // Método para registrar un nuevo convenio
    public function store(Request $request)
    {
        $request->validate([
            'id_empresa_solicitante' => 'required|exists:Empresas,id_empresa',
            'id_empresa_provedor' => 'required|exists:Empresas,id_empresa',
            'fechaAcuerdo' => 'required|date',
        ]);

        Convenio::create($request->all());

        return response()->json(['message' => 'Convenio creado exitosamente.'], 201);
    }

    // Método para listar todos los convenios
    public function index()
    {
        $convenios = Convenio::all();
        return response()->json($convenios, 200);
    }

    // Método para mostrar un convenio específico
    public function show($id)
    {
        $convenio = Convenio::findOrFail($id);
        return response()->json($convenio, 200);
    }

    // Método para actualizar un convenio existente
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'id_empresa_solicitante' => 'required|exists:Empresas,id_empresa',
                'id_empresa_provedor' => 'required|exists:Empresas,id_empresa',
                'fechaAcuerdo' => 'required|date',
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $convenio = Convenio::findOrFail($id);
            Log::info('Convenio encontrado.', ['convenio' => $convenio]);

            $convenio->update($validatedData);
            Log::info('Datos actualizados.', ['convenio' => $convenio]);

            return response()->json(['message' => 'Convenio actualizado correctamente.'], 200);

        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('Error al actualizar el convenio.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar el convenio.'], 500);
        }
    }

    // Método para eliminar un convenio existente
    public function destroy($id)
    {
        $convenio = Convenio::findOrFail($id);
        $convenio->delete();

        return response()->json(['message' => 'Convenio eliminado correctamente.'], 200);
    }
}
