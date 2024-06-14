<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use App\Models\QRCode as QRCodeModel;
use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Asistencia;
use App\Models\Grupo;
use Carbon\Carbon;

class LectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrar-tomar-asistencia', ['only' => ['index','show','create','store','edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclos = Ciclo::all();
        return view('lectores.index', compact('ciclos'));
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
        // Obtener el alumno por su ID
        $alumno = Alumno::findOrFail($id);

        // Obtener todas las asistencias de este alumno
        $asistencias = Asistencia::where('alumno_id', $alumno->id)->paginate(10);

        // Generar el QR Code para el número de control del alumno
        $alumno->qr_code = QrCode::size(100)->generate($alumno->matricula);

        // Retornar la vista con los datos del alumno y sus asistencias
        return view('asistencias.show', compact('alumno', 'asistencias'));
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

    public function obtenerAlumno($matricula)
    {
        // Buscar al alumno por su matrícula
        $alumno = Alumno::where('matricula', $matricula)->first();

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        return response()->json(['alumnoId' => $alumno->id]);
    }

    public function obtenerUltimoCiclo()
    {
        // Obtener el último ciclo registrado
        $ultimoCiclo = Ciclo::latest()->first();

        if (!$ultimoCiclo) {
            return response()->json(['error' => 'No hay ciclos registrados'], 404);
        }

        return response()->json(['cicloId' => $ultimoCiclo->id]);
    }

    public function registrarAsistencia(Request $request)
    {
        $alumno = Alumno::where('matricula', $request->matricula)->first();
        
        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        $fechaHoy = Carbon::today()->toDateString();
        $asistenciaExistente = Asistencia::where('alumno_id', $alumno->id)
                                         ->where('fecha', $fechaHoy)
                                         ->first();
        
        if ($asistenciaExistente) {
            return response()->json(['error' => 'Asistencia ya registrada para hoy'], 400);
        }

        Asistencia::create([
            'alumno_id' => $alumno->id,
            'ciclo_id' => $request->ciclo_id,
            'fecha' => $fechaHoy,
        ]);

        return response()->json(['success' => 'Asistencia registrada exitosamente']);
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

    public function obtenerAlumnoPorMatricula($matricula)
    {
        $alumno = Alumno::where('matricula', $matricula)->first();

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        return response()->json([
            'nombre' => $alumno->nombre,
            'apellido' => $alumno->apellido,
            'matricula' => $alumno->matricula,
        ]);
    }

}
