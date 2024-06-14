<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\Materia_has_alumnoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\SeleccionarController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\GrupoMateriaController;
use App\Http\Controllers\ProfesorMateriaController;
use App\Http\Controllers\AsignarGrupoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\LectorController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\Documento2Controller;
use App\Models\Ciclo;
use App\Models\Profesor;
use App\Models\Alumno;
use App\Models\Grupo_Materia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('materias', MateriaController::class);
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('profesores', ProfesorController::class);
    Route::resource('ciclos', CicloController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('seleccionars', SeleccionarController::class);
    Route::resource('calificaciones', CalificacionController::class);
    Route::resource('grupo_materias', GrupoMateriaController::class);
    Route::resource('inscripciones', InscripcionController::class);
    Route::resource('profesor_materias', ProfesorMateriaController::class);
    Route::resource('asignarGrupos', AsignarGrupoController::class);
    Route::resource('asistencias', AsistenciaController::class);
    Route::resource('lectores', LectorController::class);

    //Route::delete('/alumnos/{alumno}', [AlumnoController::class, 'destroy'])->name('alumnos.destroy');


    // Rutas para la selección de ciclos, materias y profesores
    Route::get('/seleccionar/ciclos', [SeleccionarController::class, 'ciclos'])->name('seleccionar.ciclos');
    Route::get('/seleccionar/materias', [SeleccionarController::class, 'materias'])->name('seleccionar.materias');
    Route::get('/seleccionar/profesores', [SeleccionarController::class, 'profesores'])->name('seleccionar.profesores');

    // Rutas para almacenar la selección en la sesión y redireccionar de vuelta al formulario de grupos
    Route::get('/seleccionar/ciclo/{id}', [SeleccionarController::class, 'seleccionarCiclo'])->name('seleccionar.ciclo');
    Route::get('/seleccionar/materia/{id}', [SeleccionarController::class, 'seleccionarMateria'])->name('seleccionar.materia');
    Route::get('/seleccionar/profesor_materias/materias/{id}', [SeleccionarController::class, 'mandarMateria'])->name('seleccionar.materia');
    Route::get('/seleccionar/profesor_materias/profesor/{id}', [SeleccionarController::class, 'mandarProfesor'])->name('seleccionar.profe');
    Route::get('/seleccionar/profesor/{id}', [SeleccionarController::class, 'seleccionarProfesor'])->name('seleccionar.profesor');
    Route::get('/asistencias/{id}', [AsistenciaController::class, 'show'])->name('asistencias.show');

    //Route::get('/asistencia/registrar/{codigo}', 'AsistenciaController@registrarAsistencia');

    Route::get('/obtener-alumno/{matricula}', [AlumnoController::class, 'obtenerAlumno']);
    Route::get('/obtener-ultimo-ciclo', [CicloController::class, 'obtenerUltimoCiclo']);
    //Route::post('/registrar-asistencia', [LectorControlador::class, 'registrarAsistencia']);
    Route::post('/obtener-alumno/{matricula}', 'AlumnoController@obtenerAlumno');

    Route::post('/obtener-ultimo-ciclo', 'CicloController@obtenerUltimoCiclo');
    Route::post('/registrar-asistencia', [LectorController::class, 'registrarAsistencia'])->name('registrar.asistencia');

    // Rutas para mostrar listas de selección
    Route::get('/seleccionar/grupos', [SeleccionarController::class, 'grupos'])->name('calificaciones.seleccionar.grupos');
    Route::get('/seleccionar/alumnos', [SeleccionarController::class, 'alumnos'])->name('calificaciones.seleccionar.alumnos');
    Route::get('/seleccionar/inscripciones/{id}', [SeleccionarController::class, 'inscripciones'])->name('calificaciones.seleccionar.grupos');
    Route::get('/seleccionar/profesor_materias/profesor', [SeleccionarController::class, 'inscribirProfesores'])->name('profesor_materia.seleccionar.profesor');
    Route::get('/seleccionar/profesor_materias/materias', [SeleccionarController::class, 'inscribirMateria'])->name('profesor_materia.seleccionar.materias');
    Route::get('/seleccionar/asignargrupos/{grupo}', [SeleccionarController::class, 'asignarMateria'])->name('asignargrupos.seleccionar.materia');

    // Rutas para seleccionar un grupo o alumno específico
    //Route::get('/seleccionar/grupo/{id}', [SeleccionarController::class, 'seleccionarGrupo'])->name('seleccionar.grupo');
    Route::get('/seleccionar/grupo/{id}', [SeleccionarController::class, 'seleccionarGrupo'])->name('seleccionar.grupo');
    Route::get('/seleccionar/alumno/{id}', [SeleccionarController::class, 'seleccionarAlumno'])->name('seleccionar.alumno');

    Route::put('/inscripciones/{id}', [InscripcionController::class, 'update'])->name('inscripciones.update');

    Route::get('/verGrupos', [CalificacionController::class, 'getGrupoMaterias'])->name('verGrupos');
    Route::post('/actualizar-calificacion', [CalificacionController::class, 'updatePartialScore'])->name('calificaciones.updatePartialScore');
    Route::post('/reset-status', [CalificacionController::class, 'resetStatus']);

    Route::get('/buscar-alumno/{matricula}', [LectorController::class, 'obtenerAlumnoPorMatricula']);


    //rutas para boletas
    Route::get('/boletas', [DocumentoController::class, 'index'])->name('documentos.index');
    Route::get('/boletasBuscar', [DocumentoController::class, 'buscar'])->name('documentos.buscar');
    Route::get('/boletas/pdf/{alumno}/{grupo}', [DocumentoController::class, 'generarPDF'])->name('documentos.pdf');
});
