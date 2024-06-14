@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Boletas de calificaciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li style="font-size: 25px">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="GET" action="{{ route('documentos.buscar') }}">
                                <div class="form-group ">
                                    <label for="ciclo"><span  class="textoG">Ciclo:</span></label>
                                    <select class="form-control" name="ciclo" id="ciclo">
                                        @foreach($ciclos as $ciclo)
                                            <option value="{{ $ciclo->id }}" class="textoG"><span class="textoG">{{ $ciclo->nombre }}</span></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="matricula" class="textoG"><span  class="textoG">Matrícula:</span></label>
                                    <input type="number" class="form-control" name="matricula" id="matricula" required>
                                </div>
                                <button type="submit" class="btn btn-primary textoG">Buscar</button>
                            </form>
                            <br>
                            @if(isset($resultados))
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="6" class="text-center textoG">
                                                    Grupo: {{ $grupo->nombre }} <br>
                                                    Estudiante: {{ $alumno->nombre }} {{ $alumno->apellido }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="textoG">Materia</th>
                                                <th class="textoG">Primer Parcial</th>
                                                <th class="textoG">Segundo Parcial</th>
                                                <th class="textoG">Tercer Parcial</th>
                                                <th class="textoG">Promedio</th>
                                                <th class="textoG">Resultado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($resultados as $resultado)
                                                <tr>
                                                    <td class="textoG">{{ $resultado->materia->nombre }}</td>
                                                    <td class="textoG">{{ $resultado->parcial1 }}</td>
                                                    <td class="textoG">{{ $resultado->parcial2 }}</td>
                                                    <td class="textoG">{{ $resultado->parcial3 }}</td>
                                                    <td class="textoG">{{ $resultado->final }}</td>
                                                    <td class="{{ $resultado->final >= 70 ? 'text-success' : 'text-danger' }}">
                                                        {{ $resultado->final >= 70 ? 'Aprobado' : 'Reprobado' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{ route('documentos.pdf', ['alumno' => $alumno->id, 'grupo' => $grupo->id]) }}" class="btn btn-secondary mt-3 textoGB">Descargar PDF</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    