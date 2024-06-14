@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta Grupo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
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
                            
                            {!! Form::open(['route' => 'profesor_materias.store', 'method' => 'POST']) !!}
                                
                                <div class="form-group">
                                    <label for="Materia"><span class="textoG">Materia:</span></label><span class="required text-danger"></span>
                                    <input type="text" id="materia_nombre" class="form-control" value="{{ session('grupo_materias_materia_nombre') }}" style ="font-size:16px;" disabled>
                                    <input type="hidden" id="materia_id" name="materia_id" value="{{ session('grupo_materias_materia_id') }}">
                                    <a href="{{ route('profesor_materia.seleccionar.materias') }}" class="btn btn-secondary" style="background-color: #857C7F; border-color: #857C7F;">Seleccionar</a>
                                </div>

                                <!-- Ciclo -->
                                <div class="form-group">
                                    <label for="ciclo"><span class="textoG">Profesor:</span></label><span class="required text-danger"></span>
                                    <input type="text" id="profesor_nombre" class="form-control" value="{{ session('grupo_materias_profesor_nombre') }}" style ="font-size:16px;" disabled>
                                    <input type="hidden" id="profesor_id" name="profesor_id" value="{{ session('grupo_materias_profesor_id') }}">
                                    <a href="{{ route('profesor_materia.seleccionar.profesor') }}" class="btn btn-secondary" style="background-color: #857C7F; border-color: #857C7F;">Seleccionar</a>
                                </div>
                                <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button>
                                <a href="{{ route('profesor_materias.index') }}" class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a> 
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
