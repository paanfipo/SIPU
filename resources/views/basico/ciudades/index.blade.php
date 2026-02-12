@extends('dashboard')
@section('title_dashboard','Litado de ciudades')
@section('breadcrumbs')
    {{ Breadcrumbs::render('ciudades.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Ciudad')
                <a class="btn btn-danger" href="{{route('ciudades.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Codigo Dane</th>
                        <th>Departamento</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ciudades as $ciudad)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$ciudad->nombre}}</td>
                            <td>{{$ciudad->codigo_dane}}</td>
                            <td>{{$ciudad->departamento->nombre}}</td>
                            <td>{{$ciudad->estado}}</td>
                            <td>{{$ciudad->created_at}}</td>
                            <td>{{$ciudad->updated_at}}</td>
                            <td>
                                @can('Actualizar Ciudad')
                                <a class='btn btn-danger' href="{{route('ciudades.edit',$ciudad->id)}}"><i class='fas fa-edit'></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection