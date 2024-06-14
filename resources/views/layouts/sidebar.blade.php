<aside id="sidebar-wrapper" style="background-color: #FDCE47; color: white">
    <div class="sidebar-brand mb-3">
        <img class="navbar-brand-full app-header-logo" src="{{ asset('img/logo.png') }}" width="65"
            alt="Infyom Logo">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text" >
            <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="45px" alt=""/>
        </a>
    </div>
    <ul class="sidebar-menu">
        @include('layouts.menu')
    </ul>
</aside>

<div style=" background-color: #FDCE47;">
  <div class="p-1 bd-highlight"> <p class="d-flex flex-column" style="visibility: hidden;">Contenido oculto</p></div>
  <div class="p-1 bd-highlight"> <p class="d-flex flex-column" style="visibility: hidden;">Contenido oculto</p></div>
</div>

