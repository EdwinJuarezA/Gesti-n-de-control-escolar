@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Usuarios</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary textoGB font-weight-bold" href="{{ route('usuarios.create') }}"
                            title="Crear nuevo usuario">Nuevo usuario</a>
                        <div>
                            <br />
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id col-lg-9 col-12 col-xl-9" id="miTabla">
                                <thead class="text-center textoG bcgreen" style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Email</th>
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;"><i class="fas fa-wrench mr-1"
                                            style="font-size: 18px;"></i>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td style="display: none;">{{ $usuario->id }}</td>
                                        <td class="textoG text-center">{{ $usuario->name }}</td>
                                        <td class="textoG text-center">{{ $usuario->email }}</td>
                                        <td class="textoG text-center">
                                            @if(!empty($usuario->getRoleNames()))
                                            @foreach($usuario->getRoleNames() as $rolNombre)
                                            <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                            @endforeach
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <div class="mx-1">
                                                    <a class="btn btn-info textoGBB"
                                                        style="background-color: #40cdf3; border-color: #40cdf3;"
                                                        href="{{ route('usuarios.edit',$usuario->id) }}"
                                                        title="Editar usuario">
                                                        <span class="d-md-inline d-none">Editar</span><i
                                                            class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmErase({{ $usuario->id }})"
                                                    style="display: inline;">
                                                    <span class="d-md-inline d-none textoGBB">Borrar</span>
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete-' . $usuario->id, 'route'
                                    => ['usuarios.destroy', $usuario->id], 'style' => 'display:none;']) !!}
                                    {!! Form::close() !!}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <div id="verify" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeVerify()">&times;</span>
            <p>¿Estás seguro de eliminar este usuario?</p>
            {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete']) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                <button type="button" class="btn btn-secondary" onclick="closeVerify()">Cancelar</button>
            {!! Form::close() !!}
        </div>
    </div>

    <script>
        function confirmErase(id) {
            document.getElementById('form-delete').action = '{{ route("usuarios.destroy", ":id") }}'.replace(':id', id);
            document.getElementById('verify').style.display = 'block';
        }

        function closeVerify() {
            document.getElementById('verify').style.display = 'none';
        }

        $(document).ready(function () {
            new DataTable('#miTabla', {
                lengthMenu: [
                    [5, 10],
                    [5, 10]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'nombre' },
                    { data: 'email' },
                    { data: 'rol' },
                    { data: 'acciones' }
                    
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection
