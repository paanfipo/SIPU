@extends('dashboard')
@section('title_dashboard','Listado de actividades')
@section('breadcrumbs')
    {{ Breadcrumbs::render('actividades.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Actividad')
                    <a class="btn btn-danger" href="{{route('actividades.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Etapa</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($actividades as $actividad)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$actividad->nombre}}</td>
                            <td>{{ optional($actividad->etapa)->nombre }}</td>
                            <td>{{$actividad->created_at}}</td>
                            <td>{{$actividad->updated_at}}</td>
                            <td>
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        @can('Actualizar Actividad')
                                        <span class="px-2">    
                                            <a href="{{route('actividades.edit',$actividad->id)}}"><i class='fas fa-edit fa-2x'></i></a>
                                        </span>
                                        @endcan
                                        
                                        @can('Detalle Actividad')
                                        <span class="px-2"> 
                                            <a href="{{route('actividades.show',$actividad->id)}}"><i class='fas fa-eye fa-2x'></i></a>
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