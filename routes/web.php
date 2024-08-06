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
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\login;
use App\Http\Controllers\PDFController;
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
Route::get('/dashboard/data', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.index');
Route::get('/panelAdmin',[AdministradorController::class,'panelAdmin'])->middleware('auth')->name('admin.panel');
Route::get('/panelAdmin/registerUsers',[AdministradorController::class,'panelregisterUser'])->middleware('auth')->name('admin.panelregisteruser');
Route::get('/panelAdmin/registerEmpresas',[AdministradorController::class,'panelregisterEmpresas'])->middleware('auth')->name('admin.panelregisterempresa');
Route::get('/panelAdmin/listUsers',[AdministradorController::class,'paneleditUsers'])->middleware('auth')->name('admin.paneleditUsers');
Route::get('/panelAdmin/listEmpresas',[AdministradorController::class,'paneleditEmpresas'])->middleware('auth')->name('admin.paneleditEmpresas');
Route::get('/panelAdmin/editUsers/{id}',[AdministradorController::class,'editarUsuario'])->middleware('auth')->name('admin.editusers');
Route::get('/panelAdmin/editEmpresa/{id}',[AdministradorController::class,'editarEmpresa'])->middleware('auth')->name('admin.editempresas');
Route::get('/Perfil/Administrador',[AdministradorController::class,'perfilUsuario'])->middleware('auth')->name('admin.perfil');
Route::put('/profile/update', [UsuarioController::class, 'updateProfile'])->middleware('auth')->name('profile.update');

################################Rutas-para-representanes#####################################################
Route::get('/panelRepresentante',[RepresentanteController::class,'panelInicio'])->middleware('auth')->name('representante.panelInicio');
Route::get('/dashboard/listaDocentes',[RepresentanteController::class,'panelListaDocentes'])->middleware('auth')->name('representante.panelDocentes');
Route::get('/dashboard/crearConvenio',[RepresentanteController::class,'panelConvenios'])->middleware('auth')->name('representante.panelConvenio');
Route::get('/dashboard/CrearVacantes',[RepresentanteController::class,'panelVacantes'])->middleware('auth')->name('representante.panelVacante');
Route::get('/dashboard/listaAlumnos',[RepresentanteController::class,'panelListaAlumnos'])->middleware('auth')->name('representante.panelAlumnos');
Route::get('/dashboard/documentos',[RepresentanteController::class,'panelDocumentos'])->middleware('auth')->name('representante.panelDocumento');
Route::get('/dashboard', [RepresentanteController::class, 'dashboard'])->middleware('auth')->name('representante.dashboard');
Route::post('/generate-pdf', [PDFController::class, 'generatePDF'])->middleware('auth')->name('generate.pdf');
Route::get('/dashboard/editAlumno/{id}',[RepresentanteController::class,'editarAlumno'])->middleware('auth')->name('representante.editarAlumno');
Route::get('/dashboard/editDocente/{id}',[RepresentanteController::class,'editarDocente'])->middleware('auth')->name('representante.editarDocente');
Route::post('/dashboard/register', [UsuarioController::class, 'registerRepresentante'])->name('representante.registerRepresentante');
Route::get('/Perfil/Representante',[RepresentanteController::class,'perfilUsuario'])->middleware('auth')->name('representante.perfil');
Route::get('/Prueba',[RepresentanteController::class,'Prueva'])->middleware('auth')->name('prueba');
Route::get('/Prueba/vista2',[RepresentanteController::class,'Prueva2'])->middleware('auth')->name('ruta.prueba2');
################################Rutas-para-docentes##########################################################
// Route::get('/panelDocente',function(){
//     return view('dashboars\Docentes\dashboardDocentes');
// })->name('docente.panelInicio');
Route::get('/dashboard/inicio/Docente',[DocenteController::class,'dashboardDocente'])->middleware('auth')->name('docente.panelInicio');
################################Rutas-para-alumnos##########################################################
// Route::get('/panelAlumno',function(){
//     return view('dashboars\Alumnos\dashboardAlumnos');
// })->name('alumno.panelInicio');
Route::get('/dashboard/inicio/Alumno',[AlumnoController::class,'inicioAlumno'])->middleware('auth')->name('alumno.panelInicio');
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
Route::post('/convenios', [ConvenioController::class, 'store'])->middleware('auth')->name('convenios.store'); //Importante//
//Route::get('/convenios/{id}', [ConvenioController::class, 'show'])->name('convenios.show');
Route::put('/convenios/{id}', [ConvenioController::class, 'update'])->name('convenios.update');
Route::delete('/convenios/{id_solicitud}', [ConvenioController::class, 'destroy'])->name('convenios.destroy'); //Importante//

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

Route::get('/convenios/gestion', [ConvenioController::class, 'gestionConvenios'])->name('representante.gestion');

Route::post('/solicitudes/{id}/aceptar', [ConvenioController::class, 'aceptarSolicitud'])->name('solicitudes.aceptar');
Route::post('/solicitudes/{id}/rechazar', [ConvenioController::class, 'rechazarSolicitud'])->name('solicitudes.rechazar');
Route::delete('/solicitudes/{id}', [ConvenioController::class, 'eliminarSolicitud'])->name('solicitudes.destroy');