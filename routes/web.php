<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;

// //Vista de prueba
// Route::get('/', [EmpresaController::class,'hola']);
// //Vista para listar empresas en formato Json
// Route::get('/Listado',[EmpresaController::class,'index']);

// Route::get('/Listado2',[UsuarioController::class,'index']);

Route::get("empresas/create",[EmpresaController::class,'create'])->name("empresas.create");
Route::post("empresas",[EmpresaController::class,'RegisterCompany'])->name("empresas.store");