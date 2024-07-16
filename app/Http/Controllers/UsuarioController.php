<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        if(!$usuarios ){
            return "Sin usuarios registrados";
        }
        else{
            return response()->json($usuarios);
        }
        
        
    }
}
