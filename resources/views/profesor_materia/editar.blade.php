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
                            
                            {!! Form::open(['route' => ['profesor_materias.update', $grupoMateria->id], 'method' => 'PUT']) !!}
                                <div class="form-group">
                                    <label for="materia_id"><span class ="textoG">Materia:</span></label>
                                    <input type="text" class="form-control" name="materia_nombre" id="materia_nombre" value="{{ $grupoMateria->materia->nombre }}" readonly>
                                    <input type="hidden" name="materia_id" value="{{ $grupoMateria->materia_id }}">
                                </div>
    
                                <div class="form-group">
                                    <label for="profesor_id"><span class ="textoG">Profesor:</span></label>
                                    <select class="form-control" name="profesor_id" id="profesor_id" style ="font-size:16px;">
                                        @foreach ($profesores as $profesor)
                                            <option value="{{ $profesor->id }}" {{ $grupoMateria->profesor_id == $profesor->id ? 'selected' : '' }}>
                                                {{ $profesor->nombre }} - {{ $profesor->perfil }}
                                            </option>
                                        @endforeach
                                    </select>
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
