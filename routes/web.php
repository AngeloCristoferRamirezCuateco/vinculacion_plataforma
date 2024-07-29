<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\AplicacionVacanteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioRolController;
use App\Http\Controllers\login;
use App\Models\Empresa;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

//Definimos una ruta con el metodo get y definimos la direccion para acceder a la vista "/index", en este caso
//no declararemos una funcion ya que esta se encuentra en el controlador EmpresasController, para ello necesitamos
//importar el controlador desde esta carpeta:'use App\Http\Controllers\EmpresaController;' para luego ingresar a su clase
//y traer al metodo "index"
//Syntax: Route::get (Ruta con metodo get) ('/index' "direccion de acceso" ,[EmpresaController::class "uso del controlador
// junto a la clase", 'index' "uso de la funcion que se encuentra en el controlador"]);
//Route::get('/index', [EmpresaController::class, 'index']);

Route::get('/', [EmpresaController::class, 'inicio'])->name('empresas.inicio');

####################################Rutas-para-administradores###################################################

Route::get('/panelAdmin', function(){
    return view('dashboars.Administradores.dashboardAdmin');
})->name('admin.panel');

Route::get('/panelAdmin/registerUsers',function(){
    $empresas = Empresa::all();
    $roles = Rol::all();
    return view('dashboars.Administradores.formularioUsuario',compact('empresas','roles'));
})->name('admin.panelregisteruser');

Route::get('/panelAdmin/registerEmpresas',function(){
    $empresas = Empresa::all();
    $roles = Rol::all();
    return view('dashboars.Administradores.fromularioEmpresa',compact('empresas','roles'));
})->name('admin.panelregisterempresa');

Route::get('/panelAdmin/editUsers',function(){
    $usuarios=Usuario::all();
    return view('dashboars.Administradores.tablasalumnos',compact('usuarios'));
})->name('admin.paneleditUsers');

Route::get('/panelAdmin/editEmpresas',function(){
    $empresas=Empresa::all();
    return view('dashboars.Administradores.tablasempresas',compact('empresas'));
})->name('admin.paneleditEmpresas');

Route::get('/dashboard/data', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/panelAdmin/editarEmpresas',function(){
    return view('dashboars.Administradores.editarempresa');
})->name('admin.paneleditEmpresasdashboard');
################################Rutas-para-representanes#####################################################
Route::get('/panelRepresentante',function(){
    return view('dashboars\Representantes\dashboardRepresentantes');
})->name('representante.panelInicio');

Route::get('/dashboard/CrearVacantes',function(){
    return view('dashboars\Representantes\crearVacante');
})->name('representante.panelVacante');

Route::get('/dashboard/listaAlumnos', function() {
    // Obtener datos de sesión manualmente
    $representanteId = session('user_id'); // o cualquier otro dato que hayas guardado

    if (!$representanteId) {
        return "Sin usuario";
    }

    // Obtener el usuario manualmente usando el ID de sesión
    $representante = Usuario::find($representanteId);

    if (!$representante) {
        return "Usuario no encontrado";
    }

    $alumnos = Usuario::all();
    $usuariosRol = UsuarioRol::all();

    return view('dashboars.Representantes.listaAlumnos', compact('alumnos', 'usuariosRol', 'representante'));
})->name('representante.panelAlumnos');



Route::get('/dashboard/listaDocentes',function(){
    $docentes = Usuario::all();
    $usuariosRol = UsuarioRol::all();
    return view('dashboars\Representantes\listaDocentes',compact('docentes','usuariosRol'));
})->name('representante.panelDocentes');

Route::get('/dashboard/crearConvenio',function(){
    return view('dashboars.Representantes.crearConvenio');
})->name('representante.panelConvenio');

Route::get('/dashboard/documentos',function(){
    return view('dashboars\Representantes\Documentos');
})->name('representante.panelDocumento');
################################Rutas-para-docentes##########################################################
Route::get('/panelDocente',function(){
    return view('dashboars\Docentes\dashboardDocentes');
})->name('docente.panelInicio');
################################Rutas-para-alumnos##########################################################
Route::get('/panelAlumno',function(){
    return view('dashboars\Alumnos\dashboardAlumnos');
})->name('alumno.panelInicio');
##############################################################################################################
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');
Route::get('/empresas/create', [EmpresaController::class, 'create'])->name('empresas.create');
Route::post('/empresas', [EmpresaController::class, 'register'])->name('empresas.register');
Route::get('/empresas/{id}/edit', [EmpresaController::class, 'edit'])->name('empresas.edit');
Route::put('/empresas/{id}', [EmpresaController::class, 'update'])->name('empresas.update');
Route::delete('/empresas/{id}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
//Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'register'])->name('usuarios.register');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
//Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

Route::get('/convenios', [ConvenioController::class, 'index'])->name('convenios.index');
Route::post('/convenios', [ConvenioController::class, 'store'])->name('convenios.store');
Route::get('/convenios/{id}', [ConvenioController::class, 'show'])->name('convenios.show');
Route::put('/convenios/{id}', [ConvenioController::class, 'update'])->name('convenios.update');
Route::delete('/convenios/{id}', [ConvenioController::class, 'destroy'])->name('convenios.destroy');

Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');

Route::get('/vacantes', [VacanteController::class, 'index'])->name('vacantes.index');
Route::post('/vacantes', [VacanteController::class, 'store'])->name('vacantes.store');
Route::get('/vacantes/{id}', [VacanteController::class, 'show'])->name('vacantes.show');
Route::put('/vacantes/{id}', [VacanteController::class, 'update'])->name('vacantes.update');
Route::delete('/vacantes/{id}', [VacanteController::class, 'destroy'])->name('vacantes.destroy');

Route::get('/aplicaciones', [AplicacionVacanteController::class, 'index'])->name('aplicaciones.index');
Route::post('/aplicaciones', [AplicacionVacanteController::class, 'store'])->name('aplicaciones.store');
Route::get('/aplicaciones/{id}', [AplicacionVacanteController::class, 'show'])->name('aplicaciones.show');
Route::put('/aplicaciones/{id}', [AplicacionVacanteController::class, 'update'])->name('aplicaciones.update');
Route::delete('/aplicaciones/{id}', [AplicacionVacanteController::class, 'destroy'])->name('aplicaciones.destroy');

Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
Route::post('/roles', [RolController::class, 'store'])->name('roles.store');
Route::get('/roles/{id}', [RolController::class, 'show'])->name('roles.show');
Route::put('/roles/{id}', [RolController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RolController::class, 'destroy'])->name('roles.destroy');

Route::get('/usuario-roles', [UsuarioRolController::class, 'index'])->name('usuarioRoles.index');
Route::post('/usuario-roles', [UsuarioRolController::class, 'store'])->name('usuarioRoles.store');
Route::get('/usuario-roles/{id}', [UsuarioRolController::class, 'show'])->name('usuarioRoles.show');
Route::put('/usuario-roles/{id}', [UsuarioRolController::class, 'update'])->name('usuarioRoles.update');
Route::delete('/usuario-roles/{id}', [UsuarioRolController::class, 'destroy'])->name('usuarioRoles.destroy');

Route::post('/login', [login::class, 'loginUser'])->name('login');

Route::get('/logout', [UsuarioController::class, 'logoutUser'])->name('app.logout');