<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class EmpresaController extends Controller
{
    /*Declaramos una funcion llamada index, esta funcion sera similar a la funcion del archivo
    web.php, en este caso se sigue la misma metodologia, se declara una funcion sin parametros
    que retornara la vista que se encuentra en la carpeta empresas*/
    public function inicio(){
        return view('empresas.index');
        //return response()->json(['csrf_token' => csrf_token()], 200);
    }

    //Function to register company
    // Método para registrar una nueva empresa
    public function register(Request $request)
{
    Log::info('Inicio del registro de empresa y representante.', ['request' => $request->all()]);

    try {
        $validatedData = $request->validate([
            'nombreEmpresa' => 'required|string|max:255',
            'tipoEmpresa' => 'required|string|max:255',
            'fechaCreacion' => 'required|date',
            'areaEmpresa' => 'required|string|max:255',
            'correoEmpresa' => 'required|string|email|max:255|unique:empresas,correoEmpresa',
            'passwordEmpresa' => 'required|string|min:8|max:255',
            'rfcEmpresa' => 'required|string|max:13',
            'evaluacionEmpresa' => 'nullable|integer|min:1|max:10', // Hacer nullable para permitir valores por defecto
            'direccionEmpresa' => 'required|string|max:255',
            'nombreRepresentante' => 'required|string|max:255',
            'apellidoPaternoRepresentante' => 'required|string|max:255',
            'apellidoMaternoRepresentante' => 'nullable|string|max:255',
            'correoRepresentante' => 'required|string|email|max:255|unique:usuarios,correoUsuario',
            'passwordRepresentante' => 'required|string|min:8|max:255',
            'telefonoRepresentante' => 'required|string|max:20',
            'evaluacionUsuario' => 'nullable|integer|min:1|max:10', // Agregar campo de evaluación del usuario
            'curriculumUsuario' => 'nullable|string|max:255', // Agregar campo de curriculum del usuario
        ]);

        Log::info('Datos validados correctamente.', ['validatedData' => $validatedData]);

        // Establecer valores predeterminados si no se proporcionan
        if (!$request->filled('evaluacionEmpresa')) {
            $validatedData['evaluacionEmpresa'] = 0; // Valor predeterminado para empresa
        }
        if (!$request->filled('evaluacionUsuario')) {
            $validatedData['evaluacionUsuario'] = 1; // Valor predeterminado para usuario
        }
        if (!$request->filled('curriculumUsuario')) {
            $validatedData['curriculumUsuario'] = ''; // Valor predeterminado para curriculum
        }

        // Encriptar las contraseñas
        $validatedData['passwordEmpresa'] = Hash::make($validatedData['passwordEmpresa']);
        $validatedData['passwordRepresentante'] = Hash::make($validatedData['passwordRepresentante']);

        Log::info('Contraseñas encriptadas.');

        // Crear empresa
        $empresa = Empresa::create([
            'nombreEmpresa' => $validatedData['nombreEmpresa'],
            'tipoEmpresa' => $validatedData['tipoEmpresa'],
            'fechaCreacion' => $validatedData['fechaCreacion'],
            'areaEmpresa' => $validatedData['areaEmpresa'],
            'correoEmpresa' => $validatedData['correoEmpresa'],
            'passwordEmpresa' => $validatedData['passwordEmpresa'],
            'rfcEmpresa' => $validatedData['rfcEmpresa'],
            'evaluacionEmpresa' => $validatedData['evaluacionEmpresa'],
            'direccionEmpresa' => $validatedData['direccionEmpresa'],
            'representanteEmpresa' => $validatedData['nombreRepresentante'] . ' ' . $validatedData['apellidoPaternoRepresentante'] . ' ' . $validatedData['apellidoMaternoRepresentante'],
        ]);

        Log::info('Empresa creada correctamente.', ['empresa' => $empresa]);

        // Crear representante como usuario
        $representante = Usuario::create([
            'nombreUsuario' => $validatedData['nombreRepresentante'],
            'apellidoPaterno' => $validatedData['apellidoPaternoRepresentante'],
            'apellidoMaterno' => $validatedData['apellidoMaternoRepresentante'],
            'correoUsuario' => $validatedData['correoRepresentante'],
            'passwordUsuario' => $validatedData['passwordRepresentante'],
            'telefonoUsuario' => $validatedData['telefonoRepresentante'],
            'id_empresa' => $empresa->id_empresa,
            'evaluacionUsuario' => $validatedData['evaluacionUsuario'], // Agregar campo de evaluación del usuario
            'curriculumUsuario' => $validatedData['curriculumUsuario'], // Agregar campo de curriculum del usuario
        ]);

        Log::info('Representante creado como usuario correctamente.', ['representante' => $representante]);

        // Asignar rol de "Representante" (ID: 3)
        UsuarioRol::create([
            'id_usuario' => $representante->id_usuario,
            'id_rol' => 3, // Forzar el rol a "Representante"
        ]);

        Log::info('Rol asignado correctamente.', ['id_usuario' => $representante->id_usuario, 'id_rol' => 3]);

        //return response()->json(['message' => 'Empresa y representante creados exitosamente.'], 201);
        return redirect()->route('admin.panelregisterempresa');
    } catch (ValidationException $e) {
        Log::error('Error de validación.', ['errors' => $e->errors()]);
        return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        Log::error('Error durante el registro de la empresa.', ['exception' => $e->getMessage()]);
        return response()->json(['message' => 'Error durante el registro de la empresa.'], 500);
    }
}

    


    //Método para mostrar todas las empresas
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
                // 'fechaCreacion' => 'required|date',
                'areaEmpresa' => 'required|string|max:255',
                //'representanteEmpresa' => 'required|string|max:255',
                'direccionEmpresa' => 'required|string|max:255',
                'correoEmpresa' => 'required|string|max:255',
                // 'passwordEmpresa' => 'required|string|max:255',
                'rfcEmpresa' => 'required|string|max:13',
                'evaluacionEmpresa' => 'nullable|integer|min:1|max:11',
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $empresa = Empresa::findOrFail($id);
            Log::info('Empresa encontrada.', ['empresa' => $empresa]);

            $empresa->update($validatedData);
            Log::info('Datos actualizados.', ['empresa' => $empresa]);

            //return response()->json(['message' => 'Empresa actualizada correctamente.'], 200);
            return redirect()->route('admin.paneleditEmpresas');

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

