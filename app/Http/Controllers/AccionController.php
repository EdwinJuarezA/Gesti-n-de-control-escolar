<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accion;
class AccionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-historial', ['only' => ['index']]);
    }
    public function index()
    {       
        $acciones = Accion::paginate(10);
        //Enviar los registros y los enlaces de paginación a la vista
        return view('acciones.index', compact('acciones'));   
    }
}
