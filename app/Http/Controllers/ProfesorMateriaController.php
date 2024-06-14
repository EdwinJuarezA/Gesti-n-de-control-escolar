<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grupo;
use App\Models\Grupo_Materia;
use App\Models\Materia;
use App\Models\Profesor;
use App\Models\ProfesorMateria;

class ProfesorMateriaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:asignar-profesor|asignar-profesor|asignar-profesor|asignar-profesor')->only('index');
        $this->middleware('permission:asignar-profesor', ['only' => ['create','store']]);
        $this->middleware('permission:asignar-profesor', ['only' => ['edit','update']]);
        $this->middleware('permission:asignar-profesor', ['only' => ['destroy']]);
    }

    public function index()
    {
        $grupoMaterias = Grupo_Materia::query()
    ->leftJoin('materias', 'materias.id', '=', 'grupo_materias.materia_id')
    ->leftJoin('profesors', 'profesors.id', '=', 'grupo_materias.profesor_id')
    ->select('grupo_materias.*', 'materias.nombre as nombre_materia', 'materias.semestre as semestre_materia', 'materias.clave_curso as clave_curso', 'profesors.nombre as nombre_profesor', 'profesors.apellido_paterno as apellido_paterno_profesor', 'profesors.apellido_materno as apellido_materno_profesor', 'profesors.perfil as perfil')
    ->paginate(10);

        return view('profesor_materia.index', compact('grupoMaterias'));
    }

    public function create()
    {
        return view('profesor_materia.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'materia_id' => 'required',
            'profesor_id' => 'required',
        ]);

        // Intenta encontrar el registro existente basado en materia_id y profesor_id
        Grupo_Materia::updateOrCreate(
            [
                'materia_id' => $request->materia_id
            ],
            $request->all()
        );

        session()->forget(['grupo_materias_profesor_id', 'grupo_materias_profesor_nombre', 'grupo_materias_materia_nombre', 'grupo_materias_materia_id']);

        return redirect()->route('profesor_materias.index')->with('success', 'Relación Grupo-Materia creada correctamente.');
    }

    public function edit($id)
    {
        $grupoMateria = Grupo_Materia::find($id);
        $materias = Materia::all();
        $profesores = Profesor::all();
        return view('profesor_materia.editar', compact('grupoMateria', 'materias', 'profesores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            //'grupo_id' => 'required',
            'materia_id' => 'required',
            'profesor_id' => 'required',
        ]);

        // Buscar el registro basado en el id
        $grupoMateria = Grupo_Materia::find($id);

        // Actualizar el registro con los nuevos datos
        $grupoMateria->update($request->all());

        return redirect()->route('profesor_materias.index')->with('success', 'Relación Grupo-Materia actualizada correctamente.');
    }


    public function destroy($id)
    {
        Grupo_Materia::destroy($id);
        return redirect()->route('profesor_materias.index')->with('success', 'Relación Grupo-Materia eliminada correctamente.');
    }
}
