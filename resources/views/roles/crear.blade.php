@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Rol</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!--label class="text-danger">Los campos con * son obligatorios</label-->
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

                            {!! Form::open(array('route' => 'roles.store','method'=>'POST', 'id' => 'crearRolForm')) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="" style="font-size:20px;">Nombre del Rol:</label> <!--span class="required text-danger">*</span-->
                                            {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'nombreRol')) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="" style="font-size:20px;">Permisos para este Rol:</label><!--span class="required text-danger">*</span-->
                                        </div>
                                    </div>                                    

                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="card">
                                            <div class="card-body">
                                        <div class="form-group">
                                            <table class="table">
                                                <thead>
                                                    <tr class="textoG text-secondary" style="background-color: #8C438B;">
                                                        <th class="text-center text-white font-weight-bold">Permiso</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($permission as $value)
                                                <tr id="fila_permiso_{{ $value->id }}">
                                                    <td class="textoG text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
        <div class="col-lg-6 col-md-6 col-6 text-center">
            <span class="d-sm-none d-md-block">{{ $value->name }}</span>
            <span class="d-sm-block d-none d-md-none" style="font-size: 15px;">{{ $value->name }}</span>
        </div>
        <div class="col-lg-6 col-md-6 col-6 text-center">
            <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarPermiso({{ $value->id }}, '{{ $value->name }}')">
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
                                                            <th class="text-center text-white textoG">Permisos Seleccionados</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="permisosSeleccionados">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="permission" id="permisosSeleccionadosInput">
                                <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button>
                                <a href="/roles" class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    <script>
        var permisosSeleccionados = [];

        function seleccionarPermiso(id, nombre) {
    if (!permisosSeleccionados.includes(id)) {
        permisosSeleccionados.push(id);

        document.getElementById("permisosSeleccionadosInput").value = permisosSeleccionados.join(",");

        var fila = document.createElement("tr");
        fila.id = "permiso_" + id;
        fila.innerHTML = '<td class=" text-center textoG font-weight-bold"><div class="d-flex align-items-center justify-content-center"><div class="col-8">' + nombre + '</div><div class="col-4"><button type="button" class="btn btn-sm btn-danger" onclick="eliminarPermiso(' + id + ')"><span class="d-sm-none d-md-inline">Eliminar</span><i class="fa fa-times"></i></button></div></div></td>';
        document.getElementById("permisosSeleccionados").appendChild(fila);

        // Ocultar el botón de la tabla de permisos disponibles
        document.getElementById("fila_permiso_" + id).style.display = "none";
    }
}



function eliminarPermiso(id) {
    var index = permisosSeleccionados.indexOf(id);
    if (index !== -1) {
        permisosSeleccionados.splice(index, 1);

        document.getElementById("permisosSeleccionadosInput").value = permisosSeleccionados.join(",");

        document.getElementById("permiso_" + id).remove();

        // Mostrar el botón en la tabla de permisos disponibles
        document.getElementById("fila_permiso_" + id).style.display = "table-row";
    }
}


        document.getElementById("crearRolForm").addEventListener("submit", function(event) {
            if (permisosSeleccionados.length === 0) {
                alert("Debe seleccionar al menos un permiso.");
                event.preventDefault();
            }
        });
    </script>
@endsection
