@extends('dashboard')
@section('title_dashboard','Listado Programas Academicos')
@section('breadcrumbs')
    {{ Breadcrumbs::render('programas.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Programas')
                    <a class="btn btn-danger" href="{{route('programas.create')}}"><i class="fa fa-plus"></i>  Crear Programa</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cordinador</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($programas as $programa)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$programa->codigo}}</td>
                            <td>{{$programa->nombre}}</td>
                            <td>{{$programa->email}}</td>
                            <td>@if(isset($programa->cordinador)) {{$programa->cordinador->name}} @endif</td>
                            <td>{{$programa->estado}}</td>
                            <td>{{$programa->created_at}}</td>
                            <td>{{$programa->updated_at}}</td>
                            <td>
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        @can('Actualizar Programas')
                                            <span class="px-2">
                                                <a  href="{{route('programas.edit',$programa->id)}}"><i class='fas fa-edit fa-2x'></i></a>
                                            </span>
                                        @endcan
                                        @can('Detalle Programas')
                                            <span class="px-2">  
                                                <a href="{{route('programas.show',$programa->id)}}"><i class='fas fa-eye fa-2x'></i></a>
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