@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Alta de Alumnos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
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

                        {!! Form::open(array('route' => 'alumnos.store','method'=>'POST')) !!}
                        <div class="row">
                            <!--div class="form-group">
                                <label for="grupo">Grupo</label><span class="required text-danger">*</span>
                                <input type="text" id="grupo_nombre" class="form-control"
                                    value="{{ session('grupo_nombre') }}" disabled>
                                <input type="hidden" id="grupo_id" name="grupo_id"
                                    value="{{ session('grupo_id') }}">
                                <a href="{{-- route('calificaciones.seleccionar.grupos') --}}"
                                    class="btn btn-secondary">Seleccionar</a>
                            </div-->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="matricula"><span class="textoG">Matricula:</span></label><!--span
                                        class="required text-danger">*</span-->
                                    {!! Form::number('matricula', null, ['class' => 'form-control','id' => 'matricula', 'min' => 1, 'required' => true, 'readonly' => true, 'style'=>'font-size:16px;']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre"><span class="textoG">Nombre:</span></label><!--span
                                        class="required text-danger">*</span-->
                                    {!! Form::text('nombre', null, array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="apellido"><span class="textoG">Apellido:</span></label><!--span
                                        class="required text-danger">*</span-->
                                    {!! Form::text('apellido', null, array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="sexo"><span class="textoG">Genero:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::select('sexo', ['M' => 'Masculino', 'F' => 'Femenino'], null, ['class' => 'form-control', 'style'=>'font-size:16px;' , 'id' => 'sexo', 'placeholder' => 'Seleccione el sexo']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="semestre"><span class="textoG">Semestre:</span></label><!--span
                                        class="required text-danger">*</span-->
                                    {!! Form::number('semestre', null, ['class' => 'form-control', 'id' => 'semestre', 'min' => 1, 'max' => 6, 'required' => true, 'style'=>'font-size:16px;']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="especialidad"><span class="textoG">Especialidad:</span></label><!--span
                                        class="required text-danger">*</span-->
                                    {!! Form::text('especialidad', null, array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button>
                                <a href="/alumnos" class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <script>
                                var mitad = {{ $mitad }};

                            document.addEventListener('DOMContentLoaded', function() {
                                var matriculaInput = document.getElementById('matricula');
                                var currentYear = new Date().getFullYear().toString().substr(-2);
                                var lastNumber = getLastMatriculaNumber();
                                matriculaInput.value = currentYear + '04' + padNumber(mitad + 1, 4);
                                
                                function getLastMatriculaNumber() {
                                    // Aquí debes implementar la lógica para obtener el último número de matrícula de tus registros
                                    // Por ahora, devolvemos un número aleatorio entre 1 y 9999
                                    return Math.floor(Math.random() * 9999) + 1;
                                }
                                
                                function padNumber(number, length) {
                                    return number.toString().padStart(length, '0');
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
