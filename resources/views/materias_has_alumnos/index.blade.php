@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Calificaciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('inscribir-alumno')
                                <a class="btn btn-warning" href="{{ route('materias_has_alumnos.create') }}" title="Crear nueva materia">Inscribir Alumno</a>
                            @endcan

                            <table id="miTablaCalificaciones" class="table table-striped mt-2">
                                <thead style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Alumno</th>
                                    <th style="color:#fff;">Materia</th>
                                    <th style="color:#fff;">Estado</th> <!-- Nueva columna -->
                                    <th style="color:#fff;">Calificacion</th> 
                                    <th style="color:#fff;">acciones</th>                                                                  
                                </thead>
                                <tbody>
                                    @foreach ($materias_has_alumnos as $materia_has_alumno)
                                    <tr>
                                        <td style="display: none;">{{ $materia_has_alumno->id }}</td> 
                                        <td>{{ $materia_has_alumno->alumno }}</td>                               
                                        <td>{{ $materia_has_alumno->materia }}</td>
                                        <td>
                                            @if($materia_has_alumno->calificacion >= 70)
                                                Aprobado
                                            @else
                                                Reprobado
                                            @endif
                                        </td>
                                        <td>{{ $materia_has_alumno->calificacion }}</td>
                                        <td>
                                            <form action="{{ route('materias_has_alumnos.destroy', $materia_has_alumno->id) }}" method="POST">                                        
                                                @can('editar-calificacion')
                                                    <a class="btn btn-info" href="{{ route('materias_has_alumnos.edit', $materia_has_alumno->id) }}">Editar</a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('eliminar-inscripcion')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ubicamos la paginación a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $materias_has_alumnos->links() !!}
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
            new DataTable('#miTablaCalificaciones', {
                lengthMenu: [
                    [5, 10],
                    [5, 10]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'alumno' },
                    { data: 'materia' },
                    { data: 'estado' }, // Nueva columna para el estado
                    { data: 'calificacion' },
                    { data: 'acciones' }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection