<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    public function dashboardDocente(){
        $userId = Auth::id();
        $user = Auth::user();
        return view('dashboars.Docentes.dashboardDocentes',[
            'userId' => $userId,
            'user' => $user
        ]);
    }
}
