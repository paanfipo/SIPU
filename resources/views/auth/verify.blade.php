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
    <link href="{{ asset('librerias/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet">

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

    p {
        color: #e9ecef;
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
                                    <center><h3>Verifique su dirección de correo electrónico</h3></center>
                                    <div class="d-flex justify-content-end social_icon">
                                    </div>
                                </div>
                            <div class="card-body">                                

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                    <p>Antes de continuar, consulte su correo electrónico para ver si hay un enlace de verificación.
                                    Si no recibió el correo electrónico, </p>
                                    
                                    <form method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">clic aquí para solicitar otro</button> 
                                    </form>.
                            </div>                        
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" ></script>

        <!-- Fontawesome -->
        <script src="{{ asset('admin/vendor/fontawesome-free/js/all.js') }}" ></script>

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
