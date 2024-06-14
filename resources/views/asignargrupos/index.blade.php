@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Asignar materia a grupo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{--@can('crear-grupoMateria')
                                <!--a class="btn btn-warning textoGB font-weight-bold" href="{{ route('asignarGrupos.create') }}" title="Crear nueva grupoMateria">Nueva relación</a-->
                            @endcan--}}
                            <div>
                            <br/>
                            </div>
                            <table id="miTablaAlumnos" class="table table-striped mt-2">
                                <thead class="text-center textoG bcgreen" style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Ciclo</th>
                                    <th style="color:#fff;">Nombre</th> 
                                    <th style="color:#fff;">Materias</th> 
                                    <th style="color:#fff;"><i class="fas fa-wrench mr-5" style="font-size: 18px;"></i>Acciones</th>                                                                     
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                    <tr>
                                        <td style="display: none;">{{ $grupo->id }}</td> 
                                        <td class="textoG text-center">{{ $grupo->ciclo }}</td>                               
                                        <td class="textoG text-center">{{ $grupo->nombre }}</td>
                                        <td>
                                        <div class="table-responsive">
                                        @php
                                $materiasAsignadas = $grupoMaterias->where('grupo_id', $grupo->id);
                            @endphp
                            @if($materiasAsignadas->isEmpty())
                                Sin materias asignadas
                            @else
                                @foreach($materiasAsignadas as $grupoMateria)
                                    {{ $grupoMateria->materia->nombre }}<br>
                                @endforeach
                            @endif
                                        </div>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('asignarGrupos.destroy', $grupo->id) }}" method="POST">  
                                            
                                        
                                            <div class="d-flex justify-content-center">
                                                @can('administrar-materias-asignadas')
                                                <div class="mx-1">
                                                <a class="btn btn-info textoGBB" style="background-color: #40cdf3; border-color: #40cdf3;" href="{{ route('asignarGrupos.edit', $grupo->id) }}">
                                                <span class="d-md-inline d-none">Editar</span><i class="fas fa-edit"></i>
                                                </a>
                                                </div>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $grupos->links() !!}
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
                    { data: 'materias' },
                    { data: 'acciones' }
                    
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection