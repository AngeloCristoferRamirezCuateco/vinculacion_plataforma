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
Route::get('/Proyectos/lista',[RepresentanteController::class,'lista'])->middleware('auth')->name('proyectos.lista');
Route::get('/AsignarDocente',[RepresentanteController::class,'asignardocentesrep'])->middleware('auth')->name('representante.asignar-docente');
Route::post('/AsignandoDocente',[RepresentanteController::class,'guardarAsignacion'])->middleware('auth')->name('representante.alumnodocente');
Route::get('/solicitudes/vacantes', [RepresentanteController::class, 'verSolicitudes'])->name('vacantes.solicitudes');

Route::put('/solicitudes/{id}/aceptar', [RepresentanteController::class, 'aceptarSolicitud'])->name('solicitudes.aceptar');
Route::delete('/solicitudes/{id}/rechazar', [RepresentanteController::class, 'rechazarSolicitud'])->name('solicitudes.rechazar');

Route::get('/lista/vacantes',[AplicacionVacanteController::class,'index'])->middleware('auth')->name('lista.vacantes');
Route::get('/Asignacion/alumnos-docentes',[DocenteController::class,'mostrarAlumnosDelDocente'])->middleware('auth')->name('docente.asignaciondocentealumno');
################################Rutas-para-docentes##########################################################
// Route::get('/panelDocente',function(){
//     return view('dashboars\Docentes\dashboardDocentes');
// })->name('docente.panelInicio');
Route::get('/Perfil/Docente',[DocenteController::class,'perfilUsuario'])->middleware('auth')->name('docente.perfil');
Route::get('/dashboard/inicio/Docente',[DocenteController::class,'dashboardDocente'])->middleware('auth')->name('docente.panelInicio');
################################Rutas-para-alumnos##########################################################
// Route::get('/panelAlumno',function(){
//     return view('dashboars\Alumnos\dashboardAlumnos');
// })->name('alumno.panelInicio');
Route::get('/Perfil/Alumno',[AlumnoController::class,'perfilUsuarioAlumno'])->middleware('auth')->name('alumno.perfil');
Route::get('/dashboard/inicio/Alumno',[AlumnoController::class,'inicioAlumno'])->middleware('auth')->name('alumno.panelInicio');
Route::get('/dashboard/Alumno-vacante',[AlumnoController::class,'alumnovacante'])->middleware('auth')->name('alumno.vacante');
Route::get('/alumnos/vacantes',[VacanteController::class,'index'])->middleware('auth')->name('alumnos.vacantes');
Route::get('/alumno/solicitudes',[AlumnoController::class,'solicitudesenviadas'])->middleware('auth')->name('alumno.solicitudes');
##############################################################################################################
Route::get('/empresas', [EmpresaController::class, 'index'])->middleware('auth')->name('empresas.index');
Route::get('/empresas/create', [EmpresaController::class, 'create'])->middleware('auth')->name('empresas.create');
Route::post('/empresas', [EmpresaController::class, 'register'])->middleware('auth')->name('empresas.register');
Route::get('/empresas/{id}/edit', [EmpresaController::class, 'edit'])->middleware('auth')->name('empresas.edit');
Route::put('/empresas/{id}', [EmpresaController::class, 'update'])->middleware('auth')->name('empresas.update');
Route::delete('/empresas/{id}', [EmpresaController::class, 'destroy'])->middleware('auth')->name('empresas.destroy');

Route::get('/usuarios', [UsuarioController::class, 'index'])->middleware('auth')->name('usuarios.index');
//Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'register'])->middleware('auth')->name('usuarios.register');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->middleware('auth')->name('usuarios.show');
//Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->middleware('auth')->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->middleware('auth')->name('usuarios.destroy');

Route::get('/Solicitudes/Recibidas', [ConvenioController::class, 'index'])->middleware('auth')->name('convenios.index');
Route::get('/Solicitudes/Enviadas', [ConvenioController::class, 'SolcitudesEnviadas'])->middleware('auth')->name('convenios.SolicitudesEnviadas');
Route::post('/convenios', [ConvenioController::class, 'store'])->middleware('auth')->middleware('auth')->name('convenios.store'); //Importante//
//Route::get('/convenios/{id}', [ConvenioController::class, 'show'])->name('convenios.show');
Route::put('/convenios/{id}', [ConvenioController::class, 'update'])->middleware('auth')->name('convenios.update');
Route::delete('/convenios/{id_solicitud}', [ConvenioController::class, 'destroy'])->middleware('auth')->name('convenios.destroy');
Route::delete('/bann/{id}', [ConvenioController::class, 'deleteByRemitente'])->middleware('auth')->name('convenios.banear');

