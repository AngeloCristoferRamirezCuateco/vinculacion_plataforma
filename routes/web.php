<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\UsuarioInstitucionController;
use App\Http\Controllers\RepresentanteController;

Route::get('/', [LoginController::class, 'index']) ->name('index');
Route::get('/registrer',[LoginController::class,'registrer'])->name('registrar');
Route::get('/recuperar',[LoginController::class,'recoveraccount']) ->name('recuperar');
Route::get('/verifymail',[LoginController::class,'verifymail'])->name('verifymail1');
Route::get('/registrer/registerinstitution',[LoginController::class,'registerinstitution'])->name('registerinst');

Route::get('/instituciones/create', [InstitucionController::class, 'create'])->name('instituciones.create');
Route::post('/instituciones', [InstitucionController::class, 'store'])->name('instituciones.store');

Route::get('/usuarios/create', [UsuarioInstitucionController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioInstitucionController::class, 'store'])->name('usuarios.store');

Route::get('/check-rector-status', [UsuarioInstitucionController::class, 'checkRectorStatus'])->name('check.rector.status');

Route::get('/representantes/create', [RepresentanteController::class, 'create'])->name('representantes.create');
Route::post('/representantes', [RepresentanteController::class, 'store'])->name('representantes.store');

Route::get('/check-session', function () {
    return response()->json(['idInstitucion' => session('idInstitucion')]);
})->name('check.session');
