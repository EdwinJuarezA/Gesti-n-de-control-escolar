<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo_Materia;

class GrupoMateriaController extends Controller
{
    //
    public function index()
    {
        $grupoMaterias = Grupo_Materia::paginate(10);
        return view('grupo_materia.index', compact('grupoMaterias'));
    }

    public function create()
    {
        return view('grupo_materias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            //'grupo_id' => 'required',
            'materia_id' => 'required',
            'profesor_id' => 'required',
        ]);

        Grupo_Materia::create($request->all());

        //return redirect()->route('grupo_materias.index')->with('success', 'Relación Grupo-Materia creada correctamente.');
    }

    public function edit($id)
    {
        $grupoMateria = Grupo_Materia::find($id);
        return view('grupo_materias.edit', compact('grupoMateria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'grupo_id' => 'required',
            'materia_id' => 'required',
            'profesor_id' => 'required',
        ]);

        $grupoMateria = Grupo_Materia::find($id);
        $grupoMateria->update($request->all());

        return redirect()->route('grupo_materias.index')->with('success', 'Relación Grupo-Materia actualizada correctamente.');
    }

    public function destroy($id)
    {
        Grupo_Materia::destroy($id);
        return redirect()->route('grupo_materias.index')->with('success', 'Relación Grupo-Materia eliminada correctamente.');
    }
}
