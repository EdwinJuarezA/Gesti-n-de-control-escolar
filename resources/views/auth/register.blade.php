@extends('layouts.auth_app')
@section('title')
    Register
@endsection
@section('content')

<div class="container mt-5 mx-auto rounded-bottom rounded" style="border-top: 2px solid blue; background: white;">       
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="card-header"><h4 style="font-size: 24px;">¿Eres nuevo? ¡Registrate!</h4></div>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" style="font-size: 18px;">Nombre completo:</label><span
                                    class="text-danger" style="font-size: 18px;">*</span>
                            <input id="firstName" type="text" style="font-size: 18px;"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" 
                                   tabindex="1" placeholder="Escribe tu(s) nombre(s)" value="{{ old('name') }}"
                                   autofocus required>
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" style="font-size: 18px;">Correo:</label><span
                                    class="text-danger" style="font-size: 18px;">*</span>
                            <input id="email" type="email" style="font-size: 18px;"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="Escribe tu correo" name="email" tabindex="1"
                                   value="{{ old('email') }}"
                                   required autofocus>
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label" style="font-size: 20px;">Contraseña:</label><span
                                    class="text-danger" style="font-size: 20px;">*</span>
                            <input id="password" type="password" style="font-size: 18px;"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                   placeholder="Escribe la contraseña" name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password_confirmation"
                                   class="control-label" style="font-size: 20px;">Confirmar contraseña:</label><span
                                    class="text-danger" style="font-size: 20px;">*</span>
                            <input id="password_confirmation" type="password" placeholder="Confirma contraseña" style="font-size: 20px;"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                   name="password_confirmation" tabindex="2">
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" style="font-size: 22px;">
                                Registrar
                            </button>
                        </div>
                    </div>
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


    <div class="mt-5 text-muted text-center">
        <span style="font-size: 18px;">¿Ya tienes una cuenta? </span><a
                href="{{ route('login') }}" style="font-size: 18px;">Inicia sesión</a>
    </div>
@endsection
