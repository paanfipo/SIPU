@extends('dashboard')
@section('title_dashboard','Litado de usuarios')
@section('breadcrumbs')
    {{ Breadcrumbs::render('usuarios.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Usuario')
                    <a class="btn btn-danger" href="{{route('usuarios.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->state}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>{{$usuario->getRoleNames()}}</td>
                            <td>{{$usuario->created_at}}</td>
                            <td>{{$usuario->updated_at}}</td>
                            <td>
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        @can('Actualizar Usuario')
                                            <span class="px-2">
                                                <a href="{{route('usuarios.edit',$usuario->id)}}" title="editar"><i class='fas fa-edit fa-2x'></i></a>
                                            </span>
                                        @endcan
                                        @can('Listar Emprendimiento')
                                            <span class="px-2">
                                                <a  href="{{route('listar.emprendimiento',$usuario->id)}}" title="Emprendimientos"><i class='fas fa-briefcase fa-2x'></i></a>
                                            </span>
                                        @endcan
                                        @can('Detalle Usuario')
                                            <span class="px-2">
                                                <a  href="{{route('usuarios.show',$usuario->id)}}" title="Detalle"><i class='fas fa-eye fa-2x'></i></a>
                                            </span>
                                        @endcan
                                        @can('Detalle Usuario')
                                            <span class="px-2">
                                                <a  href="{{route('usuario.hojaVida',$usuario->id)}}" title="Hoja de vida"><i class="fas fa-address-book fa-2x"></i></a>
                                            </span>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@stop