@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar - {{$grupo->nombre}}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {!! Form::model($grupo, ['route' => ['asignarGrupos.update', $grupo->id], 'method' => 'PATCH', 'id' => 'editarGrupoForm']) !!}
                                <div class="row">
                                    {!! Form::hidden('grupo_id', $grupo->id) !!}
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label style="font-size:20px;" for="">Materias para este Grupo:</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="textoG text-secondary" style="background-color: #8C438B;">
                                                                <th class="text-center text-white font-weight-bold">Materia</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($materias as $value)
                                                                @if (!in_array($value->id, $grupoMaterias))
                                                                    <tr id="fila_materia_{{ $value->id }}">
                                                                @else
                                                                    <tr id="fila_materia_{{ $value->id }}" style="display: none;">
                                                                @endif
                                                                <td class="textoG text-center">
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <div class="col-lg-6 col-md-6 col-6 text-center">
                                                                            <span class="d-sm-none d-md-block">{{ $value->nombre }}</span>
                                                                            <span class="d-sm-block d-none d-md-none" style="font-size: 15px;">{{ $value->nombre }}</span>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-6 text-center">
                                                                            <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarMateria({{ $value->id }}, '{{ $value->nombre }}')">
                                                                                <span class="d-sm-none d-md-inline">Seleccionar</span><i class="fa fa-check-circle"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="textoG text-secondary" style="background-color: #5BAB38;">
                                                            <th class="text-center text-white textoG">Materias Seleccionadas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="materiasSeleccionadas">
                                                        @foreach($grupoMaterias as $materiaId)
                                                            @php
                                                                $materia = App\Models\Materia::find($materiaId);
                                                            @endphp
                                                            <tr id="materia_{{ $materia->id }}">
                                                                <td class="textoG text-center font-weight-bold">
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <div class="col-8">
                                                                            <span class="d-sm-none d-md-block">{{ $materia->nombre }}</span>
                                                                            <span class="d-sm-block d-none d-md-none" style="font-size: 15px;">{{ $materia->nombre }}</span>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="eliminarMateria({{ $materia->id }})">
                                                                                <span class="d-sm-none d-md-inline">Eliminar</span><i class="fa fa-times"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="materias" id="materiasSeleccionadasInput" value="{{ implode(',', $grupoMaterias) }}">
                                <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar Cambios</button>
                                <a href="/asignarGrupos" class="btn btn-warning textoGB ml-5"><i class="fa fa-times-circle mx-1"></i>Cancelar</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var materiasSeleccionadas = {!! json_encode($grupoMaterias) !!};

        function seleccionarMateria(id, nombre) {
            if (!materiasSeleccionadas.includes(id)) {
                materiasSeleccionadas.push(id);
                document.getElementById("materiasSeleccionadasInput").value = materiasSeleccionadas.join(",");

                var fila = document.createElement("tr");
                fila.id = "materia_" + id;
                fila.innerHTML = '<td class="text-center textoG font-weight-bold"><div class="d-flex align-items-center justify-content-center"><div class="col-8"><span class="d-sm-none d-md-block">' + nombre + '</span><span class="d-sm-block d-none d-md-none" style="font-size: 15px;">' + nombre + '</span></div><div class="col-4"><button type="button" class="btn btn-sm btn-danger" onclick="eliminarMateria(' + id + ')"><span class="d-sm-none d-md-inline">Eliminar</span><i class="fa fa-times"></i></button></div></div></td>';
                document.getElementById("materiasSeleccionadas").appendChild(fila);

                // Ocultar el botón de la tabla de materias disponibles
                document.getElementById("fila_materia_" + id).style.display = "none";
            }
        }

        function eliminarMateria(id) {
            var index = materiasSeleccionadas.indexOf(id);
            if (index !== -1) {
                materiasSeleccionadas.splice(index, 1);
                document.getElementById("materiasSeleccionadasInput").value = materiasSeleccionadas.join(",");

                document.getElementById("materia_" + id).remove();

                // Mostrar el botón en la tabla de materias disponibles
                document.getElementById("fila_materia_" + id).style.display = "table-row";
            }
        }

        document.getElementById("editarGrupoForm").addEventListener("submit", function(event) {
            if (materiasSeleccionadas.length === 0) {
                alert("Debe seleccionar al menos una materia.");
                event.preventDefault();
            }
        });
    </script>
@endsection
