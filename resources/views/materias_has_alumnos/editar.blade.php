@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Calificación</h3>
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

                            <form action="{{ route('materias_has_alumnos.update', $materia_has_alumno->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="alumno">Nombre del Alumno</label>
                                            <input type="text" name="alumno" class="form-control" value="{{ $materia_has_alumno->alumno->nombre }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="apellido">Apellido del Alumno</label>
                                            <input type="text" name="apellido" class="form-control" value="{{ $materia_has_alumno->alumno->apellido }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="materia">Materia</label>
                                            <input type="text" name="materia" class="form-control" value="{{ $materia_has_alumno->materia->nombre }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="calificacion">Calificación</label><span class="required text-danger">*</span>
                                            <input type="text" name="calificacion" class="form-control" value="{{ $materia_has_alumno->calificacion }}">
                                        </div>
                                    </div>
                                    

                                    <input type="hidden" name="alumno_id" value="{{ $materia_has_alumno->alumno->id }}">
                                    <input type="hidden" name="materia_id" value="{{ $materia_has_alumno->materia->id }}">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection