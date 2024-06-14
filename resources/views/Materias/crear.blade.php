@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Materia</h3>
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

                        {!! Form::open(array('route' => 'materias.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="clave_curso"><span class="textoG">Clave de curso:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::text('clave_curso', null, array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre"><span class="textoG">Nombre de la materia:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::text('nombre', null, array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="profesor"><span class="textoG">Semestre:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::number('semestre', null, ['class' => 'form-control', 'id' => 'semestre', 'min' => 1, 'max' => 6, 'required' => true, 'style'=>'font-size:16px;']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="creditos"><span class="textoG">Créditos:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::number('creditos', null, ['class' => 'form-control', 'id' => 'creditos', 'min' => 1, 'max' => 10, 'required' => true, 'style'=>'font-size:16px;']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button>
                            <a href="/materias" class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
