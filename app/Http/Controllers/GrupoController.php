<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Grupo_Materia;
use App\Models\Profesor;
use App\Models\Ciclo;
use App\Models\Materia;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-grupo|crear-grupo|editar-grupo|eliminar-grupo')->only('index');
        $this->middleware('permission:crear-grupo', ['only' => ['create','store']]);
        $this->middleware('permission:editar-grupo', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-grupo', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Con paginación
        $grupos = Grupo::query()
        ->join('ciclos', 'ciclos.id', '=', 'grupos.ciclo_id')
        ->select('grupos.id', 'grupos.nombre as nombre', 'ciclos.nombre as ciclo')
        ->paginate(10);
        return view('grupos.index', compact('grupos'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $blogs->links() !!}
    }

    public function create()
    {
        // Obtener los datos necesarios para el formulario, como profesores, ciclos y materias
        $ciclos = Ciclo::all(['id', 'nombre']);
        // Pasar los datos a la vista
        return view('grupos.crear', compact('ciclos'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'ciclo_id' => 'required|exists:ciclos,id',
        ]);

        // Crear el grupo
        Grupo::create($request->all());
        session()->forget(['grupo_ciclo_id', 'grupo_ciclo_nombre']);
        // Redireccionar al índice con un mensaje
        return redirect()->route('grupos.index')->with('success', 'Grupo creado con éxito.');
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        $ciclos = Ciclo::all(); // Asegúrate de importar el modelo Ciclo si no está importado
        return view('grupos.editar', compact('grupo', 'ciclos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'ciclo_id' => 'required|exists:ciclos,id',
        ]);

        $grupo = Grupo::findOrFail($id);
        $grupo->update($request->all());
        session()->forget(['grupo_ciclo_id', 'grupo_ciclo_nombre']);
        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado con éxito.');
    }

    public function destroy($id)
    {
        $grupo = Grupo::findOrFail($id);

        // Comprobar si el grupo tiene relaciones en grupo_estudiante
        if ($grupo->grupoEstudiantes()->count() > 0) {
            return redirect()->route('grupos.index')->with('error', 'El grupo tiene estudiantes asignados y no puede ser eliminado.');
        }

        $grupo->delete();
        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado con éxito.');
    }
}
