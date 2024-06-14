@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ciclos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="miTablaAlumnos" class="table table-striped mt-2">
                                <thead style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Inicio</th> 
                                    <th style="color:#fff;">Fin</th>                                      
                                    <th style="color:#fff;">Acciones</th>                                                                    
                                </thead>
                                <tbody>
                                    @foreach ($ciclos as $ciclo)
                                    <tr>
                                        <td style="display: none;">{{ $ciclo->id }}</td> 
                                        <td>{{ $ciclo->nombre }}</td>                               
                                        <td>{{ $ciclo->inicio }}</td>
                                        <td>{{ $ciclo->fin }}</td>
                                        <td>
                                            @can('editar-ciclo')
                                                <a href="{{ route('seleccionar.ciclo', $ciclo->id) }}" class="btn btn-primary">Seleccionar</a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $ciclos->links() !!}
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
                    { data: 'nombre' },
                    { data: 'inicio' },
                    { data: 'fin' },
                    { data: 'acciones' }
                    
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection
