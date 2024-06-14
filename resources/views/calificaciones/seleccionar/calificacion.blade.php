@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">{{$calificaciones-> grupo}} {{$calificaciones ->materia}}}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-ciclo')
                                <a class="btn btn-warning" href="{{ route('calificacion.create') }}" title="Crear nueva inscripcion">Insertar Calificacion</a>
                            @endcan

                            <table id="miTablaAlumnos" class="table table-striped mt-2">
                                <tr style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Grupo</th> 
                                    <th style="color:#fff;">Materia</th> 
                                    <th style="color:#fff;">Alumno</th>                                      
                                    <th style="color:#fff;">Parcial 1</th>
                                    <th style="color:#fff;">Parcial 2</th>
                                    <th style="color:#fff;">Parcial 3</th>
                                    <th style="color:#fff;">Final</th>
                                    <th style="color:#fff;">Acciones</th>                                                                     
                                </tr>
                                <tbody>
                                    <@foreach ($calificaciones as $cal)
                                    <tr>
                                        <td style="display: none;">{{ $cal->id }}</td> 
                                        <td>{{ $cal->grupo }}</td>                     
                                        <td>{{ $cal->materia }}</td>           
                                        <td>{{ $cal->alumno }}</td>
                                        <td>{{ $cal->parcial1 }}</td>
                                        <td>{{ $cal->parcial2 }}</td>
                                        <td>{{ $cal->parcial3 }}</td>
                                        <td>{{ $cal->final }}</td>
                                        <td>
                                            <form action="{{ route('calificaciones.destroy', $cal->id) }}" method="POST">                                        
                                                @can('editar-calificacion')
                                                <a class="btn btn-info" href="{{ route('calificaciones.edit', $cal->id) }}">Editar</a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('borrar-calificacion')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $calificaciones->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            new DataTable('#miTablaAlumnos', {
                lengthMenu: [
                    [5, 10],
                    [5, 10]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'materia' },
                    { data: 'grupo' },
                    { data: 'alumno' },
                    { data: 'parcial1' },
                    { data: 'parcial2' },
                    { data: 'parcial3' },
                    { data: 'final' },
                    { data: 'acciones' }
                    
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection