<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Materia;
use App\Models\Grupo_Materia;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-materia|crear-materia|editar-materia|borrar-materia', ['only' => ['index']]);
        $this->middleware('permission:crear-materia', ['only' => ['create','store']]);
        $this->middleware('permission:editar-materia', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-materia', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener los primeros 5 registros de la tabla materias paginados
        $materias = Materia::paginate(10);
        //Enviar los registros y los enlaces de paginación a la vista
        return view('materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materias.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'clave_curso' => 'required|regex:/^[a-zA-Z0-9-]+$/|unique:materias,clave_curso',
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñ\s]+$/u|unique:materias,nombre',
            'semestre' => 'required|numeric|between:1,6',
            'creditos' => 'required|numeric|between:1,6',
        ]);
    
        Materia::create($request->all());
    
        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Materia $materia)
    {
        return view('materias.editar', compact('materia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia)
    {
        $this->validate($request, [
            'clave_curso' => 'required|regex:/^[a-zA-Z0-9-]+$/|unique:materias,clave_curso,'.$materia->id,
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñ\s]+$/u|unique:materias,nombre,'.$materia->id,
            'semestre' => 'required|numeric|between:1,6',
            'creditos' => 'required|numeric|between:1,6',
        ]);
    
        $materia->update($request->all());
    
        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        \DB::table('grupo_materias')->where('materia_id', $materia->id)->delete();

        $materia->delete();
        return redirect()->route('materias.index');
    }
}
