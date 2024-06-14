@extends('layouts.auth_app')
@section('title')
    Admin Login
@endsection
@section('content')

<div class="container mt-5 mx-auto rounded-bottom rounded" style="border-top: 2px solid blue; background: white;">       
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="card-header"><h4 style="font-size: 24px;">Bienvenido, ¡Inicia Sesión!</h4></div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger p-0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email" style="font-size: 20px;">Correo: </label>
                            <input aria-describedby="emailHelpBlock" id="email" type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                placeholder="Enter Email" tabindex="1"
                                value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" style="font-size: 18px;" autofocus
                                required>
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label" style="font-size: 20px;">Contraseña:</label>
                            </div>
                            <input aria-describedby="passwordHelpBlock" id="password" type="password"
                                value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                                placeholder="Enter Password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" style="font-size: 18px;"
                                tabindex="2" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('password.request') }}" class="text-small" style="font-size: 18px;">
                                    ¿Has olvidado tu contraseña?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                    id="remember"{{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember" style="font-size: 16px;">Recuerdame</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-cambio btn-lg btn-block" tabindex="4" style="background-color: orange; color: white">
                                <span style="font-size: 30px">Iniciar Sesión</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="d-none d-md-block col-md-6">
                    <img src="{{ asset('img/logo_cecyte.png') }}" alt="logo" width="410" class="shadow-light">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
