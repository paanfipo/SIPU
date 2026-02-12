<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIPU</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                color: #e9ecef;
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

            .m-b-md {
                margin-bottom: 30px;
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
                text-align: center;
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

            .btmnLogin{

                background-color: #FB2A00;                
                border-color: #e9ecef;
            }
            
            .btnLogin {
                border: 2px solid #e9ecef;
                color: #e9ecef;
                border-radius: 5px;
                font-weight: 700;
                background-color: #FB2A00;
            }

            .btnLogin:hover {
                border-color: #fff;
                color: #fff;
            }

            .logo_inicio{
                width: 100%;
                height: 300px;                
                overflow: hidden;
                margin-left: 5px;               
            }

            .logo_inicio img{
                width: 100%;
                height: 300px;
            }
            @supports(object-fit: cover){
                .box img{
                  height: 100%;
                  object-fit: cover;
                  object-position: center center;
                }
            }

            
        </style>
    </head>
    <body>
            <div class="container-ini" style="background-image: url('/img/offering.jpg');">
                <div class="">
                    <div class="logo_inicio"> 
                        <img src="../img/logo_sipu.png" alt="Imagotipo">
                    </div>
                    <hr class="my-4">
                    <p class="lead" style="font-size: 20px; color:white;">Bienvenido al sistema de información de procesos universitarias<br>
                        (SIPU).</p>
                    <a type="button" href="{{ route('login') }}" class="btn btn-lg btnLogin">Inicio</a>
                    <p class="links" style="margin:20px; color:white;  font-weight: bold;">© 2022 2023 Copyright: Grupo de desarrollo Universidad del Valle Sede Norte del Cauca. </p>
                    <p class="links" style="margin:20px; color:white;  font-weight: bold;">All rights reserved</p>
                    <p class="links" style="margin:20px; color:white;  font-weight: bold;">Designed by: Gestión Tecnológica</p>
                </div>                
            </div>
    </body>
    
</html>
