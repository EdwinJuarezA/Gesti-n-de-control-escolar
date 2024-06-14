@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Profesores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="miTabla" class="table table-striped mt-2">
                                <thead style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Nombre</th> 
                                    <th style="color:#fff;">Apellidos</th>
                                    <th style="color:#fff;">Profesion</th>
                                    <th style="color:#fff;">Acciones</th>                                                                   
                                </thead>
                                <tbody>
                                    @foreach ($profesores as $profesor)
                                    <tr>
                                        <td style="display: none;">{{ $profesor->id }}</td>                              
                                        <td>{{ $profesor->nombre }}</td>
                                        <td>{{ $profesor->apellidos}}</td>
                                        <td>{{ $profesor->profesion}}</td>
                                        <td>
                                            <a href="{{ route('seleccionar.profesor', $profesor->id) }}" class="btn btn-primary">Seleccionar</a>
                                        </td>
                                    </tr>   
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ubicamos la paginación a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $profesores->links() !!}
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
            new DataTable('#miTabla', {
                lengthMenu: [
                    [5, 10],
                    [5, 10]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'nombre' },
                    { data: 'apellidos' },
                    { data: 'profesion' },
                    { data: 'acciones' },
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection