<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;
use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\Notificacion_solicitud;
use Illuminate\Support\Facades\Auth;

class ConvenioController extends Controller
{
    // Método para registrar un nuevo convenio
    public function store(Request $request)
    {
        try {
            // Validación
            Log::info('Validación empezada');
            $validatedData = $request->validate([
                'idInstitucion' => 'required|exists:Empresas,id_empresa',
                'content' => 'nullable|string',
                'documento_pdf' => 'nullable|file|mimes:pdf|max:2048',
            ]);
            Log::info('Validación completada');

            // Encontrar la empresa
            Log::info('Obteniendo la empresa seleccionada', ['idInstitucion' => $validatedData['idInstitucion']]);
            $empresa = Empresa::findOrFail($validatedData['idInstitucion']);
            Log::info('Empresa obtenida', ['empresa' => $empresa]);

            // Obtener el nombre del representante de la empresa
            $nombreRepresentante = $empresa->representanteEmpresa;
            Log::info('Nombre del representante de la empresa obtenido', ['representante' => $nombreRepresentante]);

            // Buscar el nombre del representante en la tabla Usuarios
            $remitente = Usuario::where(DB::raw("CONCAT(nombreUsuario, ' ', apellidoPaterno, ' ', apellidoMaterno)"), $nombreRepresentante)->first();
            if (!$remitente) {
                Log::error('No se encontró el usuario remitente', ['representante' => $nombreRepresentante]);
                return redirect()->back()->withErrors(['message' => 'El usuario remitente no existe.']);
            }
            Log::info('Usuario remitente obtenido', ['remitente' => $remitente]);

            // Verificar existencia de usuario emisor
            $emisor = auth()->user();
            if (!$emisor) {
                Log::error('El usuario emisor no existe');
                return redirect()->back()->withErrors(['message' => 'El usuario emisor no existe.']);
            }
            Log::info('Usuario emisor obtenido', ['emisor' => $emisor]);

            // Guardar el documento PDF, si se ha subido
            $documentoPdf = null;
            if ($request->hasFile('documento_pdf')) {
                $documentoPdf = $request->file('documento_pdf')->store('solicitudes', 'public');
                Log::info('Documento PDF guardado', ['documento_pdf' => $documentoPdf]);
            }

            // Crear la solicitud
            $solicitud = new Solicitud();
            $solicitud->id_usuario_emisor = $emisor->id_usuario;
            $solicitud->id_usuario_remitente = $remitente->id_usuario;
            $solicitud->documento_pdf = $documentoPdf;
            $solicitud->tipoSolicitud = 'convenio';
            $solicitud->estado = 'pendiente';
            $solicitud->save();
            Log::info('Solicitud creada', ['solicitud' => $solicitud]);


            // Enviar correo
            $empresaSolicitante = $empresa->nombreEmpresa;
            $nombreDestinatario = $remitente->nombreUsuario . ' ' . $remitente->apellidoPaterno . ' ' . $remitente->apellidoMaterno;
            Mail::to($remitente->correoUsuario)->send(new Notificacion_solicitud($empresaSolicitante, $nombreDestinatario));
            Log::info('Correo enviado', ['email' => $remitente->email]);

            return redirect()->back()->with('success', 'Solicitud enviada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al enviar la solicitud', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['message' => 'Ocurrió un error al enviar la solicitud.']);
        }
    }


    // Método para listar todos las solicitudes
    public function index()
    {
        // Obtener el usuario autenticado
        $usuario = Auth()->user();
        $usuarioId = $usuario->id_usuario;

        // Obtener las solicitudes donde el usuario autenticado es el remitente y no han sido eliminadas por el remitente
        $solicitudes = Solicitud::with('emisor', 'remitente')
            ->where('id_usuario_remitente', $usuarioId)
            ->where('deleted_by_remitente', false)
            ->get();

        // Pasar las solicitudes a la vista
        return view('dashboars.Representantes.solicitudes', compact('solicitudes'));
    }


    public function SolcitudesEnviadas()
    {

        $usuario = Auth()->user();
        $usuarioId = $usuario->id_usuario;

        $solicitudes = Solicitud::with('emisor', 'remitente')
            ->where('id_usuario_emisor', $usuarioId)
            ->get();

        return view('dashboars.Representantes.solicitudesRecibidas', compact('solicitudes'));
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



    public function gestionConvenios()
    {
        $usuario = Auth()->user();
        $usuarioId = $usuario->id_usuario;

        Log::info('retornando vista');
        $convenios = Convenio::with(['emisor', 'receptor'])->get();
        return view('dashboars.Representantes.gestiondeconvenios', compact('convenios'));
    }

    public function aceptarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->estado === 'pendiente') {
            $solicitud->estado = 'aceptado';
            $solicitud->save();

            // Crear un nuevo convenio basado en la solicitud aceptada
            $convenio = Convenio::create([
                'id_usuario_emisor' => $solicitud->id_usuario_emisor,
                'id_usuario_receptor' => $solicitud->id_usuario_remitente,
                'estado' => 'pendiente',
                'notas' => 'Convenio creado a partir de la solicitud aceptada.'
            ]);

            return redirect()->route('convenios.index')->with('success', 'Solicitud aceptada y convenio creado con éxito.');
        }

        return redirect()->route('convenios.index')->with('error', 'La solicitud ya ha sido aceptada o no está en estado pendiente.');
    }


    public function rechazarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = 'Rechazado';
        $solicitud->save();

        return redirect()->route('convenios.index')->with('success', 'Solicitud rechazada con éxito.');
    }

    public function eliminarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();
        return redirect()->route('convenios.index')->with('success', 'Solicitud eliminada con éxito.');
    }

    public function deleteByRemitente($id)
    {
        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return redirect()->route('convenios.index')->with('error', 'Solicitud no encontrada.');
        }

        if ($solicitud->id_usuario_remitente == Auth::user()->id_usuario) {
            $solicitud->deleted_by_remitente = true;
            $solicitud->save();
            return redirect()->route('convenios.index')->with('success', 'Solicitud eliminada con éxito.');
        }

        return redirect()->route('convenios.index')->with('error', 'No estás autorizado para eliminar esta solicitud.');
    }
}
