@extends('dashboard')
@section('title_dashboard','Litado de departamentos')
@section('breadcrumbs')
    {{ Breadcrumbs::render('departamentos.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Departamento')
                    <a class="btn btn-danger" href="{{route('departamentos.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($departamentos as $departamento)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$departamento->nombre}}</td>
                            <td>{{$departamento->codigo_dane}}</td>
                            <td>{{$departamento->estado}}</td>
                            <td>{{$departamento->created_at}}</td>
                            <td>{{$departamento->updated_at}}</td>
                            <td>
                                @can('Actualizar Departamento')
                                    <a class='btn btn-danger' href="{{route('departamentos.edit',$departamento->id)}}"><i class='fas fa-edit'></i></a>
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