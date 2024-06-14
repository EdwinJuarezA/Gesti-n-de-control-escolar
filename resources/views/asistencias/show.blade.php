@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Asistencias de {{$alumno->nombre}}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                            <a class="btn btn-warning textoGB font-weight-bold" href="{{ route('asistencias.index') }}">Volver a la lista de alumnos</a>
                            <br/>
                            </div>
                            <br/>
                            <div>
                            <p class="textoG">QR Code del alumno:</p>
                                {!! $alumno->qr_code !!} <!-- Mostrar el QR Code -->
                            </div>
                            <br/>
                            <div class="table-responsive">
                                <div class="container">
                            <table id="miTablaAlumnos" class="table table-striped mt-2 col-lg-12 col-12 col-xl-12">
                                <thead class="text-center bcgreen" style="background-color:#6777ef; font-size: 16px;"> 
                                    <th style="display: none;">id</th>
                                    <!--th style="color:#fff;">Matricula</th-->
                                    <th style="color:#fff;">Ciclo</th>
                                    <th style="color:#fff;">Fecha</th> 
                                </thead>
                                <tbody>
                                @foreach($asistencias as $asistencia)
                                    <tr style="font-size: 15px;">
                                        <td style="display: none;">{{ $asistencia->id }}</td>
                                        <td class="text-center">{{ $asistencia->ciclo->nombre }}</td> <!-- El ciclo de la asistencia -->
                                        <td class="text-center">{{ $asistencia->fecha }}</td> <!-- fechas de la asistencia -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $asistencias->links() !!}
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
                    { data: 'Ciclo' },
                    { data: 'fecha' },
                    //{ data: 'acciones' },
                    
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection