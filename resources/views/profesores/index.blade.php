@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Profesores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-profesor')
                                <a class="btn rojo textoGB font-weight-bold" href="{{ route('profesores.create') }}" title="Crear un nuevo profesor">Nuevo Profesor</a>
                            @endcan
                            <div>
                            <br/>
                            </div>
                            <div class="table-responsive">
                                <div class="container">
                                    <table id="miTabla" class="table table-striped mt-2 col-lg-12 col-12 col-xl-12">
                                        <thead class="text-center bcgreen" style="background-color:#6777ef; font-size: 16px;">
                                            <th style="display: none;">id</th>
                                            <th style="color:#fff;">Nombre</th>
                                            <th style="color:#fff;">Apellido paterno</th>
                                            <th style="color:#fff;">Apellido materno</th>
                                            <th style="color:#fff;">Perfil</th>
                                            <th style="color:#fff;"><i class="fas fa-wrench mr-5" style="font-size: 18px;"></i>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($profesores as $profesor)
                                            <tr>
                                                <td style="display: none;">{{ $profesor->id }}</td>
                                                <td class="textoG text-center">{{ $profesor->nombre }}</td>
                                                <td class="textoG text-center">{{ $profesor->apellido_paterno }}</td>
                                                <td class="textoG text-center">{{ $profesor->apellido_materno }}</td>
                                                <td class="textoG text-center">{{ $profesor->perfil }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center ">
                                                        @can('editar-profesor')
                                                        <div class="mx-1">
                                                            <a class="btn btn-info textoGBB" style="background-color: #40cdf3; border-color: #40cdf3;" href="{{ route('profesores.edit', $profesor->id) }}"><span class="d-md-inline d-none">Editar</span><i class="fas fa-edit"></i></a>
                                                        </div>
                                                        @endcan
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('borrar-profesor')
                                                        <div class="mx-1">
                                                            <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST">
                                                                <button type="submit" class="btn btn-danger textoGBB"><span class="d-md-inline d-none">Borrar</span><i class="far fa-trash-alt"></i></button>
                                                            </form>
                                                        </div>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Ubicamos la paginación a la derecha -->
                                <div class="pagination justify-content-end d-none d-lg-block"> 
                                    {!! $profesores->links() !!}
                                </div>
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
                    { data: 'apellido_paterno' },
                    { data: 'apellido_materno' },
                    { data: 'profesion' },
                    { data: 'acciones' },
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
    <style>
        .rojo:hover{
            background-color: #EF4B7F !important;
            color: white !important;
        }
        .rojo{
            background-color: #EE6691 !important;
            color: white !important;
        }
    </style>
@endsection
