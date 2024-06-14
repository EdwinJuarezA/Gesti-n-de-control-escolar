@extends('layouts.app')

@section('content')
    <section class="section">
    <div class="section-header">
    <h3 class="page__heading">Roles</h3>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success textoGB font-weight-bold" style="background-color: #88f463; border-color: #88f463;" href="{{ route('roles.create') }}" title="Crear nuevo rol">Nuevo rol</a>
                    <div>
                        <br />
                    </div>
                    {{-- @can('crear-rol')
                    <a class="btn btn-warning" href="{{ route('roles.create') }}">Nuevo</a>
                    @endcan --}}

                    <table class="table table-striped mt-2 table_id col-lg-9 col-12" id="miTabla2">
                        <thead class="text-center textoG bcgreen" style="background-color: #6777ef;">
                            <th style="display: none;">ID</th>
                            <th style="color: #fff;"><i class="fas fa-user-lock mx-5" style="font-size: 18px;"></i>Rol</th>
                            <th style="color: #fff;"><i class="fas fa-wrench mr-5" style="font-size: 18px;"></i>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td style="display: none;">{{ $role->id }}</td>
                                <td class="textoG text-center">{{ $role->name }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        @can('editar-rol')
                                        <div class="mx-1">
                                            <a class="btn btn-primary textoGBB" style="background-color: #40cdf3; border-color: #40cdf3;" href="{{ route('roles.edit',$role->id) }}" title="Editar role">
                                                <span class="d-md-inline d-none">Editar</span><i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                        @endcan @can('borrar-rol')
                                        <div class="mx-1">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!} {!! Form::button('<span class="d-md-inline d-none">Borrar</span>
                                            <i class="far fa-trash-alt"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger textoGBB', 'onclick' => "return confirm('¿Estás seguro de que quieres eliminar este rol?')"]) !!} {!!
                                            Form::close() !!}
                                        </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Centramos la paginacion a la derecha -->
                    <div class="pagination justify-content-end">
                        {!! $roles->links() !!}
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
    <script>
        new DataTable('#miTabla2', {
    lengthMenu: [
        [2, 5, 10],
        [2, 5, 10]
    ],

    columns: [
        { Id: 'Id' },
        { Name: 'Name' },
        // { Guard_name: 'Guard_name'},
        { Acciones: 'Acciones' }
    ],

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>
@endsection
