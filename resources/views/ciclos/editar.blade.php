@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Ciclo</h3>
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
                        
                        <form action="{{ route('ciclos.update',$ciclo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre"><span class="textoG">Nombre: </span></label>
                                    <input type="text" name="nombre" style="font-size:16px" class="form-control" value="{{ $ciclo->nombre }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="inicio"><span class="textoG">Fecha de inicio:</span></label>
                                    <input type="date" name="inicio" class="form-control" style="font-size: 16px;" value="{{ $ciclo->inicio }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="fin"><span class="textoG">Fecha de fin:</span></label>
                                    <input type="date" name="fin" class="form-control" style="font-size: 16px;" value="{{ $ciclo->fin }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button>
                                <a href="/ciclos" class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a>                           
                        </div>
                    </form>

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
