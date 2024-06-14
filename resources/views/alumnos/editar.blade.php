@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Alumno</h3>
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
                        
                        <form action="{{ route('alumnos.update',$alumno->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="matricula"><span class="textoG">Matricula:</span></label>
                                    <input type="number" name="matricula" style="font-size: 16px;" class="form-control" min="1" value="{{ $alumno->matricula }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre"><span class="textoG">Nombre:</span></label>
                                    <input type="text" name="nombre" style="font-size: 16px;" class="form-control" value="{{ $alumno->nombre }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="apellido"><span class="textoG">Apellido:</span></label>
                                    <input type="text" name="apellido" style="font-size: 16px;" class="form-control" value="{{ $alumno->apellido }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="sexo"><span class="textoG">Genero:</span></label>
                                    <select name="sexo" style="font-size: 16px;" class="form-control" id="sexo" value="{{ $alumno->sexo }}">
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="semestre"><span class="textoG">Semestre:</span></label>
                                    <input type="number" name="semestre" style="font-size: 16px;" class="form-control" min="1" max="6" value="{{ $alumno->semestre }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="especialidad"><span class="textoG">Especialidad:</span></label>
                                    <input type="text" name="especialidad" style="font-size: 16px;" class="form-control" value="{{ $alumno->especialidad }}">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button>
                                <a href="/alumnos" class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a>
                            </div>                          
                        </div>
                    </form>

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
