@extends('dashboard')
@section('title_dashboard','Litado de placas')
@section('breadcrumbs')
    {{ Breadcrumbs::render('placas.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Placa')
                    <a class="btn btn-success" href="{{route('placas.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Placa</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($placas as $placa)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$placa->placa}}</td>
                            <td>{{$placa->estado}}</td>
                            <td>{{$placa->created_at}}</td>
                            <td>{{$placa->updated_at}}</td>
                            <td>
                                @can('Actualizar Placa')
                                    <a class='btn btn-primary' href="{{route('placas.show',$placa->id)}}"><i class='fas fa-edit'></i></a>
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