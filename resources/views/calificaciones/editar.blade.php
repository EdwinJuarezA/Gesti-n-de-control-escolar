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
                        
                        <form action="{{ route('calificaciones.update', $calificacion->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombre_completo"><span class="textoG">Nombre del Estudiante:</span></label>
                                        <input type="text" style="font-size: 16px;" name="nombre_completo" class="form-control" value="{{ $calificacion->alumno->nombre }} {{ $calificacion->alumno->apellido }}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="materia"><span class="textoG">Materia:</span></label>
                                        <input type="text" style="font-size: 16px;" name="materia" class="form-control" value="{{ $calificacion->grupoMateria->materia->nombre ?? 'No asignada' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="parcial1"><span class="textoG">Parcial 1:</span></label>
                                        <input type="number" style="font-size: 16px;" name="parcial1" class="form-control" min="0" max="100" value="{{ $calificacion->parcial1 }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="parcial2"><span class="textoG">Parcial 2:</span></label>
                                        <input type="number" style="font-size: 16px;" name="parcial2" class="form-control" min="0" max="100" value="{{ $calificacion->parcial2 }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="parcial3"><span class="textoG">Parcial 3:</span></label>
                                        <input type="number" style="font-size: 16px;" name="parcial3" class="form-control" min="0" max="100" value="{{ $calificacion->parcial3 }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="final"><span class="textoG">Calificacion Final:</span></label>
                                        <input type="number" style="font-size: 16px;" name="final" class="form-control" min="0" max="100" value="{{ $calificacion->final }}" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary"><span class="textoG"><i class="fa fa-save"></i> Guardar</span></button>
                                    <a href='/calificaciones' class="btn btn-warning"><span class="textoG"><i class="fa fa-times-circle"></i> Cancelar</span></a>
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const parcial1 = document.querySelector('input[name="parcial1"]');
        const parcial2 = document.querySelector('input[name="parcial2"]');
        const parcial3 = document.querySelector('input[name="parcial3"]');
        const final = document.querySelector('input[name="final"]');

        function calculateFinal() {
            const p1 = parseFloat(parcial1.value) || 0;
            const p2 = parseFloat(parcial2.value) || 0;
            const p3 = parseFloat(parcial3.value) || 0;
            final.value = ((p1 + p2 + p3) / 3).toFixed(2);
        }

        parcial1.addEventListener('input', calculateFinal);
        parcial2.addEventListener('input', calculateFinal);
        parcial3.addEventListener('input', calculateFinal);

        calculateFinal();
    });
</script>
@endsection
