@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Grupos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-ciclo')
                                <a class="btn btn-warning textoGB font-weight-bold" href="{{ route('grupos.create') }}" title="Crear nuevo grupo">Nuevo Grupo</a>
                            @endcan
                            <div>
                            <br/>
                            </div>
                            <table id="miTablaAlumnos" class="table table-striped mt-2">
                                <thead class="text-center textoG bcgreen" style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Ciclo</th>
                                    <th style="color:#fff;">Nombre</th> 
                                    <th style="color:#fff;"><i class="fas fa-wrench mr-5" style="font-size: 18px;"></i>Acciones</th>                                                                     
                                </thead>
                                <tbody>
                                    @foreach ($grupoMaterias as $grupo)
                                    <tr>
                                        <td style="display: none;">{{ $grupo->id }}</td> 
                                        <td class="textoG text-center">{{ $grupo->profesor_id }}</td>                               
                                        <td class="textoG text-center">{{ $grupo->materia_id }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST">  
                                            <div class="d-flex justify-content-center">
                                                @can('editar-grupo')
                                                <div class="mx-1">
                                                <a class="btn btn-info textoGBB" style="background-color: #40cdf3; border-color: #40cdf3;" href="{{ route('grupos.edit', $grupo->id) }}">
                                                <span class="d-md-inline d-none">Editar</span><i class="fas fa-edit"></i>
                                                </a>
                                                </div>
                                                @endcan

                                                @csrf
                                                <div class="mx-1">
                                                @method('DELETE')
                                                @can('borrar-grupo')
                                                <button type="submit" class="btn btn-danger" style="display: inline;"><span class="d-md-inline d-none textoGBB">Borrar</span>
                                                    <i class="far fa-trash-alt"></i></button>
                                                </div>
                                                @endcan
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $grupoMaterias->links() !!}
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
                    { data: 'nombre' },
                    { data: 'acciones' }
                    
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection