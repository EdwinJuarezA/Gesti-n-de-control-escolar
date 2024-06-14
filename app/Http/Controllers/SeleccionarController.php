<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Materia;
use App\Models\Profesor;
use App\Models\Grupo;
use App\Models\Alumno;
use App\Models\Grupo_Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeleccionarController extends Controller
{
    public function ciclos()
    {
        $ciclos = Ciclo::paginate(10);
        return view('grupos.seleccionars.ciclos', compact('ciclos'));
    }

    public function materias()
    {
        $materias = Materia::paginate(10);
        return view('grupos.seleccionars.materias', compact('materias'));
    }

    public function profesores()
    {
        $profesores = Profesor::paginate(10);
        return view('grupos.seleccionars.profesores', compact('profesores'));
    }

    public function grupos()
    {
        $grupos = Grupo::query()
        ->join('ciclos', 'ciclos.id', '=', 'grupos.ciclo_id')
        ->select('grupos.id', 'grupos.nombre as nombre', 'ciclos.nombre as ciclo')
        ->paginate(10);
        return view('calificaciones.seleccionar.grupo', compact('grupos'));
    }

    public function alumnos()
    {
        $alumnos = Alumno::paginate(10);
        return view('calificaciones.seleccionar.alumno', compact('alumnos'));
    }

    public function inscripciones($id)
    {
        $grupos = Grupo::query()
        ->join('ciclos', 'ciclos.id', '=', 'grupos.ciclo_id')
        ->select('grupos.id', 'grupos.nombre as nombre', 'ciclos.nombre as ciclo')
        ->paginate(10);
        return view('calificaciones.seleccionar.grupo', compact('grupos', 'id'));
    }

    public function inscribirProfesores()//Materia $materia)//$id, $nombre, $clave_curso)
    {
        $profesores = Profesor::paginate(10);
        return view('profesor_materia.seleccionar.profesor', compact('profesores'));//, 'materia'));//'id', 'nombre', 'clave_curso'));
    }

    public function mandarProfesor(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);
        $request->session()->put('grupo_materias_profesor_id', $profesor->id);
        $request->session()->put('grupo_materias_profesor_nombre', $profesor->nombre . ' ' . $profesor->apellidos);
        return redirect()->route('profesor_materias.create');
    }

    //para seleccionar la materia -> crear grupo_materia
    public function inscribirMateria()//$id, $nombre, $clave_curso)
    {
        $materias = Materia::paginate(10);
        return view('profesor_materia.seleccionar.materias', compact('materias'));//'id', 'nombre', 'clave_curso'));
    }

    //que se le seleccione
    public function mandarMateria(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);
        $request->session()->put('grupo_materias_materia_nombre', $materia->nombre);
        $request->session()->put('grupo_materias_materia_id', $materia->id);
        return redirect()->route('profesor_materias.create');
    }

    public function asignarMateria(Grupo $grupo)//$id, $nombre, $clave_curso)
    {
        $materias = Materia::paginate(10);
        return view('asignargrupos.seleccionar.materia', compact('materias', 'grupo'));
    }

    public function seleccionarCiclo(Request $request, $id)
    {
        $ciclo = Ciclo::findOrFail($id);
        $request->session()->put('grupo_ciclo_id', $ciclo->id);
        $request->session()->put('grupo_ciclo_nombre', $ciclo->nombre);
        return redirect()->route('grupos.create');
    }

    public function seleccionarMateria(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);
        $request->session()->put('grupo_materia_id', $materia->id);
        $request->session()->put('grupo_materia_nombre', $materia->nombre);
        return redirect()->route('grupos.create');
    }

    public function seleccionarProfesor(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);
        $request->session()->put('grupo_profesor_id', $profesor->id);
        $request->session()->put('grupo_profesor_nombre', $profesor->nombre . ' ' . $profesor->apellidos);
        return redirect()->route('grupos.create');
    }

    public function seleccionarGrupo(Request $request, $id)
    {
        $grupo = Grupo::findOrFail($id);
        $request->session()->put('grupo_id', $grupo->id);
        $request->session()->put('grupo_nombre', $grupo->nombre);
        return redirect()->route('alumnos.create');
    }

    public function seleccionarAlumno(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);
        $request->session()->put('alumno_id', $alumno->id);
        $request->session()->put('alumno_nombre', $alumno->nombre . ' ' . $alumno->apellido);
        return redirect()->route('calificaciones.create');
    }

}
