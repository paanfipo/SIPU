@extends('dashboard')
@section('title_dashboard','Litado tipo maestro item')
@section('breadcrumbs')
    {{ Breadcrumbs::render('tiposmaestroitem.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Tipo Maestro Item')
                    <a class="btn btn-danger" href="{{route('tiposmaestroitem.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Numero Item</th>
                        <th>Tipo Maestro</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tiposmaestroitem as $tipo)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$tipo->nombre}}</td>
                            <td>{{$tipo->estado}}</td>
                            <td>{{$tipo->numitem}}</td>
                            <td>@if(isset($tipo->tipomaestro)){{$tipo->tipomaestro->nombre}}@endif</td>
                            <td>{{$tipo->created_at}}</td>
                            <td>{{$tipo->updated_at}}</td>
                            <td>
                                @can('Actualizar Tipo Maestro Item')
                                    <a class='btn btn-danger' href="{{route('tiposmaestroitem.edit',$tipo->id)}}"><i class='fas fa-edit'></i></a>
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