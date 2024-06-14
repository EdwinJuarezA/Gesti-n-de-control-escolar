<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclo;

class CicloController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-ciclo|crear-ciclo|editar-ciclo|borrar-ciclo', ['only' => ['index']]);
        $this->middleware('permission:crear-ciclo', ['only' => ['create','store']]);
        $this->middleware('permission:editar-ciclo', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-ciclo', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener los primeros 5 registros de la tabla materias paginados
        $ciclos = Ciclo::paginate(10);
        //Enviar los registros y los enlaces de paginación a la vista
        return view('ciclos.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ciclos.crear');
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
        'nombre' => 'required',
        'inicio' => 'required',
        'fin' => 'required',
        ]);

        Ciclo::create($request->all());

        return redirect()->route('ciclos.index');
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
    public function edit($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        return view('ciclos.editar', compact('ciclo'));
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
        $ciclo = Ciclo::findOrFail($id);
        $this->validate($request, [
            'nombre' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
        ]);

        $ciclo->update($request->all());

        return redirect()->route('ciclos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciclo $ciclo)
    {
        $ciclo->delete();
        return redirect()->route('ciclos.index');
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

}
