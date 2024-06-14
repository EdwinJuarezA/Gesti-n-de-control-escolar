<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alumno;
use App\Models\Calificacion;
use App\Models\Grupo;
use App\Models\Grupo_Materia;
use App\Models\Materia;

class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrar-inscripcion|administrar-inscripcion|administrar-inscripcion|administrar-inscripcion', ['only' => ['index']]);
        $this->middleware('permission:administrar-inscripcion', ['only' => ['create','store']]);
        $this->middleware('permission:administrar-inscripcion', ['only' => ['edit','update']]);
        //$this->middleware('permission:editar-alumno', ['only' => ['editar','update']]);
        $this->middleware('permission:administrar-inscripcion', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        //Obtener los primeros 5 registros de la tabla alumnos paginados
        $alumnos = Alumno::query()
        ->join('grupos', 'grupos.id', '=', 'alumnos.grupo_id')
        ->select('alumnos.id', 'alumnos.matricula', 'alumnos.nombre', 'alumnos.apellido', 'alumnos.sexo', 'alumnos.semestre', 'alumnos.especialidad', 'grupos.nombre as grupo')
        ->paginate(10);
        //Enviar los registros y los enlaces de paginación a la vista
        return view('alumnos.index', compact('alumnos'));
    }*/

    public function index()
    {

        //Obtener los primeros 5 registros de la tabla alumnos paginados
        $alumnos = Alumno::with('grupo')
        ->paginate(10);
        //Enviar los registros y los enlaces de paginación a la vista
        return view('inscripcion.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = Grupo::all(['id', 'nombre']);
        $al = Alumno::latest('matricula')->first();
        if ($al !== null) {

            $mitad = substr($al->matricula, 0, strlen($al->matricula) / 2);

            // Convertimos la mitad a un entero
            $mitadEntero = intval($mitad);
        } else {
            $mitadEntero = 0;
        }

        return view('alumnos.crear', ['mitad' => $mitadEntero]);

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
            'matricula' => 'required',
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u',
            'apellido' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u',
            'sexo' => 'required|alpha',
            'semestre' => 'required',
            'especialidad' => 'required|alpha',
            //'grupo_id' => 'required',
        ]);

        Alumno::create($request->all());
        session()->forget(['grupo_id', 'grupo_nombre']);
        return redirect()->route('alumnos.index');
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
    public function edit($id)//Alumno $alumno)
    {
        $alumno = Alumno::findOrFail($id);
        return view('inscripcion.index', compact('alumno'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);
        $this->validate($request, [
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        // Actualizar el grupo del alumno
        $alumno->update($request->all());

        // Obtener las materias del grupo al que se inscribió el alumno
        $grupoMaterias = Grupo_Materia::where('grupo_id', $request->input('grupo_id'))->get();

        // Crear las instancias de calificaciones para cada materia del grupo
        foreach ($grupoMaterias as $grupoMateria) {
            Calificacion::create([
                'alumno_id' => $alumno->id,
                'asignar_id' => $grupoMateria->id,
                'parcial1' => 0,
                'parcial2' => 0,
                'parcial3' => 0,
                'final' => 0
            ]);
        }

        session()->forget(['grupo_id', 'grupo_nombre']);
        return redirect()->route('inscripciones.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index');
    }
}
