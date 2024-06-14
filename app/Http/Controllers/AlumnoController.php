<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Materia;

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-alumno|crear-alumno|editar-alumno|borrar-alumno', ['only' => ['index']]);
        $this->middleware('permission:crear-alumno', ['only' => ['create','store']]);
        $this->middleware('permission:editar-alumno', ['only' => ['edit','update']]);
        //$this->middleware('permission:editar-alumno', ['only' => ['editar','update']]);
        $this->middleware('permission:borrar-alumno', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener los primeros 5 registros de la tabla alumnos paginados
        $alumnos = Alumno::query()
        ->select('alumnos.id', 'alumnos.matricula', 'alumnos.nombre', 'alumnos.apellido', 'alumnos.sexo', 'alumnos.semestre', 'alumnos.especialidad')
        ->paginate(10);
        //Enviar los registros y los enlaces de paginación a la vista
        return view('alumnos.index', compact('alumnos'));
    }

    public function obtenerAlumno($matricula)
    {
        // Buscar al alumno por su matrícula
        $alumno = Alumno::where('matricula', $matricula)->first();

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        return response()->json(['alumnoId' => $alumno->id]);
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

            $mitad = substr($al->matricula, 4, strlen($al->matricula) / 2);

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
        return view('alumnos.editar', compact('alumno'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//Alumno $alumno)
    {
        $alumno = Alumno::findOrFail($id);
        $this->validate($request, [
            'matricula' => 'required',
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u',
            'apellido' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u',
            'sexo' => 'required',
            'semestre' => 'required',
            'especialidad' => 'required',
            //'grupo_id' => 'required',
        ]);

        $alumno->update($request->all());
        session()->forget(['grupo_id', 'grupo_nombre']);
        return redirect()->route('alumnos.index');
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
