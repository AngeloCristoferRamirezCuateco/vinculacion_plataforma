<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioInstitucion;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UsuarioInstitucionController extends Controller
{
    public function create()
    {
        $instituciones = Institucion::all();
        $roles = [
            'abogados',
            'alumnos_institucion',
            'coordinador_academico',
            'director',
            'docentes_institucion',
            'funcionario_publico',
            'gerente',
            'rectores_institucion',
            'secretarias',
            'supervisor'
        ];
        return view('posts.createaccount', compact('instituciones', 'roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreUsuario' => 'required|max:100',
            'apellidoMaterno' => 'required|max:100',
            'apellidoPaterno' => 'required|max:100',
            'correoUsuario' => 'required|email|max:250|unique:usuarios_institucion',
            'passwordUsuario' => 'required|confirmed|min:8',
            'idInstitucion' => 'required|exists:instituciones,idInstitucion',
            'rolUsuario' => 'required|max:100',
        ]);

        // Verificar si es el primer usuario de la institución
        $isFirstUser = !UsuarioInstitucion::where('idInstitucion', $validatedData['idInstitucion'])->exists();

        $usuario = new UsuarioInstitucion;
        $usuario->nombreUsuario = $validatedData['nombreUsuario'];
        $usuario->apellidoMaterno = $validatedData['apellidoMaterno'];
        $usuario->apellidoPaterno = $validatedData['apellidoPaterno'];
        $usuario->correoUsuario = $validatedData['correoUsuario'];
        $usuario->passwordUsuario = Hash::make($validatedData['passwordUsuario']);
        $usuario->idInstitucion = $validatedData['idInstitucion'];
        $usuario->rolUsuario = $validatedData['rolUsuario'];
        $usuario->esAdmin = $isFirstUser ? 1 : 0; // Asignar esAdmin aquí

        // Asignar roles de moderador y representante si es el primer usuario
        if ($isFirstUser) {
            $usuario->rolUsuario = 'representantes'; // Representante
        }

        $usuario->fechaCreacionCuenta = now();
        $usuario->save();

        // Asegurarnos de que el idUsuario está disponible
        $usuario->refresh();

        // Insertar en la tabla específica según el rol
        $this->insertarEnTablaRolEspecifico($usuario);

        return redirect()->route('usuarios.create')->with('success', 'Usuario registrado exitosamente.');
    }

    private function insertarEnTablaRolEspecifico($usuario)
    {
        $tabla = null;

        switch ($usuario->rolUsuario) {
            case 'alumnos_institucion':
                $tabla = 'alumnos_institucion';
                break;
            case 'docentes_institucion':
                $tabla = 'docentes_institucion';
                break;
            case 'coordinador_academico':
                $tabla = 'coordinadores_academicos';
                break;
            case 'funcionario_publico':
                $tabla = 'funcionarios_publicos';
                break;
            case 'gerente':
                $tabla = 'gerentes';
                break;
            case 'rectores_institucion':
                $tabla = 'rectores_institucion';
                break;
            case 'secretarias':
                $tabla = 'secretarias';
                break;
            case 'supervisor':
                $tabla = 'supervisores';
                break;
            case 'abogados':
                $tabla = 'abogados';
                break;
            case 'director':
                $tabla = 'directores';
                break;
            case 'representantes':
                $tabla = 'representantes';
                break;
        }

        if ($tabla) {
            DB::table($tabla)->insert([
                'idUsuario' => $usuario->idUsuario,
                'idInstitucion' => $usuario->idInstitucion,
                'rolUsuario' => $usuario->rolUsuario,
                'esAdmin' => $usuario->esAdmin,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    public function checkRectorStatus(Request $request)
    {
        $idInstitucion = $request->query('idInstitucion');
        Log::info('Verificando estado del rector para la institución ID: ' . $idInstitucion);

        $rectorExists = UsuarioInstitucion::where('idInstitucion', $idInstitucion)
            ->where('rolUsuario', 'rectores_institucion')
            ->exists();

        Log::info('El rol de rector ' . ($rectorExists ? 'existe' : 'no existe'));

        return response()->json(['rector_exists' => $rectorExists]);
    }
}

