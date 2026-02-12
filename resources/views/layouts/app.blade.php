<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('img/icono2.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIPU</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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
    .content {
                text-align: center;
    }

    .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
    }

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

    .btn-link {
        font-weight: 400;
        color: #FFFFFF;
        text-decoration: none;
    }

    .btn-link:hover {
        font-weight: 500;
        color: #FFFFFF;
        text-decoration: none;
    }

</style>
<body>
    <div class="container-ini content" style="background-image: url('/img/offering.jpg');">
       <div class="col-md-12">            
            <main class="py-4">
                <div class="container">
                    <div class="col-md-12" >
                        <div class="card">
                                <div class="card-header">
                                    <center><h3>@yield('title_dashboard','SIPU')</h3></center>
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
                                @yield('content')
                            </div>                        
                        </div>
                    </div>
                </div>
            </main>
       </div>
    <div class="col-md-12">
        <main class="py-4">
            <div class="container">                
                <div class="col-md-12">
                    <p style="margin:20px; color:white;  font-weight: bold;">© 2020 2021 Copyright: Grupo de desarrollo Universidad del Valle Sede Norte del Cauca. </p>
                    <p style="margin:20px; color:white;  font-weight: bold;">All rights reserved</p>
                    <p style="margin:20px; color:white;  font-weight: bold;">Designed by: Gestión Tecnológica</p>
                
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
