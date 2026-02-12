<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIPU</title>

        
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    
    <!-- Custom fonts for this template-->
    <link href="{{url('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box
        }

        .limiter{
            width: 100%;
            margin: 0 auto
        }

        .container-login100{
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
            background-position: center;
            background-size: cover;
            position: relative;
            z-index: 1
        }
        .container-login100::before{
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

        @media (max-width: 768px){
            .container{
                width: 750px
            }
        }
x|x|

    </style>
        
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="limiter">
        <div class="container-login100" style="background-image: url('/img/offering.jpg');">        
            <div class="container">
                <div class="row">
                    @yield('content')                                                
                </div>
            </div>
        </div>            
    
</body>

</html>
