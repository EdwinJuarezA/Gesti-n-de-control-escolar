<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'CECYTE 05')</title>
    <link rel="icon" href="{{ asset('img/logo_cecyte.png') }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    

@yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
    <style>
    .toolbar {
    float: left;
    }
    .searching{
        float: right;
    }

    .textoG{
        font-size: 20px;
        font: black;
    }
    
    .textoGB{
        font-size: 18px;
        font: black;
    }
    
    .textoGBB{
        font-size: 14px;
        font: black;
    }
    
    .bcgreen{
        background-color: #79DC4F !important;
        
    }

    .colorInterfaz{
        background-color: #FDCE47 !important;
    }
    
    .colorMenu{
        background-color: #FDCE47 !important;
    }

    .colorInterfaz:hover{
        background-color: #ffffff !important;
    }
    .main-sidebar {
    min-height: 100vh !important; /* Establece la altura mínima de la barra lateral como el 100% del viewport height */
    display: flex !important;
    flex-direction: column !important;
}

.sidebar-menu {
    flex-grow: 1 !important; /* Permite que el menú se expanda para llenar el espacio restante */
}

    </style>
    @yield('page_css')


    @yield('css')
</head>
<body >

<div id="app">
    <div class="main-wrapper main-wrapper-1" >
        <div class="navbar-bg colorInterfaz" style=" color: white"></div>
        <nav class="navbar navbar-expand-lg main-navbar ">
            @include('layouts.header')

        </nav>
        <div class="main-sidebar main-sidebar-postion colorInterfaz" style=" color: white">
            @include('layouts.sidebar')
        </div>
        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</div>

@include('profile.change_password')
@include('profile.edit_profile')

</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ asset('assets/js/custom/buscador.js') }}"></script>
@yield('page_js')
@yield('scripts')
<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '{{ route('login') }}';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));
</script>
</html>
