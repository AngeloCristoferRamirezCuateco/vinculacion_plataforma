<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use App\Models\Empresa;
use App\Models\AplicacionVacante;
use App\Models\Rol;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class RepresentanteController extends Controller
{
    public function panelInicio()
    {
        $userId = Auth::id();
        $user = Auth::user();
        $Rol = Rol::all();
        Log::info('Id de usuario ->' . $userId);
        Log::info('Usuario -> ' . json_encode($user));
        if (!$user) {
            Log::info('sin usuario');
        }
        return view('dashboars.Representantes.dashboardRepresentantes', [
            'userId' => $userId,
            'user' => $user,
            'Rol' => $Rol
        ]);
    }





    public function panelConvenios()
    {
        $userId = Auth::id();
        $user = Auth::user();
        $empresas = Empresa::all();
        Log::info('Id de usuario ->' . $userId);
        Log::info('Usuario -> ' . json_encode($user));
        return view('dashboars.Representantes.crearConvenio', [
            'userId' => $userId,
            'user' => $user,
            'empresas' => $empresas
        ]);
    }

    public function panelVacantes()
    {
        $userId = Auth::id();
        $user = Auth::user();
        $empresas = Empresa::all();
        $empresaId = $user->id_empresa;
        $proyectos = Proyecto::where('empresa_pertenencia', $empresaId)->get();
        return view('dashboars.Representantes.crearVacantes', [
            'userId' => $userId,
            'user' => $user,
            'proyectos' => $proyectos,
            'empresas' => $empresas
        ]);
    }

    public function panelDocente()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todas las empresas
        $empresas = Empresa::all();

        // Obtener los usuarios que tienen el rol de docente
        $docenteRoleId = 2; // Ajusta esto si el ID del rol de docente es diferente
        $docentes = Usuario::whereHas('roles', function ($query) use ($docenteRoleId) {
            $query->where('id_rol', $docenteRoleId);
        })->where('id_empresa', $user->id_empresa)->get();

        // Obtener el ID de la empresa del usuario autenticado
        $empresaId = $user->id_empresa;

        // Obtener los proyectos que pertenezcan a la empresa del usuario
        $proyectos = Proyecto::where('empresa_pertenencia', $empresaId)->get();

        // Pasar los datos a la vista
        return view('dashboars.Representantes.crearVacantes', [
            'userId' => $userId,
            'user' => $user,
            'proyectos' => $proyectos,
            'empresas' => $empresas,
            'docentes' => $docentes
        ]);
    }

    public function panelDocentess()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todas las empresas
        $usuarioempresas = Auth::user();

        // Obtener los usuarios que tienen el rol de docente
        $docenteRoleId = 2; // Ajusta esto si el ID del rol de docente es diferente
        $docentes = Usuario::whereHas('roles', function ($query) use ($docenteRoleId) {
            $query->where('id_rol', $docenteRoleId);
        })->where('id_empresa', $user->id_empresa)->get();

        // Obtener el ID de la empresa del usuario autenticado
        $empresaId = $user->id_empresa;

        // Obtener los proyectos que pertenezcan a la empresa del usuario
        $proyectos = Proyecto::where('empresa_pertenencia', $empresaId)->get();

        // Pasar los datos a la vista
        return view('dashboars.Representantes.crearVacantes', [
            'userId' => $userId,
            'user' => $user,
            'proyectos' => $proyectos,
            'empresas' => $usuarioempresas,
            'docentes' => $docentes
        ]);
    }

    // 

    public function panelListaAlumnos(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();

        $empresaId = $user->id_empresa;

        Log::info('Buscando alumnos');
        Log::info('Empresa de procedencia: ' . $empresaId);

        $usuarios = Usuario::where('id_empresa', $empresaId)->get();

        $alumnoRoleId = 1;

        $alumnoUserIds = UsuarioRol::where('id_rol', $alumnoRoleId)
            ->pluck('id_usuario');

        $alumnos = $usuarios->whereIn('id_usuario', $alumnoUserIds);

        Log::info('Número de alumnos encontrados: ' . $alumnos->count());
        Log::info('Alumnos IDs: ' . $alumnos->pluck('id_usuario')->toJson());

        return view('dashboars.Representantes.listaAlumnos', [
            'alumnos' => $alumnos,
            'user' => $user,
            'userId' => $userId
        ]);
    }

    public function panelListaDocentes(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();

        $empresaId = $user->id_empresa;

        Log::info('Buscando docentes');
        Log::info('Empresa de procedencia: ' . $empresaId);

        $usuarios = Usuario::where('id_empresa', $empresaId)->get();

        $docenteRoleId = 2;
        $docenteUserIds = UsuarioRol::where('id_rol', $docenteRoleId)
            ->pluck('id_usuario');

        $docentes = $usuarios->whereIn('id_usuario', $docenteUserIds);

        Log::info('Número de docentes encontrados: ' . $docentes->count());
        Log::info('Docentes IDs: ' . $docentes->pluck('id_usuario')->toJson());

        return view('dashboars.Representantes.listaDocentes', [
            'docentes' => $docentes,
            'user' => $user,
            'userId' => $userId
        ]);
    }

    public function panelDocumentos()
    {
        return view('dashboars.Representantes.Documentos');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $empresaId = $user->id_empresa;

        // Total de usuarios en la empresa
        $totalUsuarios = Usuario::where('id_empresa', $empresaId)->count();

        // Total de empresas (opcional si es necesario)
        $totalEmpresas = Empresa::count();

        // Usuarios por rol en la empresa
        $usuariosPorRol = UsuarioRol::select('id_rol', DB::raw('count(*) as total'))
            ->whereIn('id_usuario', function ($query) use ($empresaId) {
                $query->select('id_usuario')
                    ->from('Usuarios')
                    ->where('id_empresa', $empresaId);
            })
            ->groupBy('id_rol')
            ->get();

        // Crecimiento de usuarios por mes en la empresa
        $usuariosPorMes = Usuario::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total'))
            ->where('id_empresa', $empresaId)
            ->groupBy('year', 'month')
            ->orderBy('year', 'month')
            ->get();

        return view('dashboars.Representantes.data', [
            'totalUsuarios' => $totalUsuarios,
            'totalEmpresas' => $totalEmpresas,
            'usuariosPorRol' => $usuariosPorRol,
            'usuariosPorMes' => $usuariosPorMes,
        ]);
    }

    public function editarAlumno($id)
    {

        $empresas = Empresa::all();
        $roles = Rol::all();
        $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
        $user = Auth::user();
        return view('dashboars.Representantes.editarAlumnos', [
            'usuario' => $usuario,
            'empresas' => $empresas,
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function editarDocente($id)
    {

        $empresas = Empresa::all();
        $roles = Rol::all();
        $usuario = Usuario::where('id_usuario', $id)->firstOrFail();
        $user = Auth::user();
        return view('dashboars.Representantes.editarDocentes', [
            'usuario' => $usuario,
            'empresas' => $empresas,
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function perfilUsuario()
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Obtén el objeto del usuario autenticado
        $user = Auth::user();

        // Inicializar las variables de respuesta
        $imageResponse = null;
        $curriculumResponse = null;
        $coverImageResponse = null;

        // Obtener la ruta de la imagen de perfil del usuario (campo foto1)
        $profileImagePath = $user->foto1;

        // Verifica si la ruta de la imagen de perfil no es null y no está vacía
        if (!is_null($profileImagePath) && !empty($profileImagePath) && Storage::exists($profileImagePath)) {
            // Obtén el contenido de la imagen
            $profileImage = Storage::get($profileImagePath);

            // Obtén el tamaño de la imagen en bytes
            $imageSize = Storage::size($profileImagePath);

            // Convierte el tamaño de bytes a kilobytes
            $imageSizeKb = $imageSize / 1024;

            // Registra el tamaño de la imagen en los logs
            Log::info('Tamaño de la imagen de perfil: ' . number_format($imageSizeKb, 2) . ' KB');

            // Crea la respuesta de la imagen
            $imageResponse = $profileImage;
        } else {
            Log::warning('La imagen de perfil no se encontró para el usuario con ID ' . $userId);
        }

        // Obtener la ruta del currículum del usuario (campo curriculumUsuario)
        $curriculumPath = $user->curriculumUsuario;

        // Verifica si la ruta del currículum no es null y no está vacía
        if (!is_null($curriculumPath) && !empty($curriculumPath) && Storage::exists($curriculumPath)) {
            // Obtén el contenido del currículum
            $curriculum = Storage::get($curriculumPath);

            // Obtén el tamaño del currículum en bytes
            $curriculumSize = Storage::size($curriculumPath);

            // Convierte el tamaño de bytes a kilobytes
            $curriculumSizeKb = $curriculumSize / 1024;

            // Registra el tamaño del currículum en los logs
            Log::info('Tamaño del currículum: ' . number_format($curriculumSizeKb, 2) . ' KB');

            // Crea la respuesta del currículum
            $curriculumResponse = $curriculum;
        } else {
            Log::warning('El currículum no se encontró para el usuario con ID ' . $userId);
        }

        // Obtener la ruta de la imagen de portada del usuario (campo foto2)
        $coverImagePath = $user->foto2;

        // Verifica si la ruta de la imagen de portada no es null y no está vacía
        if (!is_null($coverImagePath) && !empty($coverImagePath) && Storage::exists($coverImagePath)) {
            // Obtén el contenido de la imagen de portada
            $coverImage = Storage::get($coverImagePath);

            // Obtén el tamaño de la imagen de portada en bytes
            $coverImageSize = Storage::size($coverImagePath);

            // Convierte el tamaño de bytes a kilobytes
            $coverImageSizeKb = $coverImageSize / 1024;

            // Registra el tamaño de la imagen de portada en los logs
            Log::info('Tamaño de la imagen de portada: ' . number_format($coverImageSizeKb, 2) . ' KB');

            // Crea la respuesta de la imagen de portada
            $coverImageResponse = $coverImage;
        } else {
            Log::warning('La imagen de portada no se encontró para el usuario con ID ' . $userId);
        }

        // Pasa los datos del usuario, la imagen de perfil, la imagen de portada y el currículum a la vista
        return view('dashboars.Representantes.Perfil', compact('user', 'userId', 'imageResponse', 'curriculumResponse', 'coverImageResponse'));
    }

    public function Prueva()
    {
        return view('dashboars.Representantes.Prueva');
    }

    public function Prueva2()
    {
        return view('dashboars.Representantes.Prueba2');
    }

    public function lista()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Filtrar los proyectos que pertenecen a la misma empresa que el usuario autenticado
        $proyectos = Proyecto::where('empresa_pertenencia', $usuario->id_empresa)->get();

        // Pasar los proyectos a la vista
        return view('dashboars\Representantes\registrosdeproyectos', compact('proyectos'));
    }

    public function asignardocentesrep()
    {
        // Obtener el ID de la empresa del usuario autenticado
        $empresaId = Auth::user()->id_empresa;

        // ID del rol de docente
        $docenteRoleId = 2;

        // ID del rol de alumno
        $alumnoRoleId = 1;

        // Obtener los usuarios de la empresa
        $usuarios = Usuario::where('id_empresa', $empresaId)->get();

        // Obtener IDs de los docentes
        $docenteUserIds = UsuarioRol::where('id_rol', $docenteRoleId)
            ->pluck('id_usuario');

        // Filtrar los docentes entre los usuarios de la empresa
        $docentes = $usuarios->whereIn('id_usuario', $docenteUserIds);

        // Obtener IDs de los alumnos
        $alumnoUserIds = UsuarioRol::where('id_rol', $alumnoRoleId)
            ->pluck('id_usuario');

        // Filtrar los alumnos entre los usuarios de la empresa
        $alumnos = $usuarios->whereIn('id_usuario', $alumnoUserIds);

        // Si necesitas obtener los proyectos en los que los alumnos están trabajando, haz una consulta adicional
        // Esto depende de cómo estén relacionadas las tablas de proyectos y alumnos

        return view('dashboars.Representantes.asignarDocente', compact('docentes', 'alumnos'));
    }




    public function verSolicitudes()
    {
        // Obtener el ID de la empresa del usuario autenticado
        $id_empresa = Auth::user()->id_empresa;

        // Obtener las solicitudes de vacantes asociadas a la empresa del representante
        $solicitudes = AplicacionVacante::with('usuario', 'vacante')
            ->whereHas('vacante', function ($query) use ($id_empresa) {
                $query->where('id_empresa', $id_empresa);
            })
            ->get();

        // Retornar la vista con las solicitudes
        return view('dashboars.Representantes.solicitudesUsuarios', compact('solicitudes'));
    }

    public function aceptarSolicitud($id)
    {
        $solicitud = AplicacionVacante::findOrFail($id);
        $solicitud->estadoSolicitud = 'Aceptada';
        $solicitud->save();

        return redirect()->back()->with('success', 'Solicitud aceptada correctamente.');
    }

    public function rechazarSolicitud(Request $request, $id)
    {
        $solicitud = AplicacionVacante::findOrFail($id);
        $solicitud->estadoSolicitud = 'Rechazada';
        $solicitud->save();

        // Otras acciones como registrar el motivo de rechazo, si es necesario
        return redirect()->back()->with('success', 'Solicitud rechazada correctamente.');
    }

    public function guardarAsignacion(Request $request)
    {
        // Log para verificar los datos recibidos
        Log::info('Datos recibidos para la asignación:', ['request_data' => $request->all()]);

        // Validación de los datos
        try {
            $request->validate([
                'docente_id' => 'required|exists:usuarios,id_usuario',
                'alumnos_ids' => 'required|array',
                'alumnos_ids.*' => 'exists:usuarios,id_usuario',
            ]);

            // Log para confirmar que la validación se realizó correctamente
            Log::info('Validación exitosa:', ['validated_data' => $request->all()]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log para capturar cualquier error de validación
            Log::error('Error de validación:', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $docenteId = $request->input('docente_id');
        $alumnosIds = $request->input('alumnos_ids');

        // Log para verificar los datos después de la validación
        Log::info('Datos después de la validación:', ['docente_id' => $docenteId, 'alumnos_ids' => $alumnosIds]);

        // Aquí se asocia el docente con los alumnos seleccionados
        try {
            foreach ($alumnosIds as $alumnoId) {
                DB::table('docente_alumno')->insert([
                    'docente_id' => $docenteId,
                    'alumno_id' => $alumnoId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                // Log para confirmar la inserción de cada relación
                Log::info('Relación guardada:', ['docente_id' => $docenteId, 'alumno_id' => $alumnoId]);
            }

            // Log para confirmar que todas las inserciones se realizaron correctamente
            Log::info('Todas las asignaciones fueron guardadas correctamente.');
        } catch (\Exception $e) {
            // Log para capturar cualquier error durante la inserción
            Log::error('Error al guardar la asignación:', ['exception' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Hubo un problema al guardar la asignación.')->withInput();
        }

        return redirect()->back()->with('success', 'Asignación guardada correctamente.');
    }
}
