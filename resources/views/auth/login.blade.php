@extends('layouts.app_copy')
@section('title_dashboard','Login')
@section('content')

    <!--<div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf            
            <div class="form-group row">    
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" required autofocus>
    
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">    
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="contraseña" required>
    
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>            
            <div class="form-group row mb-0">
                <button type="submit" class="login_btn btn btn-danger btn-lg btn-block">
                    {{ __('Ingresar') }}
                </button>
                @if (Route::has('password.request'))
                   <a class="btn btn-link" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <a class="btn btn-link" href="{{ route('register') }}">
                    Regístrate Aqui!!
                </a>
                <a class="btn btn-link" href="{{ route('registro.empresa') }}">
                    Regstro Empresa!!
                </a>
            </div>
        </form>                
    </div>-->
    
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="../img/logo_sipu.png"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form  method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0"></p>
                    </div>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0"></p>
                    </div>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0"></p>
                    </div>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0"></p>
                    </div>
                    

                    <!-- Email input -->
                    <div class="form-outline form-group mb-3">    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" name="email" value="{{ old('email') }}" placeholder="email" required autofocus>
            
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Password input -->
                    
                    <div class="form-group form-outline mb-3">    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg" name="password" placeholder="contraseña" required autofocus>
            
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">                    
                        @if (Route::has('password.request'))
                            <a class="text-white btn btn-link" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-danger btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        <p class="text-white small fw-bold mt-2 pt-1 mb-0">¿No tiene una cuenta? <a href="{{ route('register') }}"
                            class="text-white link-danger">Regístrate Aqui!!</a></p>
                    </div>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0"></p>
                    </div>


                </form>
            </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-danger">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
            © 2022 2023 Copyright: Grupo de desarrollo Universidad del Valle Sede Norte del Cauca. 
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
            <a href="#!" class="text-white me-4">
                All rights reserved
            </a>
            <a href="#!" class="text-white me-4">
                Designed by: Vanessa Quintero Torres y Paula Andrea Figueroa Polanco
            </a>
            </div>
            <!-- Right -->
        </div>
    </section>

    
    
@stop
