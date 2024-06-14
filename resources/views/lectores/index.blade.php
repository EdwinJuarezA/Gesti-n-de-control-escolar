@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Toma de asistencia</h3>
    </div>
    <!-- Mensaje de aviso -->
    <div id="mensaje" class="alert d-none"></div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Escanea el código QR</h5>
                                <video id="video" width="100%" autoplay></video>
                            </div>
                            <div class="col-md-6">
                                <h5>Resultado del escaneo</h5>
                                <div id="resultado" class="alert alert-info" role="alert"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal para la asistencia -->
<div class="modal fade" id="asistenciaModal" tabindex="-1" aria-labelledby="asistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asistenciaModalLabel" style="font-size: 20px;">Confirmar Asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 20px;">
                <form id="asistenciaForm">
                    <div>
                        <span class="textoG">Alumno: </span><span id="alumno"></span>
                    </div>
                    <div>
                        <span class="textoG">Matrícula: </span><span id="alumnoMatricula"></span>
                    </div>
                    @csrf
                    <input type="hidden" id="matricula" name="matricula">
                    <div class="mb-3">
                        <label for="ciclo_id" class="form-label textoG">Ciclo: </label>
                        <select id="ciclo_id" name="ciclo_id" class="form-select" required>
                            @foreach($ciclos as $ciclo)
                                <option class="textoG" value="{{ $ciclo->id }}">{{ $ciclo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmar Asistencia</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsQR/1.0.0/jsQR.min.js"></script>
<script src="{{ asset('js/jsQR.js') }}"></script>

<script>
    const video = document.getElementById('video');
    const canvasElement = document.createElement('canvas');
    const context = canvasElement.getContext('2d');
    let lastTick = 0;

    function startCamera() {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
            .then(stream => {
                video.srcObject = stream;
                video.play();
                requestAnimationFrame(tick);
            });
    }

    startCamera();

    function tick(timestamp) {
        if (timestamp - lastTick >= 1000 / 30) {
            lastTick = timestamp;
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                canvasElement.width = video.videoWidth;
                canvasElement.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                const imageData = context.getImageData(0, 0, canvasElement.width, canvasElement.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height);

                if (code) {
                    // Detener la cámara
                    video.srcObject.getTracks().forEach(track => track.stop());

                    // Poner el valor del QR en el campo de la matrícula
                    document.getElementById('matricula').value = code.data;

                    // Aquí se debería hacer una llamada AJAX para obtener el nombre del alumno con la matrícula escaneada.
                    fetch(`/buscar-alumno/${code.data}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('alumno').innerText = data.nombre + ' ' + data.apellido;
                            document.getElementById('alumnoMatricula').innerText = data.matricula;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                    // Mostrar el modal
                    $('#asistenciaModal').modal('show');
                }
            }
        }
        requestAnimationFrame(tick);
    }

    document.getElementById('asistenciaForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const matricula = document.getElementById('matricula').value;
        const ciclo_id = document.getElementById('ciclo_id').value;

        fetch('/registrar-asistencia', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                matricula: matricula,
                ciclo_id: ciclo_id
            })
        })
        .then(response => response.json())
        .then(data => {
            $('#asistenciaModal').modal('hide');
            const mensaje = document.getElementById('mensaje');
            if (data.error) {
                mensaje.className = 'alert alert-danger';
                mensaje.innerText = data.error;
                startCamera(); // Reiniciar la cámara
            } else {
                mensaje.className = 'alert alert-success';
                mensaje.innerText = data.success;
            }
            document.getElementById('vEscan').remove();
            mensaje.classList.remove('d-none');
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    $('#asistenciaModal').on('hidden.bs.modal', function () {
        startCamera(); // Reiniciar la cámara cuando el modal se cierre
    });
</script>
@endsection
