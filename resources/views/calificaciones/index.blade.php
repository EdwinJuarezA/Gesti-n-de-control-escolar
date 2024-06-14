@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Calificaciones de {{ $materia }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Profesor: {{ $grupoMateria->profesor->nombre }} {{ $grupoMateria->profesor->apellido_paterno }} {{ $grupoMateria->profesor->apellido_materno }}</h4>
                            <table id="miTablaAlumnos" class="table table-striped mt-2">
                                <thead class="text-center bcgreen" style="background-color:#6777ef; font-size: 16px;">
                                    <th style="display: none;">id</th>
                                    <th style="color:#fff;">Grupo</th> 
                                    <th style="color:#fff;">Alumno</th>                                      
                                    <th style="color:#fff;">Parcial 1</th>
                                    <th style="color:#fff;">Parcial 2</th>
                                    <th style="color:#fff;">Parcial 3</th>
                                    <th style="color:#fff;">Promedio</th>
                                    <th style="color:#fff;">Estado</th>                                                                     
                                </thead>
                                <tbody style="text-align: center">
                                    @foreach ($calificaciones as $cal)
                                    <tr style="font-size: 18px;">
                                        <td style="display: none;">{{ $cal->id }}</td> 
                                        <td>{{ $cal->grupo }}</td>            
                                        <td>{{ $cal->alumno }}</td>
                                        <td class="{{ $grupoMateria->estatus == 1 || $grupoMateria->estatus == 5 ? 'editable' : '' }}" data-id="{{ $cal->id }}" data-field="parcial1" style="background-color: {{ $grupoMateria->estatus == 1 || $grupoMateria->estatus == 5 ? '#98FB98' : 'none' }}">{{ $cal->parcial1 }}</td>
                                        <td class="{{ $grupoMateria->estatus == 2 || $grupoMateria->estatus == 5 ? 'editable' : '' }}" data-id="{{ $cal->id }}" data-field="parcial2" style="background-color: {{ $grupoMateria->estatus == 2 || $grupoMateria->estatus == 5 ? '#98FB98' : 'none' }}">{{ $cal->parcial2 }}</td>
                                        <td class="{{ $grupoMateria->estatus == 3 || $grupoMateria->estatus == 5 ? 'editable' : '' }}" data-id="{{ $cal->id }}" data-field="parcial3" style="background-color: {{ $grupoMateria->estatus == 3 || $grupoMateria->estatus == 5 ? '#98FB98' : 'none' }}">{{ $cal->parcial3 }}</td>
                                        <td id="final-{{ $cal->id }}">{{ $cal->final ? $cal->final : 'N/A' }}</td>
                                        <td>
                                            @if ($cal->final >= 70)
                                                <span class="badge bg-success" style="color: white">APROBADO</span>
                                            @else
                                                <span class="badge bg-danger" style="color: white">REPROBADO</span>
                                            @endif
                                        </td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href='/calificaciones' class="btn btn-warning" style="width: 150px"><i class="fa fa-times-circle textoG"></i><span class="textoG"> Regresar</span></a>
                                <button id="saveChanges" class="btn btn-success" style="float: right; width: 150px"><span class="textoG">Guardar Cambios</span></button>
                                @if ($grupoMateria->estatus == 4)
                                <button id="requestCorrection" class="btn btn-danger" style="float: right; width: 200px; margin-right: 10px;"><span class="textoG">Solicitar corrección</span></button>
                                @endif
                            </div>   
                            <div class="pagination justify-content-end">
                                {!! $calificaciones->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Confirmation before Saving -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel" style="font-size: 25px">Confirmar Guardado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="textoG">¿Está seguro de guardar las calificaciones? No se podrán editar después.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmSave" style="width: 150px"><span class="textoG">Confirmar</span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Correction Request -->
    <div class="modal fade" id="correctionModal" tabindex="-1" aria-labelledby="correctionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="correctionModalLabel" style="font-size: 25px">Solicitar corrección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="textoG">Para poder corregir errores cometidos al calificar necesita insertar la clave de acceso para poder permitirle modificar los errores.</span>
                    <input type="password" id="accessKey" class="form-control mt-2" placeholder="Clave de acceso">
                    <div id="errorMsg" class="text-danger mt-2" style="display: none;">Clave de acceso incorrecta</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width: 150px"><span class="textoG">Cancelar</span></button>
                    <button type="button" class="btn btn-primary" id="submitAccessKey" style="width: 150px"><span class="textoG">Enviar</span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts for Editable Table and Modal Handling -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function() {
            let edits = {};

            $(document).on('dblclick', '.editable', function() {
                let id = $(this).data('id');
                let field = $(this).data('field');
                let value = $(this).text();
                $(this).html('<input type="text" value="' + value + '" class="form-control" />');
                $(this).children().first().focus();
                $(this).children().first().on('blur', function() {
                    let newValue = $(this).val();
                    $(this).parent().text(newValue);
                    edits[id] = {...(edits[id] || {}), [field]: newValue};  // Store edit
                });
            });

            $('#saveChanges').on('click', function() {
                $('#confirmModal').modal('show');
            });

            $('#confirmSave').on('click', function() {
                saveEdits();
                $('#confirmModal').modal('hide');
            });

            $('#requestCorrection').on('click', function() {
                $('#correctionModal').modal('show');
            });

            $('#submitAccessKey').on('click', function() {
                let accessKey = $('#accessKey').val();
                $.ajax({
                    url: '/reset-status',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: '{{ $grupoMateria->id }}',
                        password: accessKey
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            $('#errorMsg').show();
                        }
                    },
                    error: function() {
                        $('#errorMsg').show();
                    }
                });
            });

            function saveEdits() {
                Object.keys(edits).forEach(function(id) {
                    $.ajax({
                        url: '/actualizar-calificacion',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            changes: edits[id]
                        },
                        success: function(response) {
                            console.log('Guardado exitoso');
                            location.reload();  // Recargar la página
                        },
                        error: function() {
                            alert('Error al guardar las calificaciones.');
                        }
                    });
                });
                edits = {};  // Reset temporary edits storage
            }
        });
    </script>
@endsection
