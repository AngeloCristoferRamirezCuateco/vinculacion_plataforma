<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioInstitucion;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RepresentanteController extends Controller
{
    public function create(Request $request)
    {
        $idInstitucion = session('idInstitucion');
        if (!$idInstitucion) {
            return redirect()->route('instituciones.create')->with('error', 'Debe registrar una institución primero.');
        }else{
            $institucion = Institucion::findOrFail($idInstitucion);
        return view('representantes.create', compact('institucion'));
        }
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
        ]);

        $usuario = new UsuarioInstitucion;
        $usuario->nombreUsuario = $validatedData['nombreUsuario'];
        $usuario->apellidoMaterno = $validatedData['apellidoMaterno'];
        $usuario->apellidoPaterno = $validatedData['apellidoPaterno'];
        $usuario->correoUsuario = $validatedData['correoUsuario'];
        $usuario->passwordUsuario = Hash::make($validatedData['passwordUsuario']);
        $usuario->idInstitucion = $validatedData['idInstitucion'];
        $usuario->rolUsuario = 'representantes';
        $usuario->esAdmin = 1; // Asignar esAdmin al representante

        $usuario->fechaCreacionCuenta = now();
        $usuario->save();

        // Asegurarnos de que el idUsuario está disponible
        $usuario->refresh();

        // Insertar en la tabla específica de representantes
        DB::table('representantes')->insert([
            'idUsuario' => $usuario->idUsuario,
            'idInstitucion' => $usuario->idInstitucion,
            'rolUsuario' => $usuario->rolUsuario,
            'esAdmin' => $usuario->esAdmin,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('verifymail1')->with('success', 'Representante registrado exitosamente.');
    }
}
