<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
    public function inicioAlumno(){
        $userId = Auth::id();
        $user = Auth::user();
        return view('dashboars.Alumnos.dashboardAlumnos',[
            'userId' => $userId,
            'user' => $user
        ]);
    }
}
