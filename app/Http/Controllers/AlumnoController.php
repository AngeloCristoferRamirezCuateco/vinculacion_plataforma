<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\AplicacionVacante;


class AlumnoController extends Controller
{
    public function inicioAlumno()
    {
        $userId = Auth::id();
        $user = Auth::user();
        return view('dashboars.Alumnos.proyectos', [
            'userId' => $userId,
            'user' => $user
        ]);
    }
    public function solicitudesenviadas()
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
        return view('dashboars.Alumnos.solicitudesEnviadas', compact('solicitudes'));
    }

    public function alumnovacante()
    {
        $userId = Auth::id();
        $user = Auth::user();
        return view('dashboars.Alumnos.detallesdevacante', [
            'userId' => $userId,
            'user' => $user
        ]);
    }

    
    public function perfilUsuarioAlumno()
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
        return view('dashboars.Alumnos.Perfil', compact('user', 'userId', 'imageResponse', 'curriculumResponse', 'coverImageResponse'));
    }
}
