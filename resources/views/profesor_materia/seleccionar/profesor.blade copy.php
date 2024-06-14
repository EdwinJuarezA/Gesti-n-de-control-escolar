@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">{{$materia->clave_curso}} - {{$materia->nombre}} -> Profesores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <a href="/profesor_materias" class="btn btn-warning textoGB mx-3"><i class="fa fa-arrow-left mx-1"></i>Regresar</a>
                            <div>
                            <br/>
                            </div>
                            <div class="table-responsive">
                                <div class="container">
                            <table id="miTabla" class="table table-striped mt-2">
                            <thead class="text-center textoG" style="background-color:#367EFB"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Nombre</th> 
                                    <th style="color:#fff;">Apellido paterno</th>
                                    <th style="color:#fff;">Apellido Materno</th>
                                    <th style="color:#fff;">Perfil</th>
                                    <th style="color:#fff;"><i class="fas fa-wrench mr-1"
                                            style="font-size: 18px;"></i>Acciones</th>                                                                   
                                </thead>
                                <tbody>
                                    @foreach ($profesores as $profesor)
                                    <tr>
                                        <td style="display: none;">{{ $profesor->id }}</td>                              
                                        <td class="textoG text-center">{{ $profesor->nombre }}</td>
                                        <td class="textoG text-center">{{ $profesor->apellido_paterno}}</td>
                                        <td class="textoG text-center">{{ $profesor->apellido_materno}}</td>
                                        <td class="textoG text-center">{{ $profesor->perfil}}</td>
                                        <td>
                                        
                                        <form id="form-inscripcion-{{ $profesor->id }}" method="POST" action="{{ route('profesor_materias.update', $materia->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="profesor_id" value="{{ $profesor->id }}">
                                            <button type="submit" class="btn btn-primary textoGBB">Asignar</button>
                                            </form>
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
                    { data: 'perfil' },
                    { data: 'acciones' },
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection