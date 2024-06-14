<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclo;
use App\Models\Alumno;
use App\Models\Calificacion;
use App\Models\Grupo;
use PDF;

class DocumentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:administrar-boletas', ['only' => ['index']]);
    }

    public function index()
    {
        $ciclos = Ciclo::all();
        return view('documentos.index', compact('ciclos'));
    }

    public function buscar(Request $request)
    {
        $ciclo_id = $request->input('ciclo');
        $matricula = $request->input('matricula');

        // Buscar alumno por matrícula
        $alumno = Alumno::where('matricula', $matricula)->first();

        if (!$alumno) {
            return redirect()->back()->withErrors('Alumno no encontrado');
        }

        // Verificar que el alumno pertenece al ciclo seleccionado
        if (!$alumno->grupo || $alumno->grupo->ciclo_id != $ciclo_id) {
            return redirect()->back()->withErrors('No se encontró el grupo para el alumno en el ciclo seleccionado');
        }

        // Obtener el grupo del alumno
        $grupo = $alumno->grupo;

        // Obtener las calificaciones del alumno en el ciclo seleccionado
        $resultados = Calificacion::where('alumno_id', $alumno->id)
            ->with('materia')
            ->get();

        $ciclos = Ciclo::all();
        return view('documentos.index', compact('ciclos', 'resultados', 'grupo', 'alumno'));
    }

    public function generarPDF(Alumno $alumno, Grupo $grupo)
    {
        $resultados = Calificacion::where('alumno_id', $alumno->id)
            ->with('materia')
            ->get();
    
        $pdf = PDF::loadView('documentos.pdf', compact('alumno', 'grupo', 'resultados'));
        return $pdf->download('boleta_calificaciones.pdf');
    }    
}
