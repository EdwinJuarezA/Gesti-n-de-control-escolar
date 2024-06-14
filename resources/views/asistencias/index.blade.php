@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Asistencia</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{--@can('crear-alumno')
                                <!--a class="btn btn-warning textoGB font-weight-bold" href="{{ route('alumnos.create') }}" title="Crear nuevo alumno">Nuevo Alumno</a-->
                            @endcan--}}
                            <div>
                            <br/>
                            </div>
                            <div class="table-responsive">
                                <div class="container">
                            <table id="miTablaAlumnos" class="table table-striped mt-2 col-lg-12 col-12 col-xl-12">
                                <thead class="text-center bcgreen" style="background-color:#6777ef; font-size: 16px;"> 
                                    <th style="display: none;">id</th>
                                    <!--th style="color:#fff;">Matricula</th-->
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Apellidos</th> 
                                    <th style="color:#fff;">Fechas</th> 
                                    <th style="color:#fff;">QR Code</th>

                                    <!--th style="color:#fff;">Grupo</th-->                                       
                                    <th style="color:#fff;"><i class="fas fa-wrench" style="font-size: 18px;"></i>Acciones</th>                                                                    
                                </thead>
                                <tbody>
                                @foreach($alumnos as $alumno)
                                    <tr style="font-size: 15px;">
                                        <td style="display: none;">{{ $alumno->id }}</td>
                                        <td class="text-center">{{ $alumno->nombre }}</td> <!-- Asumiendo que el modelo Alumno tiene el atributo nombre -->
                                        <td class="text-center">{{ $alumno->apellido }}</td> <!-- Asumiendo que el modelo Alumno tiene el atributo nombre -->
                                        <td class="text-center">    
                                            @if ($alumno->ultima_asistencia)
                                                {{ $alumno->ultima_asistencia->fecha }}
                                            @else
                                                Primera vez
                                            @endif</td>
                                            <td class="text-center">{!! $alumno->qr_code !!}</td> 
                                        <!--td class="textoG text-center">{{ $alumno->grupo }}</td-->
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center ">
                                                @can('administrar-asistencia')
                                                <div class="mx-1">
                                                <a class="btn btn-info textoGBB" style="background-color: #40cdf3; border-color: #40cdf3;" href="{{ route('asistencias.show', $alumno->id) }}"><span class="d-md-inline d-none">Ver</span><i class="fas fa-edit"></i></a>
                                                </div>
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
            new DataTable('#miTablaAlumnos', {
                lengthMenu: [
                    [5, 10],
                    [5, 10]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'Alumno' },
                    { data: 'Ciclo' },
                    { data: 'fecha' },
                    { data: 'QR Code' },
                    { data: 'acciones' },
                    
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection