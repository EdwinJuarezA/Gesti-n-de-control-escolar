<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;

class ProfesorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-profesor|crear-profesor|editar-profesor|borrar-profesor', ['only' => ['index']]);
        $this->middleware('permission:crear-profesor', ['only' => ['create','store']]);
        $this->middleware('permission:editar-profesor', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-profesor', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
         //Obtener los primeros 5 registros de la tabla materias paginados
        $profesores = Profesor::paginate(10);
        //Enviar los registros y los enlaces de paginación a la vista
        return view('profesores.index', compact('profesores'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profesores.crear');
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
        'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñ\s]+$/u',
        'apellido_paterno' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñ\s]+$/u',
        'apellido_materno' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñ\s]+$/u',
        'perfil' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u',
        ]);
    
        Profesor::create($request->all());
    
        return redirect()->route('profesores.index');
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
        $profesor = Profesor::findOrFail($id);
        return view('profesores.editar', compact('profesor'));
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
        $profesor = Profesor::findOrFail($id);
        $this->validate($request, [
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓñÚ\s]+$/u',
            'apellido_paterno' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñ\s]+$/u',
            'apellido_materno' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñ\s]+$/u',
            'perfil' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñ\s]+$/u',
        ]);

        $profesor->update($request->all());

        return redirect()->route('profesores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesor $profesor)
    {
        $profesor->delete();
        return redirect()->route('profesores.index');
    }
}
