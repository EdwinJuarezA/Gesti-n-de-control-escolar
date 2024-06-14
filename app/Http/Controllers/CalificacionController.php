<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grupo;
use App\Models\Grupo_Materia;
use App\Models\Alumno;
use App\Models\Calificacion;
use App\Models\Materia;

class CalificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-calificacion|crear-calificacion|editar-calificacion|eliminar-calificacion')->only('index');
        $this->middleware('permission:crear-calificacion', ['only' => ['create','store']]);
        $this->middleware('permission:editar-calificacion', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-calificacion', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = DB::table('grupo_materias as gm')
            ->join('grupos as g', 'gm.grupo_id', '=', 'g.id')
            ->join('ciclos as c', 'g.ciclo_id', '=', 'c.id')
            ->join('materias as m', 'gm.materia_id', '=', 'm.id')
            ->select(
                'gm.id',
                'g.nombre as grupo',
                'c.nombre as ciclo',
                'm.nombre as materia',
                DB::raw('(SELECT COUNT(*) FROM alumnos a 
                        JOIN calificaciones cal ON a.id = cal.alumno_id 
                        WHERE cal.asignar_id = gm.id) as alumnos_count')
            )
            ->paginate(10);

            return view('calificaciones.seleccionar.verGruposMaterias', compact('result'));
    }

    public function create(Request $request)
    {
        return view('calificaciones.crear');//, compact('calificacion', 'alumno', 'materia'));
    }

    public function store(Request $request)
    {   // Validar los datos del formulario
        $request->validate([
            'grupo_id' => 'required|exists:grupo,id',
            'alumno_id' => 'required|exists:alumno,id',
            'materia_id' => 'required|exists:materia,id',
            'parcial1' => 0,
            'parcial2' => 0,
            'parcial3' => 0,
            'final' => 0,
        ]);
        // Crear el grupo
        Calificacion::create($request->all());
        session()->forget(['grupo_id', 'grupo_nombre', 'alumno_id', 'alumno_nombre', 'materia_id']);
        // Redireccionar al índice con un mensaje
        return redirect()->route('calificacion.index')->with('success', 'calificacion creado con éxito.');
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

    public function edit($id)
    {
        $calificacion = Calificacion::with(['alumno', 'grupoMateria.materia'])->findOrFail($id);
        return view('calificaciones.editar', compact('calificacion'));
    }    

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'parcial1' => 'required|numeric|min:0|max:100',
            'parcial2' => 'required|numeric|min:0|max:100',
            'parcial3' => 'required|numeric|min:0|max:100',
        ]);
    
        $calificacion = Calificacion::find($id);
        
        // Calcular la calificación final
        $final = ($request->input('parcial1') + $request->input('parcial2') + $request->input('parcial3')) / 3;
    
        // Actualizar la calificación
        $calificacion->update([
            'parcial1' => $request->input('parcial1'),
            'parcial2' => $request->input('parcial2'),
            'parcial3' => $request->input('parcial3'),
            'final' => $final,
        ]);
    
        session()->forget(['parcial1', 'parcial2', 'parcial3']);
        return redirect()->route('calificaciones.index')->with('success', 'Calificación actualizada.');
    }
    

    public function destroy($id)
    {
        Calificacion::destroy($id);
        return redirect()->route('calificaciones.index')->with('success', 'Calificación eliminada.');
    }

    public function getGrupoMaterias(Request $request)
    {
        $grupo = $request->input('grupo');
        $materia = $request->input('materia');
    
        // Obtener el grupo-materia para acceder al estatus y al profesor
        $grupoMateria = Grupo_Materia::with(['grupo', 'materia', 'profesor'])
            ->whereHas('grupo', function ($query) use ($grupo) {
                $query->where('nombre', $grupo);
            })->whereHas('materia', function ($query) use ($materia) {
                $query->where('nombre', $materia);
            })->first();
    
        // Si no se encuentra el grupo-materia, redirigir con un error
        if (!$grupoMateria) {
            return redirect()->back()->with('error', 'No se encontró el grupo-materia especificado.');
        }
    
        $calificaciones = Calificacion::join('grupo_materias', 'grupo_materias.id', '=', 'calificaciones.asignar_id')
            ->join('grupos', 'grupos.id', '=', 'grupo_materias.grupo_id')
            ->join('materias', 'materias.id', '=', 'grupo_materias.materia_id')
            ->join('alumnos', 'alumnos.id', '=', 'calificaciones.alumno_id')
            ->select(
                'calificaciones.id',
                'grupos.nombre as grupo',
                'materias.nombre as materia',
                DB::raw('CONCAT(alumnos.nombre, " ", alumnos.apellido) as alumno'),
                'calificaciones.parcial1',
                'calificaciones.parcial2',
                'calificaciones.parcial3',
                'calificaciones.final',
                'grupo_materias.estatus'
            )
            ->where('grupos.nombre', $grupo)
            ->where('materias.nombre', $materia)
            ->paginate(10);
    
        return view('calificaciones.index', compact('calificaciones', 'grupo', 'materia', 'grupoMateria'));
    }    
    
    public function updatePartialScore(Request $request)
    {
        $calificacion = Calificacion::find($request->id);
        $grupoMateria = Grupo_Materia::where('id', $calificacion->asignar_id)->first();
    
        foreach ($request->changes as $field => $value) {
            $calificacion->$field = $value;
        }
    
        // Actualizar el estatus si se permite
        if ($grupoMateria->estatus < 4) {
            $grupoMateria->estatus += 1;
            $grupoMateria->save();
        }

        if ($grupoMateria->estatus == 5) {
            $grupoMateria->estatus = 4;
            $grupoMateria->save();
        }
    
        // Calcular la calificación final si aplicable
        if ($calificacion->parcial1 < 70 || $calificacion->parcial2 < 70 || $calificacion->parcial3 < 70) {
            $calificacion->final = 0;
        } else {
            $calificacion->final = ($calificacion->parcial1 + $calificacion->parcial2 + $calificacion->parcial3) / 3;
        }
    
        $calificacion->save();
    
        return response()->json(['newFinal' => $calificacion->final, 'newStatus' => $grupoMateria->estatus]);
    }
    
    public function resetStatus(Request $request)
    {
        $grupoMateria = Grupo_Materia::find($request->id);
    
        if ($request->password === '12345') {
            $grupoMateria->estatus = 5;
            $grupoMateria->save();
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Clave de acceso incorrecta']);
    }       
}
