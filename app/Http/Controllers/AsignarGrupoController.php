<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grupo;
use App\Models\Grupo_Materia;
use App\Models\Materia;
use App\Models\Profesor;
use App\Models\ProfesorMateria;
use App\Models\GrupoMateria;

class AsignarGrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrar-materias-asignadas', ['only' => ['index']]);
        $this->middleware('permission:administrar-materias-asignadas', ['only' => ['create','store','edit','update']]);
    }

    public function index()
    {
        // Obtener los grupos con el ciclo correspondiente
        $grupos = Grupo::query()
            ->join('ciclos', 'ciclos.id', '=', 'grupos.ciclo_id')
            ->select('grupos.id', 'grupos.nombre as nombre', 'ciclos.nombre as ciclo')
            ->paginate(10);

        // Obtener las relaciones de grupo_materias con las materias correspondientes
        $grupoMaterias = Grupo_Materia::with('materia')->get();

        return view('asignargrupos.index', compact('grupos', 'grupoMaterias'));
    }


    public function create()
    {
        // Obtener todas las materias
        $materias = Materia::all();

        // Obtener los IDs de las materias que ya están en grupo_materias
        $materiasEnGrupo = Grupo_Materia::pluck('materia_id')->toArray();

        // Filtrar las materias para excluir las que ya están en grupo_materias
        $materiasDisponibles = $materias->whereNotIn('id', $materiasEnGrupo);

        return view('asignargrupos.crear', compact('materiasDisponibles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required',
            'materia_id' => 'required',
            //'profesor_id' => 'required',
        ]);

        // Define los atributos para buscar o crear
        $attributes = [
            //'grupo_id' => $request->grupo_id,
            'materia_id' => $request->materia_id
        ];

        // Define los valores para actualizar o crear
        $values = $request->all();

        // Crear o actualizar el registro
        Grupo_Materia::updateOrCreate($attributes, $values);

        return redirect()->route('asignargrupos.index')->with('success', 'Relación Grupo-Materia creada o actualizada correctamente.');
    }


    public function edit($id)
    {
        // Obtener el grupo por su ID
        $grupo = Grupo::find($id);

        // Obtener todas las materias
        $materias = Materia::all();

        // Obtener las relaciones de grupo_materias para este grupo
        $grupoMaterias = Grupo_Materia::where('grupo_id', $id)->pluck('materia_id')->toArray();

        return view('asignargrupos.editar', compact('grupo', 'materias', 'grupoMaterias'));
    }

    public function update(Request $request, $id)
    {
        // Obtener el grupo por su ID
        $grupo = Grupo::find($id);

        // Validar la entrada
        $request->validate([
            'grupo_id' => 'required',
            'materias' => 'required|string', // Expect a string of comma-separated values
        ]);

        // Obtener los IDs de las materias desde el input hidden
        $materiasIds = explode(',', $request->input('materias'));

        // Eliminar las relaciones anteriores
        Grupo_Materia::where('grupo_id', $grupo->id)->delete();
        Grupo_Materia::whereIn('materia_id', $materiasIds)->delete();


        // Crear las nuevas relaciones
        foreach ($materiasIds as $materiaId) {
            Grupo_Materia::create([
                'grupo_id' => $grupo->id,
                'materia_id' => $materiaId,
            ]);
        }

        return redirect()->route('asignarGrupos.index')->with('success', 'Relación Grupo-Materia actualizada correctamente.');
    }



    public function destroy($id)
    {
        Grupo_Materia::where('grupo_id', $id)->delete();
        return redirect()->route('asignarGrupos.index')->with('success', 'Relación Grupo-Materia eliminada correctamente.');
    }
}
