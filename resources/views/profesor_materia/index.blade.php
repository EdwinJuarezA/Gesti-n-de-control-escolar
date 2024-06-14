@extends('layouts.app')

@section('title', 'Programar grupoMaterias')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Asignar profesor a las materias</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                            @can('crear-grupoMateria')
                            @endcan
                            <div>
                            <br/>
                            </div>
                            <br/>
                            <div class="table-responsive">
                                <div class="container">
                            <table id="miTabla" class="table table-striped mt-2 col-lg-12 col-12 col-xl-12">
                                <thead class="text-center bcgreen" style="background-color:#6777ef; font-size: 16px;"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Clave_curso</th>
                                    <th style="color:#fff;">Nombre</th> 
                                    <th style="color:#fff;">Semestre</th>                                    
                                    <th style="color:#fff;">Profesor</th>
                                    <th style="color:#fff;"><i class="fas fa-wrench mr-1" style="font-size: 18px;"></i>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($grupoMaterias as $grupoMateria)
                                    <tr>
                                        <td style="display: none;">{{ $grupoMateria->id }}</td> 
                                        <td class="textoG text-center">{{ $grupoMateria->clave_curso }}</td>  
                                        <td class="textoG text-center">{{ $grupoMateria->nombre_materia }}</td>  
                                        <td class="textoG text-center">{{ $grupoMateria->semestre_materia }}</td>  
                                        <td class="textoG text-center">{{ $grupoMateria->nombre_profesor ?? 'No asignado' }}</td>  
                                        <td class="text-center">
                                        <form action="{{ route('profesor_materias.destroy', $grupoMateria->id) }}" method="POST">  
                                            
                                        
                                            <div class="d-flex justify-content-center">
                                                @can('asignar-profesor')
                                                <div class="mx-1">
                                                <a class="btn btn-info textoGBB" style="background-color: #40cdf3; border-color: #40cdf3;" href="{{ route('profesor_materias.edit', $grupoMateria->id) }}">
                                                <span class="d-md-inline d-none">Editar</span><i class="fas fa-edit"></i>
                                                </a>
                                                </div>
                                                @endcan

                                                @csrf
                                            </form>
                                            </div>


                                            <div class="d-flex justify-content-center ">
                                                @can('editar-materia')
                                                <!--div class="mx-1">
                                                <a class="btn btn-info textoGBB" style="background-color: #40cdf3; border-color: #40cdf3;" href="{{-- route('profesor_materia.seleccionar.profesor', $grupoMaterias) --}}"><span class="d-md-inline d-none">Asingar profesor</span><i class="fas fa-edit"></i></a>
                                                </div-->
                                                @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ubicamos la paginación a la derecha -->
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