@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Materias</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="miTabla" class="table table-striped mt-2">
                                <thead style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Clave_curso</th>
                                    <th style="color:#fff;">Nombre</th> 
                                    <th style="color:#fff;">Semestre</th>                                    
                                    <th style="color:#fff;">Creditos</th>
                                    <th style="color:#fff;">acciones</th>                                                                    
                                </thead>
                                <tbody>
                                    @foreach ($materias as $materia)
                                    <tr>
                                        <td style="display: none;">{{ $materia->id }}</td> 
                                        <td>{{ $materia->clave_curso }}</td>                               
                                        <td>{{ $materia->nombre }}</td>
                                        <td>{{ $materia->semestre }}</td>
                                        <td>{{ $materia->creditos }}</td>
                                        <td>
                                            <a href="{{ route('seleccionar.materia', $materia->id) }}" class="btn btn-primary">Seleccionar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ubicamos la paginación a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $materias->links() !!}
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
                    { data: 'clave_curso' },
                    { data: 'nombre' },
                    { data: 'semestre' },
                    { data: 'creditos' },
                    { data: 'acciones' }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection