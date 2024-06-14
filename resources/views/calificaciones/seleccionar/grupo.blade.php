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
                            <table id="miTabla" class="table table-striped mt-2">
                                <thead class="text-center textoG" style="background-color:#6777ef"> 
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Ciclo</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;"><i class="fas fa-wrench mr-1"
                                            style="font-size: 18px;"></i>Acciones</th>                                                                    
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                    <tr>
                                        <td style="display: none;">{{ $grupo->id }}</td> 
                                        <td class="textoG text-center">{{ $grupo->ciclo }}</td>                                 
                                        <td class="textoG text-center">{{ $grupo->nombre }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                            <!--a href="{{ route('seleccionar.grupo', $grupo->id) }}" class="btn btn-primary textoGBB">Inscribir</a-->
                                            <form id="form-inscripcion-{{ $grupo->id }}" method="POST" action="{{ route('inscripciones.update', $id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                                            <button type="submit" class="btn btn-primary textoGBB">Inscribir</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ubicamos la paginación a la derecha -->
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
            new DataTable('#miTabla', {
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
    <script>
    function inscribirGrupo(grupoId) {
        // Obtener el formulario específico
        var form = document.getElementById('form-inscripcion-' + grupoId);

        // Envía la solicitud de inscripción
        form.submit();
    }
</script>

@endsection