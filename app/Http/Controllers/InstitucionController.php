<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;

class InstitucionController extends Controller
{
    public function create()
    {
        return view('posts.registerrepmember');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreInstitucion' => 'required|max:250',
            'tipoInstitucion' => 'required|max:50',
            'disposicionInstitucion' => 'required|max:50',
            'telefonoInstitucion' => 'required|max:15',
            'correoInstitucion' => 'required|email|max:100|unique:instituciones',
            'passwordInstitucion' => 'required|confirmed|min:8',
        ]);

        $institucion = new Institucion;
        $institucion->nombreInstitucion = $validatedData['nombreInstitucion'];
        $institucion->tipoInstitucion = $validatedData['tipoInstitucion'];
        $institucion->disposicionInstitucion = $validatedData['disposicionInstitucion'];
        $institucion->telefonoInstitucion = $validatedData['telefonoInstitucion'];
        $institucion->correoInstitucion = $validatedData['correoInstitucion'];
        $institucion->passwordInstitucion = Hash::make($validatedData['passwordInstitucion']);
        $institucion->save();

        // Establecer la sesión con el idInstitucion
        session(['idInstitucion' => $institucion->idInstitucion]);

        // Redirigir al formulario de registro de representante
        return redirect()->route('usuarios.create')->with('idInstitucion', $institucion->idInstitucion);
    }
}
