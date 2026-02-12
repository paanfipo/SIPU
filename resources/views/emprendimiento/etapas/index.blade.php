@extends('dashboard')
@section('title_dashboard','Listado de etapas')
@section('breadcrumbs')
    {{ Breadcrumbs::render('etapas.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Etapa')
                    <a class="btn btn-danger" href="{{route('etapas.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($etapas as $etapa)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$etapa->nombre}}</td>
                            <td>{{$etapa->created_at}}</td>
                            <td>{{$etapa->updated_at}}</td>
                            <td>
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                            @can('Actualizar Etapa')
                                            <span class="px-2">     
                                                <a href="{{route('etapas.edit',$etapa->id)}}"><i class='fas fa-edit fa-2x'></i></a>
                                            </span>
                                            @endcan
                                        
                                            @can('Detalle Etapa')
                                            <span class="px-2">
                                                <a href="{{route('etapas.show',$etapa->id)}}"><i class='fas fa-eye fa-2x'></i></a>
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