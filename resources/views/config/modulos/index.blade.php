@extends('dashboard')
@section('title_dashboard','Litado de modulos')
@section('breadcrumbs')
    {{ Breadcrumbs::render('modulos.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Modulo')
                    <a class="btn btn-danger" href="{{route('modulos.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Modulo</th>
                        <th>Paquete</th>
                        <th>Icono</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modulos as $modulo)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$modulo->name}}</td>
                            <td>{{$modulo->paquete->name}}</td>
                            <td><a style="color: #000;"><i class="{{ $modulo->icon }}"><?php echo "&nbsp;&nbsp;" ?></i>{{ $modulo->name }}</a></td>
                            <td>{{$modulo->state}}</td>
                            <td>{{$modulo->created_at}}</td>
                            <td>{{$modulo->updated_at}}</td>
                            <td>
                                @can('Actualizar Modulo')
                                <a class='btn btn-danger' href="{{route('modulos.edit',$modulo->id)}}"><i class='fas fa-edit'></i></a>
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