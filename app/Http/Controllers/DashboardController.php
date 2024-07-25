<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Empresa;
use App\Models\UsuarioRol;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Contar usuarios y empresas
        $totalUsuarios = Usuario::count();
        $totalEmpresas = Empresa::count();

        // Contar usuarios por tipo de rol
        $usuariosPorRol = UsuarioRol::select('id_rol', DB::raw('count(*) as total'))
                                    ->groupBy('id_rol')
                                    ->get();

        // Datos de crecimiento de usuarios por mes
        $usuariosPorMes = Usuario::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                         ->groupBy('year', 'month')
                         ->orderBy('year', 'asc')
                         ->orderBy('month', 'asc')
                         ->get();

        return view('dashboars.Administradores.data', compact('totalUsuarios', 'totalEmpresas', 'usuariosPorRol', 'usuariosPorMes'));
    }
}
