@extends('dashboard')
@section('title_dashboard','Listado de Dependencias')
@section('breadcrumbs')
    {{ Breadcrumbs::render('dependencias.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Dependencia')
                    <a class="btn btn-danger" href="{{route('dependencias.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Encargado</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dependencias as $dependencia)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dependencia->nombre}}</td>
                            <td>@if(isset($dependencia->usuarioencargado)) {{$dependencia->usuarioencargado->name}} @endif</td>
                            <td>{{$dependencia->created_at}}</td>
                            <td>{{$dependencia->updated_at}}</td>
                            <td>
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        @can('Actualizar Dependencia')
                                            <span class="px-2">  
                                                <a href="{{route('dependencias.edit',$dependencia->id)}}"><i class='fas fa-edit fa-2x'></i></a>
                                            </span>
                                        @endcan
                                        @can('Detalle Dependencia')
                                            <span class="px-2">  
                                                <a href="{{route('dependencias.show',$dependencia->id)}}"><i class='fas fa-eye fa-2x'></i></a>
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