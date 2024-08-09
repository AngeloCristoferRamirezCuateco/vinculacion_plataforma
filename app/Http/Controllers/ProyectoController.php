<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProyectoController extends Controller
{
    // Método para registrar un nuevo proyecto
    public function store(Request $request)
    {
        // Registrar los datos de la solicitud
        Log::info('Datos de la solicitud:', $request->all());

        // Validación de los campos de la solicitud
        $request->validate([
            
            'proposito' => 'required|string|max:255',
            'metas' => 'required|string|max:255',
            'alcance' => 'required|string|max:255',
            'nombre_proyecto' => 'required|string|max:255',
            'participantes' => 'nullable|string',
        ]);
        Log::info('Datos validados');

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Registrar el usuario autenticado
        Log::info('Usuario autenticado:', ['id_usuario' => $user->id_usuario, 'id_empresa' => $user->id_empresa]);

        // Asignar la empresa de pertenencia a partir del usuario autenticado
        $empresa_pertenencia = $user->id_empresa;

        // // Verificar que la empresa de pertenencia sea la misma que la del representante
        // if ($empresa_pertenencia != $request->empresa_pertenencia) {
        //     Log::warning('La empresa de pertenencia no coincide con la del representante.', [
        //         'empresa_pertenencia' => $request->empresa_pertenencia,
        //         'usuario_empresa' => $user->id_empresa
        //     ]);
        //     return redirect()->back()->with('error', 'La empresa de pertenencia debe ser la misma que la del representante.');
        // }

        try {
            $empresa_pertenencia = Auth::user()->id_empresa;
            // Crear el proyecto con los datos de la solicitud
            $proyecto = Proyecto::create([
                'convenio_id' => $request->convenio_id,
                'empresa_pertenencia' => $empresa_pertenencia, // Usar la empresa del usuario autenticado
                'proposito' => $request->proposito,
                'metas' => $request->metas,
                'alcance' => $request->alcance,
                'nombre_proyecto' => $request->nombre_proyecto,
                'participantes' => $request->participantes,
            ]);

            // Registrar éxito en la creación del proyecto
            Log::info('Proyecto creado con éxito:', ['id_proyecto' => $proyecto->id_proyecto]);

            // Redirigir a la vista de proyectos con un mensaje de éxito
            return redirect()->route('proyectos.index')->with('success', 'Proyecto creado con éxito.');
        } catch (\Exception $e) {
            // Registrar cualquier excepción que ocurra
            Log::error('Error al crear proyecto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear el proyecto. Por favor, intenta de nuevo.');
        }
    }



    //Método para regresar una vista
    public function proyectoscrear()
    {
        return view('dashboars.Representantes.crearProyectos');
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
                'id_convenio' => 'nullable|exists:Convenios,id_convenio',
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

        //return response()->json(['message' => 'Proyecto eliminado correctamente.'], 200);
        //return redirect()->back();
        return redirect()->route('proyectos.lista');
    }
}
