<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/home">
        <i class=" fas fa-building" style="font-size: 24px;"></i><span>Dashboard</span>
    </a>
    @can('ver-materia')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/materias" >
        <i class=" fas fa-book-open" style="font-size: 24px;"></i><span>Materias</span>
    </a>
    @endcan
    @can('ver-alumno')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/alumnos" >
        <i class=" fas fa-user-graduate" style="font-size: 24px;"></i><span>Alumnos</span>
    </a>
    @endcan
    @can('administrar-inscripcion')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/inscripciones" >
        <i class=" fas fa-check-square" style="font-size: 24px;"></i><span>Inscribir</span>
    </a>
    @endcan
    @can('ver-profesor')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/profesores" >
        <i class=" fas fa-chalkboard-teacher" style="font-size: 24px;"></i><span>Profesores</span>
    </a>
    @endcan
    @can('ver-ciclo')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/ciclos" >
        <i class=" fas fa-chalkboard" style="font-size: 24px;"></i><span>Ciclos</span>
    </a>
    @endcan
    @can('ver-grupo')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/grupos" >
        <i class=" fas fa-shapes" style="font-size: 24px;"></i><span>Grupo</span>
    </a>
    @endcan
    @can('administrar-materias-asignadas')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/asignarGrupos" >
        <i class=" fas fa-solid fa-box-archive" style="font-size: 24px;"></i><span>Asignar materias</span>
    </a>
    @endcan
    @can('asignar-profesor')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/profesor_materias" >
        <i class=" fas fa-address-book" style="font-size: 24px;"></i><span>Asignar profesor</span>
    </a>
    @endcan
    @can('ver-calificacion')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/calificaciones" >
        <i class=" fas fa-graduation-cap" style="font-size: 24px;"></i><span>Calificaciones</span>
    </a>
    @endcan
    @can('administrar-boletas')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/boletas" >
        <i class=" fas fa-book-reader" style="font-size: 24px;"></i><span>Boletas</span>
    </a>
    @endcan
    @can('administrar-asistencia')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/asistencias" >
        <i class=" fas fa-solid fa-flag" style="font-size: 24px;"></i><span>Asistencias</span>
    </a>
    @endcan
    @can('administrar-tomar-asistencia')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/lectores" >
        <i class=" fas fa-solid fa-camera" style="font-size: 24px;"></i><span>Leer QR's</span>
    </a>
    @endcan
    @can('ver-usuario')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/usuarios" >
        <i class=" fas fa-user" style="font-size: 24px;"></i><span>Usuarios</span>
    </a>
    @endcan
    @can('ver-rol')
    <a class="nav-link colorText colorInterfaz colorMenu textoG rounded-pill font-weight-bold" href="/roles" >
        <i class=" fas fa-user-lock" style="font-size: 24px;"></i><span>Roles</span>
    </a>
    @endcan
</li>

<style>
    .colorText {
        color: #000000 !important;
    }
</style>