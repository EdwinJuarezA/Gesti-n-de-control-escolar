@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Calificaciones por grupo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="miTablaAlumnos" class="table table-striped mt-2">
                                <thead class="text-end bcgreen" style="background-color:#6777ef; font-size: 16px"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Ciclo</th>
                                    <th style="color:#fff;">Grupo</th> 
                                    <th style="color:#fff;">Materia</th> 
                                    <th style="color:#fff;"># Alumnos</th> 
                                    <th style="color:#fff;">Acciones</th>                                                                     
                                </thead>
                                <tbody>
                                    @foreach ($result as $re)
                                    <tr style="font-size: 18px">
                                        <td style="display: none;">{{ $re->id }}</td> 
                                        <td>{{ $re->ciclo }}</td>                     
                                        <td>{{ $re->grupo }}</td>           
                                        <td>{{ $re->materia }}</td>
                                        <td>{{ $re->alumnos_count }}</td>
                                        <td>
                                            <form action="{{ route('calificaciones.index') }}" method="GET">                                        
                                                @can('ver-calificacion')
                                                <a class="btn btn-info" href="{{ route('verGrupos', ['grupo' => $re->grupo, 'materia' => $re->materia]) }}" style="font-size: 18px">
                                                    <i class="fas fa-users"></i> Ver
                                                </a>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $result->links() !!}
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
                    { data: 'ciclo' },
                    { data: 'grupo' },
                    { data: 'materia' },
                    { data: 'alumnos_count' },
                    { data: 'acciones' }
                    
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection