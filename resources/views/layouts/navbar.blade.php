<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">{{auth()->user()->unreadNotifications->count()}}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Notificaciones
            </h6>
            @if(auth()->user()->unreadNotifications->count() > 0)
                @foreach(auth()->user()->unreadNotifications as $notification)
                    @if($notification->data["alert"]["type"] == "Novedades Convocatoria Cronograma")
                        <a class="dropdown-item d-flex align-items-center" href='{{route("gestiones.novedades", [ $notification->data["alert"]["cronograma_id"], $notification->data["alert"]["inscripto"] ])}}'>
                            <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                            </div>
                            <div>
                            <div class="small text-gray-500">{{$notification->created_at}}</div><br>
                            <span class="font-weight-bold">{{$notification->data["alert"]["message"]}}</span><br>
                            <span class="font-weight-bold">De: {{$notification->data["alert"]["de"]}}</span><br>
                            <span class="font-weight-bold">Para: {{$notification->data["alert"]["para"]}}</span>
                            </div>
                        </a>
                    @endif

                    @if($notification->data["alert"]["type"] == "Novedades Registro Convocatoria")
                        <a class="dropdown-item d-flex align-items-center" href='{{route("asistencia.caracterizacion_sensibilizacion", [ $notification->data["alert"]["convocatoria_id"], $notification->data["alert"]["usuario_id"] ])}}'>
                            <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            </div>
                            <div>
                            <div class="small text-gray-500">{{$notification->created_at}}</div><br>
                            <span class="font-weight-bold">{{$notification->data["alert"]["message"]}}</span><br>
                            <span class="font-weight-bold">De: {{$notification->data["alert"]["de"]}}</span><br>
                            <span class="font-weight-bold">Para: {{$notification->data["alert"]["para"]}}</span>
                            </div>
                        </a>
                    @endif
                    @if($notification->data["alert"]["type"] == "Novedades Registro Empresa")
                        <a class="dropdown-item d-flex align-items-center" href='{{ route("usuarios.edit", $notification->data["alert"]["user_empresa"]) }}'>
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                </div>
                            <div>
                                <div class="small text-gray-500">{{$notification->created_at}}</div>
                                <br>
                                <span class="font-weight-bold">{{$notification->data["alert"]["message"]}}</span>
                                <br>
                            </div>
                        </a>
                    @endif

                    @if($notification->data["alert"]["type"] == "Novedades Postulación Oferta")
                        <a class="dropdown-item d-flex align-items-center" href='{{route("tramites.show", [$notification->data["alert"]["oferta_id"],"user_id" => $notification->data["alert"]["user_id"],"tipo"=> $notification->data["alert"]["tipo_oferta"] ])}}'>
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                </div>
                            <div>
                                <div class="small text-gray-500">{{$notification->created_at}}</div>
                                <br>
                                <span class="font-weight-bold">{{$notification->data["alert"]["message"]}}</span>
                                <br>
                            </div>
                        </a>
                    @endif

                    @if($notification->data["alert"]["type"] == "Proceso de admisión vacantes")
                        <a class="dropdown-item d-flex align-items-center" href='#'>
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                </div>
                            <div>
                                <div class="small text-gray-500">{{$notification->created_at}}</div>
                                <br>
                                <span class="font-weight-bold">{{$notification->data["alert"]["message"]}} -- {{$notification->data["alert"]["detalle"]}}</span>                             
                                <span class="font-weight-bold">De: {{$notification->data["alert"]["de"]}}</span><br>
                                <span class="font-weight-bold">Para: {{$notification->data["alert"]["para"]}}</span>
                                <br>
                            </div>
                        </a>
                    @endif
                    
                    
                @endforeach
            @else
                <a class="dropdown-item" href="#">No tiene notificaciones</a>
            @endif            
            <a class="dropdown-item text-center small text-gray-500" href="{{route('notification.markAsRead')}}">Marcar como leido</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    @if(!isset(Auth::user()->userInfo->foto))
                        <img class="img-profile rounded-circle" src="{{ asset('img/no_profile.png') }}">
                    @else
                    <img
                        class="img-profile rounded-circle"
                        src="/storage/{{ Auth::user()->userInfo->foto }} "
                    />
                    @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('usuarios.edit', Auth::user()->id)}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->