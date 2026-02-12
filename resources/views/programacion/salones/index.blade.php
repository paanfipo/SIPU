@extends('dashboard')
@section('title_dashboard','Litado Salones')
@section('breadcrumbs')
    {{ Breadcrumbs::render('salones.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Salones')
                    <a class="btn btn-danger" href="{{route('salones.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Número</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                        <th>Universidad</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salones as $salon)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$salon->numero}}</td>
                            <td>{{$salon->capacidad}}</td>
                            <td>{{$salon->estado}}</td>
                            <td>@if(isset($salon->universidadDetalle)) {{$salon->universidadDetalle->nombre}} @endif</td>
                            <td>{{$salon->created_at}}</td>
                            <td>{{$salon->updated_at}}</td>
                            <td>
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        @can('Actualizar Salones')
                                            <span class="px-2">
                                                <a  href="{{route('salones.edit',$salon->id)}}"><i class='fas fa-edit fa-2x'></i></a>
                                            </span>
                                        @endcan
                                        @can('Detalle Salones')
                                            <span class="px-2">  
                                                <a href="{{route('salones.show',$salon->id)}}"><i class='fas fa-eye fa-2x'></i></a>
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
@endsection