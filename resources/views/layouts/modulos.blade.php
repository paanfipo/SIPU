<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPU</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @auth
        <?php $paquetes = DB::table('paquetes')->where('state',1)->get(); ?>
        @foreach($paquetes as $paquete)
            <li class="nav-item {{ (request()->segment(1) == $paquete->url ) ? 'active' : '' }}">
                <a class="nav-link {{ (request()->segment(1) == $paquete->url ) ? '' : 'collapsed' }}" data-toggle="collapse" data-target="#collapse_{{$paquete->name}}" aria-expanded="true" aria-controls="collapse_{{$paquete->name}}">
                    <i class="{{$paquete->icon}}"></i>{{$paquete->name}}
                </a>
                <div id="collapse_{{$paquete->name}}" class="collapse {{ (request()->segment(1) == $paquete->url ) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <?php $modulos = DB::table('modulos')->where('paquete_id', $paquete->id )->where('state',1)->orderBy('position', 'asc')->get(); ?>

                        @foreach($modulos as $modulo)
                            <?php $permiso_listar = DB::table('permissions')->where('modulo_id', $modulo->id )->where('name','like','%Listar%')->get(); ?>
                            @if(count($permiso_listar) > 0)
                                <?php
                                $permiso_name = $permiso_listar[0]->name;
                                $ruta =  $modulo->url.'.index';
                                ?>
                                @can($permiso_name)
                                    <a  class="collapse-item {{ (request()->segment(2) == $modulo->url) ? 'active' : '' }}" href="{{ route($ruta) }}"><i class="{{$modulo->icon}}"></i> {{$modulo->name}}</a>
                                @endcan
                            @else
                                <?php $ruta =  $modulo->url.'.index'; ?>
                                <a  class="collapse-item {{ (request()->segment(2) == $modulo->url) ? 'active' : '' }}" href="{{ route($ruta) }}"><i class="{{$modulo->icon}}"></i> {{$modulo->name}}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </li>
        @endforeach
    @endauth


<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->