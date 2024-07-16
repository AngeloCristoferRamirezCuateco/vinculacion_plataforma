<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    /*Funcion de prueba para verificar que las rutas coinciden*/
    public function Hola(){
        return 'Hola mundo';
    }
    // public function index()
    // {
    //     $empresas = Empresa::all();
    //     return response()->json($empresas);
        
    // }
    //Funcion para redirigir al formulario de registro de empresas

    public function create(){
        return view('empresas.create');
    }
    //Funcion para registrar empresa
    //Function to register company
    public function RegisterCompany(Request $request){
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

        return redirect()->route("empresas.index")->with("Succes","Empresa registrada");
    }
}
