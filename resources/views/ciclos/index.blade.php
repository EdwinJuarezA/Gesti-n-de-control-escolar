@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ciclos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-ciclo')
                                <a class="btn btn-warning textoGB font-weight-bold" href="{{ route('ciclos.create') }}" title="Crear nuevo ciclo">Nuevo Ciclo</a>
                            @endcan

                            <table id="miTablaAlumnos" class="table table-striped mt-2 col-lg-11 col-11 col-xl-11">
                                <thead class="text-center bcgreen" style="background-color:#6777ef; font-size: 16px;"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Inicio</th> 
                                    <th style="color:#fff;">Fin</th>                                      
                                    <th style="color:#fff;"><i class="fas fa-wrench mr-5" style="font-size: 18px;"></i>Acciones</th>                                                                    
                                </thead>
                                <tbody>
                                    @foreach ($ciclos as $ciclo)
                                    <tr>
                                        <td style="display: none;">{{ $ciclo->id }}</td> 
                                        <td class="textoG text-center">{{ $ciclo->nombre }}</td>                               
                                        <td class="textoG text-center">{{ $ciclo->inicio }}</td>
                                        <td class="textoG text-center">{{ $ciclo->fin }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('ciclos.destroy', $ciclo->id) }}" method="POST">   
                                            <div class="d-flex justify-content-center ">                                     
                                                @can('editar-ciclo')
                                                <div class="mx-1">
                                                <a class="btn btn-info textoGBB" style="background-color: #40cdf3; border-color: #40cdf3;" href="{{ route('ciclos.edit', $ciclo->id) }}">
                                                <span class="d-md-inline d-none">Editar</span><i class="fas fa-edit"></i>
                                                </a>
                                                </div>
                                                @endcan

                                                @csrf
                                                <div class="mx-1">
                                                @method('DELETE')
                                                @can('borrar-ciclo')
                                                <button type="submit" class="btn btn-danger" style="display: inline;"><span class="d-md-inline d-none textoGBB">Borrar</span>
                                                    <i class="far fa-trash-alt"></i></button>
                                                </div>
                                                @endcan
                                            </div></form>
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