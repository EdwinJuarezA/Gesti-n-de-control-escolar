@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inscribir Alumno a Materia</h3>
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
                        
                        <form action="{{ route('materia_has_alumnos.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" value="{{ $alumno->nombre }}" disabled>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input type="text" name="apellido" class="form-control" value="{{ $alumno->apellido }}" disabled>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="materia_id">Materia</label>
                                    <select name="materia_id" class="form-control">
                                        @foreach ($materias as $materia)
                                            <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="calificacion">Calificacion</label><span class="required text-danger">*</span>
                                    {!! Form::number('calificacion', 0, array('class' => 'form-control', 'readonly' => 'readonly')) !!}
                                </div>
                            </div>
                            
                            

                            <input type="hidden" name="alumno_id" value="{{ $alumno->id }}">

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    // Inicializa Select2 en el campo de selección
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
