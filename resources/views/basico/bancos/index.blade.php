@extends('dashboard')
@section('title_dashboard','Litado de bancos')
@section('breadcrumbs')
    {{ Breadcrumbs::render('bancos.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Bancos')
                    <a class="btn btn-success" href="{{route('bancos.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bancos as $banco)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$banco->name}}</td>
                            <td>{{$banco->state}}</td>
                            <td>{{$banco->created_at}}</td>
                            <td>{{$banco->updated_at}}</td>
                            <td>
                                @can('Actualizar Bancos')
                                    <a class='btn btn-primary' href="{{route('bancos.show',$banco->id)}}"><i class='fas fa-edit'></i></a>
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