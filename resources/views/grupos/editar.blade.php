{{-- recursos/views/grupos/editar.blade.php --}}
@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Grupo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nombre"><span class ="textoG">Nombre del Grupo:</span></label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" style ="font-size:16px;" value="{{ $grupo->nombre }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="ciclo_id"><span class ="textoG">Ciclo:</span></label>
                                    <select class="form-control" name="ciclo_id" id="ciclo_id" style ="font-size:16px;">
                                        @foreach ($ciclos as $ciclo)
                                            <option value="{{ $ciclo->id }}" style ="font-size:16px;" {{ $grupo->ciclo_id == $ciclo->id ? 'selected' : '' }}>
                                                <span style ="font-size:16px;">{{ $ciclo->nombre }} </span>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary textoGB ml-5"><i class="fa fa-save mx-1"></i>Guardar</button> 
                                <a href="/grupos" class="btn btn-warning textoGB mx-3"><i class="fa fa-times-circle mx-1"></i>Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
