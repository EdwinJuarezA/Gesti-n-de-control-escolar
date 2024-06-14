<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <style>
            .color-card-green {
                border-top: 2px solid #22D816; 
            }
            .btn-cambio:hover {
    background-color: #FDCE47 !important; /* Color diferente al pasar el mouse */
}
        </style>
        
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container py-5 h-100">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="login-brand">
                        <!--img src="{{ asset('img/logo.png') }}" alt="logo" width="150"
                            class="shadow-light"-->
                    </div>
                    
                    <div class="card color-card-green mx-auto d-center-block justify-content-center align-items-center">
                        <label for="email" style="font-size: 40px; font-weight: bold;">Sistema de Control Escolar</label>
                    </div>
                    
                    @yield('content')
                    <div class="simple-footer">
{{--                        Copyright &copy; {{ getSettingValue('application_name') }}  {{ date('Y') }}--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<!-- Page Specific JS File -->
</body>
</html>
