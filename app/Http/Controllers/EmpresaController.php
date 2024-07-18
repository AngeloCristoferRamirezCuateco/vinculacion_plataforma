<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class EmpresaController extends Controller
{
    /*Declaramos una funcion llamada index, esta funcion sera similar a la funcion del archivo
    web.php, en este caso se sigue la misma metodologia, se declara una funcion sin parametros
    que retornara la vista que se encuentra en la carpeta empresas*/
    // public function index(){
    //     return view('empresas.index');
    // }

    //Function to register company
    // Método para registrar una nueva empresa
    public function register(Request $request)
    {
        $request->validate([
            'nombreEmpresa' => 'required|string|max:255',
            'tipoEmpresa' => 'required|string|max:255',
            'fechaCreacion' => 'required|date',
            'areaEmpresa' => 'required|string|max:255',
            'representanteEmpresa' => 'required|string|max:255',
            'direccionEmpresa' => 'required|string|max:255',
            'rfcEmpresa' => 'required|string|max:13',
            'evaluacionEmpresa' => 'required|integer|min:1|max:10',
        ]);

        Empresa::create($request->all());

        return response()->json(['message' => 'Empresa creada exitosamente.'], 201);
    }

    // Método para mostrar todas las empresas
    public function index()
    {
        $empresas = Empresa::all();
        //return response()->json(['csrf_token' => csrf_token()], 200);
        return response()->json($empresas, 200);
    }

    // Método para actualizar una empresa existente
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'nombreEmpresa' => 'required|string|max:255',
                'tipoEmpresa' => 'required|string|max:255',
                'fechaCreacion' => 'required|date',
                'areaEmpresa' => 'required|string|max:255',
                'representanteEmpresa' => 'required|string|max:255',
                'direccionEmpresa' => 'required|string|max:255',
                'rfcEmpresa' => 'required|string|max:13',
                'evaluacionEmpresa' => 'nullable|integer|min:1|max:10',
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $empresa = Empresa::findOrFail($id);
            Log::info('Empresa encontrada.', ['empresa' => $empresa]);

            $empresa->update($validatedData);
            Log::info('Datos actualizados.', ['empresa' => $empresa]);

            return response()->json(['message' => 'Empresa actualizada correctamente.'], 200);

        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('Error al actualizar la empresa.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar la empresa.'], 500);
        }
    }

    // Método para eliminar una empresa existente
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();

        return response()->json(['message' => 'Empresa eliminada correctamente.'], 200);
    }

    // Método para mostrar una empresa específica
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return response()->json($empresa, 200);
    }

    // Métodos para crear y editar que devuelven texto por ahora
    public function create()
    {
        return response()->json(['message' => 'Formulario de creación de empresa.'], 200);
    }

    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);
        return response()->json(['message' => 'Formulario de edición de empresa.', 'empresa' => $empresa], 200);
    }
}

