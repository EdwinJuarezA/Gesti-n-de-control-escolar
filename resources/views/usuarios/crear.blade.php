@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Usuarios</h3>
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

                        {!! Form::open(array('route' => 'usuarios.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name"><span class="textoG">Nombre: </span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::text('name', null, array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="email"><span class="textoG">Correo electronico:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::text('email', null, array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="password"><span class="textoG">Contraseña:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::password('password', array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="confirm-password"><span class="textoG">Confirmar contraseña:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::password('confirm-password', array('class' => 'form-control', 'style'=>'font-size:16px;')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for=""><span class="textoG">Roles:</span></label><!--span class="required text-danger">*</span-->
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control', 'style'=>'font-size:16px')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button>
                                <a href="/usuarios" class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a>
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
