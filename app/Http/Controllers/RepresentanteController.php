<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use App\Models\Empresa;
use App\Models\Rol;
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
        Log::info('Id de usuario ->' . $userId);
        Log::info('Usuario -> ' . json_encode($user));
        return view('dashboars.Representantes.crearVacante', [
            'userId' => $userId,
            'user' => $user,
        ]);
    }

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

    public function Prueva(){
        return view('dashboars.Representantes.Prueva');
    }

    public function Prueva2(){
        return view('dashboars.Representantes.Prueba2');
    }
}
