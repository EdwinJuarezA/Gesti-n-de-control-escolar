@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Profesor</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <!--label class="text-danger">Los campos con * son obligatorios</label-->
                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show textoG" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger" style="font-size:18px;">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif
                        {!! Form::open(array('route' => 'profesores.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre" style="font-size:20px;">Nombre:</label><span class="required text-danger"></span>
                                    {!! Form::text('nombre', null, array('class' => 'form-control', 'style' => 'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="apellido_paterno" style="font-size:20px;">Apellido paterno:</label><span class="required text-danger"></span>
                                    {!! Form::text('apellido_paterno', null, array('class' => 'form-control', 'style' => 'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="apellido_materno" style="font-size:20px;">Apellido materno:</label><span class="required text-danger"></span>
                                    {!! Form::text('apellido_materno', null, array('class' => 'form-control', 'style' => 'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="perfil" style="font-size:20px;">Perfil:</label><span class="required text-danger"></span>
                                    {!! Form::text('perfil', null, array('class' => 'form-control', 'style' => 'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button>
                                <a href="/profesores"  class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a> 
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
