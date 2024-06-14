@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inscribir Alumno</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="miTablaInscripcionCalificacion" class="table table-striped mt-2">
                                <thead style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Apellidos</th> 
                                    <th style="color:#fff;">acciones</th>                                                                    
                                </thead>
                                <tbody>
                                    @foreach ($alumnos as $alumno)
                                    <tr>
                                        <td style="display: none;">{{ $alumno->id }}</td> 
                                        <td>{{ $alumno->nombre }}</td>                               
                                        <td>{{ $alumno->apellido }}</td>
                                        <td>
                                            @can('inscribir-alumno')
                                            <a class="btn btn-success" href="{{ route('alumnos.editar', $alumno->id) }}">Inscribir</a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $alumnos->links() !!}
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
            new DataTable('#miTablaInscripcionCalificacion', {
                lengthMenu: [
                    [5, 10],
                    [5, 10]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'nombre' },
                    { data: 'apellido' },
                    { data: 'acciones' }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection