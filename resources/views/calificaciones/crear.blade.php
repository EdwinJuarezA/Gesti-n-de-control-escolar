@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inscribir Alumno</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <label class="text-danger">Los campos con * son obligatorios</label>
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
                            {!! Form::open(['route' => 'calificaciones.store', 'method' => 'POST']) !!}
                                <!-- Grupo -->
                                <div class="form-group">
                                    <label for="grupo">Grupo</label><span class="required text-danger">*</span>
                                    <input type="text" id="grupo_nombre" class="form-control" value="{{ session('grupo_nombre') }}" disabled>
                                    <input type="hidden" id="grupo_id" name="ciclo_id" value="{{ session('grupo_id') }}">
                                    <a href="{{ route('calificaciones.seleccionar.grupos') }}" class="btn btn-secondary">Seleccionar</a>
                                </div>

                                <!-- Alumno -->
                                <div class="form-group">
                                    <label for="alumno">Alumno</label><span class="required text-danger">*</span>
                                    <input type="text" id="alumno_nombre" class="form-control" value="{{ session('alumno_nombre') }}" disabled>
                                    <input type="hidden" id="alumno_id" name="alumno_id" value="{{ session('alumno_id') }}">
                                    <a href="{{ route('calificaciones.seleccionar.alumnos') }}" class="btn btn-secondary">Seleccionar</a>
                                </div>

                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('calificaciones.index') }}" class="btn btn-warning">Cancelar</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
