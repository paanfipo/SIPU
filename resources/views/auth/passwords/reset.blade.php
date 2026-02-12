<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('img/icono2.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPU') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{url('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- sweetalert2 -->
    <link href="{{ asset('librerias/sweetalert2/dist/css/sweetalert2.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('librerias/DataTables/datatables.min.css') }}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    
</head>
<style>
    .container-ini {
        width: 100%;  
        min-height: 100vh;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 15px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        
        position: relative;
        z-index: 1;
    }

    .container-ini::before {
        content: "";
        display: block;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: #e9ecef;
        background: -webkit-linear-gradient(bottom, #FB2A00, #e9ecef);
        background: -o-linear-gradient(bottom, #FB2A00, #e9ecef);
        background: -moz-linear-gradient(bottom, #FB2A00, #e9ecef);
        background: linear-gradient(bottom, #FB2A00, #e9ecef);
        opacity: 0.6;
    }

    @import url('https://fonts.googleapis.com/css?family=Numans');

    .card{
        width: 380px;
        margin-top: auto;
        margin-bottom: auto;
        background-color: rgba(0,0,0,0.5) !important;
    }

    .card-header h3{
        color: white;
    }

    .input-group-prepend span{
        background-color: #FB2A00;
        color: white;
        border:0 !important;
    }

    .login_btn{
        background-color: #FB2A00;
        margin-top: 20%;
    }

</style>
<body>
    <div class="container-ini" style="background-image: url('/img/offering.jpg');">
        <div id="app">
            <main class="py-4">
                <div class="container">
                    <div class="col-md-8">
                        <div class="card">
                                <div class="card-header">
                                    <center><h3>Recuperar Contraseña</h3></center>
                                    <div class="d-flex justify-content-end social_icon">
                                    </div>
                                </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>

                                    </div>
                                @endif
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if(session('info'))
                                    <div class="alert alert-success" role="alert">
                                        {{session('info')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if(session('alert'))
                                    <div class="alert alert-warning" role="alert">
                                        {{session('alert')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                               
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                
                                    <input type="hidden" name="token" value="{{ $token }}">
                                
                                    <div class="form-group row">    
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="email" required autofocus>
                                
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

                                    <div class="form-group row">    
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirmar contraseña" required>                                
                                        </div>
                                    </div>
                                
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="login_btn btn btn-danger">
                                                {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>                        
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" ></script>

        <!-- Fontawesome -->
        <script src="{{ asset('librerias/fontawesome/js/all.js') }}" ></script>

        <!-- Jquery -->
        <script src="{{ asset('librerias/jquery/jquery-3.4.1.min.js') }}" ></script>

        <!-- DataTables -->
        <script src="{{ asset('librerias/DataTables/datatables.min.js') }}" ></script>

        <!-- sweetalert2 -->
        <script src="{{ asset('librerias/sweetalert2/dist/sweetalert2.all.js') }}" ></script>

        <script>
            $(document).ready( function () {
                $('#tabla-detalle').DataTable();
            });
        </script>

        @yield('script')
    </div>
</body>

</html>