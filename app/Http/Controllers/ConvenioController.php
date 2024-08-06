<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;
use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Solicitud;
use Illuminate\Support\Facades\DB;

class ConvenioController extends Controller
{
    // Método para registrar un nuevo convenio
    public function store(Request $request)
    {
        // Validación
        Log::info('Validación empezada');
        $request->validate([
            'idInstitucion' => 'required|exists:Empresas,id_empresa',
            'content' => 'required|string',
            'documento_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        Log::info('Validación completada');

        // Encontrar la empresa
        Log::info('Obteniendo la empresa seleccionada', ['idInstitucion' => $request->input('idInstitucion')]);
        $empresa = Empresa::find($request->input('idInstitucion'));
        Log::info('Empresa obtenida', ['empresa' => $empresa]);

        // Obtener el nombre del representante de la empresa
        $nombreRepresentante = $empresa->representanteEmpresa;
        Log::info('Nombre del representante de la empresa obtenido', ['representante' => $nombreRepresentante]);

        // Buscar el nombre del representante en la tabla Usuarios
        $remitente = Usuario::where(DB::raw("CONCAT(nombreUsuario, ' ', apellidoPaterno, ' ', apellidoMaterno)"), $nombreRepresentante)->first();
        Log::info('Usuario remitente obtenido', ['remitente' => $remitente]);

        // Verificar existencia de usuarios
        Log::info('Verificando existencia del usuario emisor');
        $emisorExists = Usuario::find(auth()->user()->id_usuario);
        if (!$emisorExists || !$remitente) {
            Log::error('El usuario emisor o remitente no existe', ['emisorExists' => $emisorExists, 'remitente' => $remitente]);
            return redirect()->back()->withErrors(['message' => 'El usuario emisor o remitente no existe.']);
        }
        Log::info('Existencia de usuarios verificada');

        // Guardar el documento PDF, si se ha subido
        $documentoPdf = null;
        if ($request->hasFile('documento_pdf')) {
            $documentoPdf = $request->file('documento_pdf')->store('solicitudes', 'public');
        }

        // Crear la solicitud
        $solicitud = new Solicitud();
        $solicitud->id_usuario_emisor = auth()->user()->id_usuario; // Asumiendo que el usuario está autenticado
        $solicitud->id_usuario_remitente = $remitente->id_usuario; // Remitente es el usuario asociado a la empresa
        $solicitud->documento_pdf = $documentoPdf;
        $solicitud->tipoSolicitud = 'convenio';
        $solicitud->estado = 'pendiente'; // Estado inicial
        $solicitud->save();

        return redirect()->back()->with('success', 'Solicitud enviada correctamente.');
    }


    // Método para listar todos los convenios
    public function index()
    {
        // Obtener todas las solicitudes
        $solicitudes = Solicitud::with('emisor', 'remitente')->get();

        // Pasar las solicitudes a la vista
        return view('dashboars.Representantes.solicitudes', compact('solicitudes'));
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
    public function destroy($id_solicitud)
    {
        $solicitud = Solicitud::findOrFail($id_solicitud);
        $solicitud->delete();

        return redirect()->back()->with('success', 'Solicitud eliminada exitosamente.');
    }

    public function createFromSolicitud($id)
    {
        // Encuentra la solicitud y crea un nuevo convenio
        $solicitud = Solicitud::findOrFail($id);

        $convenio = Convenio::create([
            'id_usuario_emisor' => $solicitud->id_usuario_emisor,
            'id_usuario_receptor' => $solicitud->id_usuario_remitente,
        ]);

        // Redirige a la vista de convenios con un mensaje de éxito
        return redirect()->route('convenios.show', $convenio->id_convenio)
            ->with('success', 'Convenio creado exitosamente.');
    }

    public function show($id)
    {
        // Lógica para mostrar un convenio específico
        $convenio = Convenio::with(['emisor', 'receptor'])->findOrFail($id);
        return view('convenios.show', compact('convenio'));
    }

    public function uploadDocument(Request $request, $id)
    {
        $convenio = Convenio::findOrFail($id);

        if ($request->hasFile('documento')) {
            $path = $request->file('documento')->store('convenios');

            if ($request->user()->id == $convenio->id_usuario_emisor) {
                $convenio->documento_emisor = $path;
            } else {
                $convenio->documento_receptor = $path;
            }

            $convenio->save();
        }

        return back()->with('success', 'Documento subido exitosamente.');
    }

    public function finalize($id)
    {
        $convenio = Convenio::findOrFail($id);
        $convenio->convenido = true;
        $convenio->save();

        return back()->with('success', 'Convenio concretado exitosamente.');
    }

    public function gestionConvenios()
    {
        Log::info('retornando vista');
        $convenios = Convenio::with(['emisor', 'receptor'])->get();
        return view('dashboars.Representantes.gestiondeconvenios', compact('convenios'));
    }

    public function aceptarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = 'Aceptado'; // Asegúrate de que 'estado' es el campo correcto
        $solicitud->save();

        return redirect()->route('convenios.index')->with('success', 'Solicitud aceptada con éxito.');
    }

    public function rechazarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = 'Rechazado'; // Asegúrate de que 'estado' es el campo correcto
        $solicitud->save();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud rechazada con éxito.');
    }

    public function eliminarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito.');
    }

}