Route::get('/proyectos', [ProyectoController::class, 'index'])->middleware('auth')->name('proyectos.index');
Route::post('/proyectos', [ProyectoController::class, 'store'])->middleware('auth')->name('proyectos.store');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->middleware('auth')->name('proyectos.show');
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->middleware('auth')->name('proyectos.update');
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->middleware('auth')->name('proyectos.destroy');

Route::get('/vacantes', [VacanteController::class, 'index'])->middleware('auth')->name('vacantes.index');
Route::post('/vacantes', [VacanteController::class, 'store'])->middleware('auth')->name('vacantes.store');
Route::get('/vacantes/{id}', [VacanteController::class, 'show'])->middleware('auth')->name('vacantes.show');
Route::put('/vacantes/{id}', [VacanteController::class, 'update'])->middleware('auth')->name('vacantes.update');
Route::delete('/vacantes/{id}', [VacanteController::class, 'destroy'])->middleware('auth')->name('vacantes.destroy');
Route::get('/vacantes-edit/{id}', [VacanteController::class, 'edit'])->middleware('auth')->name('vacantes.edit');

Route::get('/aplicaciones', [AplicacionVacanteController::class, 'index'])->middleware('auth')->name('aplicaciones.index');
Route::post('/aplicaciones', [AplicacionVacanteController::class, 'store'])->middleware('auth')->name('aplicaciones.store');
Route::get('/aplicaciones/{id}', [AplicacionVacanteController::class, 'show'])->middleware('auth')->name('aplicaciones.show');
Route::put('/aplicaciones/{id}', [AplicacionVacanteController::class, 'update'])->middleware('auth')->name('aplicaciones.update');
Route::delete('/aplicaciones/{id}', [AplicacionVacanteController::class, 'destroy'])->middleware('auth')->name('aplicaciones.destroy');

Route::get('/roles', [RolController::class, 'index'])->middleware('auth')->name('roles.index');
Route::post('/roles', [RolController::class, 'store'])->middleware('auth')->name('roles.store');
Route::get('/roles/{id}', [RolController::class, 'show'])->middleware('auth')->name('roles.show');
Route::put('/roles/{id}', [RolController::class, 'update'])->middleware('auth')->name('roles.update');
Route::delete('/roles/{id}', [RolController::class, 'destroy'])->middleware('auth')->name('roles.destroy');

Route::get('/usuario-roles', [UsuarioRolController::class, 'index'])->middleware('auth')->name('usuarioRoles.index');
Route::post('/usuario-roles', [UsuarioRolController::class, 'store'])->middleware('auth')->name('usuarioRoles.store');
Route::get('/usuario-roles/{id}', [UsuarioRolController::class, 'show'])->middleware('auth')->name('usuarioRoles.show');
Route::put('/usuario-roles/{id}', [UsuarioRolController::class, 'update'])->middleware('auth')->name('usuarioRoles.update');
Route::delete('/usuario-roles/{id}', [UsuarioRolController::class, 'destroy'])->middleware('auth')->name('usuarioRoles.destroy');

Route::post('/login', [login::class, 'loginUser'])->name('login');

Route::get('/logout', [UsuarioController::class, 'logoutUser'])->middleware('auth')->name('app.logout');

Route::get('/convenios/gestion', [ConvenioController::class, 'gestionConvenios'])->middleware('auth')->name('representante.gestion');

Route::post('/solicitudes/{id}/aceptar', [ConvenioController::class, 'aceptarSolicitud'])->middleware('auth')->name('solicitudes.aceptar');
Route::post('/solicitudes/{id}/rechazar', [ConvenioController::class, 'rechazarSolicitud'])->middleware('auth')->name('solicitudes.rechazar');
Route::delete('/solicitudes/{id}', [ConvenioController::class, 'eliminarSolicitud'])->middleware('auth')->name('solicitudes.destroy');

Route::get('/buscar-empresa', [EmpresaController::class, 'buscarEmpresa'])->middleware('auth')->name('admin.busquedasEmpresas');
Route::get('/buscar-usuarios', [UsuarioController::class, 'buscarUsuarios'])->middleware('auth')->name('admin.busquedas');
Route::get('/buscar-alumno', [RepresentanteController::class, 'buscarAlumno'])->middleware('auth')->name('repre.busqueda-alumno');

Route::post('/crear-proyecto', [ProyectoController::class,'store'])->middleware('auth')->name('proyecto.create');


Route::get('/crear-proyect', [ProyectoController::class,'proyectoscrear'])->middleware('auth')->name('proyect.create');

Route::get('/seleccionar-Docente', [RepresentanteController::class,'panelDocentess'])->middleware('auth')->name('seleccion.Docente');

Route::delete('/Proyectos-destroy/{id}',[ProyectoController::class,'destroy'])->middleware('auth')->name('proyecto.destroy');

