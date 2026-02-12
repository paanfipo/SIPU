<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIPU</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{url('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}" >

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('librerias/sweetalert2/dist/sweetalert2.min.css') }}">
   

    @yield('style')
    <style>
        .sidebar .nav-item .collapse .collapse-inner .collapse-item.active,
        .sidebar .nav-item .collapsing .collapse-inner .collapse-item.active {
            color: #E03E1D;
            font-weight: 700;
        }

        .breadcrumb-item a {
            color: #E03E1D;
        }
        .px-2 a {
            color: #E03E1D;
        }
        .topbar .dropdown-list .dropdown-header {
            background-color: #E03E1D;
            border: 1px solid #E03E1D;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #E03E1D;
            border-color: #E03E1D;    
        }

        .page-item .page-link {  
            color: #E03E1D;
        }

        .page-link:hover {
            color: #E03E1D;
        }

        
        .logo_emprendimiento 
        {
            width: 130px;
            height: 50px;                
            overflow: hidden;
        }
    </style>
</head>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    @include('layouts.modulos')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            @include('layouts.navbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> @yield('title_dashboard','SIPU')</h1>
                        @if(request()->segment(1) == 'emprendimiento')
                            <a href="#" class="d-none d-sm-inline-block shadow-sm">
                                <img src="{{ asset('img/logo_emprendimiento.jpg') }}" class="rounded float-left logo_emprendimiento" alt="Logo Emprendimiento" id="logo_emprendimiento">
                            </a>
                        @endif
                    </div>
                    
                    @yield('breadcrumbs')
                    @yield('content')

                    <canvas id="myChart"></canvas>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <p><span>© 2022 2023 Copyright: Grupo de desarrollo Universidad del Valle Sede Norte del Cauca. All rights reserved</span></p>
                        <p><span>Designed by: Gestión Tecnológica</span></p>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="{{url('admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{url('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{url('admin/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{url('admin/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{url('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{url('admin/js/demo/datatables-demo.js')}}"></script>

<!-- sweetalert2 -->
<script src="{{ asset('librerias/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<!-- Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready( function () {
                
        $('#tabla-detalle').DataTable();

        @if(Auth::user()->user_updated_at == null)
            Swal.fire({
                title: '<strong>Actualizar <u>información personal</u></strong>',
                icon: 'info',
                html:
                    'Debes <b>actualizar tu información personal</b>, ' +
                    '<a href="{{route('usuarios.edit', Auth::user()->id)}}">haga click aquí </a>' +
                    'y completa tu información personal',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<a style="text-decoration: none; color:white" href="{{route('usuarios.edit', Auth::user()->id)}}"><i class="fa fa-thumbs-up"></i> Actualizar!</a>',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:'<i class="fa fa-thumbs-down"></i>',
                cancelButtonAriaLabel: 'Thumbs down',
                confirmButtonColor: '#FF0000',
                cancelButtonColor: '#FF0000',
                iconColor: '#FF0000',
            });
        @endif
       
    });
</script>
@yield('script')
</body>

</html>

