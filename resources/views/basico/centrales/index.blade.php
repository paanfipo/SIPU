@extends('dashboard')
@section('title_dashboard','Litado de centrales de carga/descargar')
@section('breadcrumbs')
    {{ Breadcrumbs::render('centrales.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Central')
                    <a class="btn btn-success" href="{{route('centrales.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Ciudad</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($centrales as $central)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$central->nombre}}</td>
                            <td>{{$central->ciudad->nombre}}</td>
                            <td>{{$central->created_at}}</td>
                            <td>{{$central->updated_at}}</td>
                            <td>
                                @can('Actualizar Central')
                                <a class='btn btn-primary' href="{{route('centrales.show',$central->id)}}"><i class='fas fa-edit'></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop