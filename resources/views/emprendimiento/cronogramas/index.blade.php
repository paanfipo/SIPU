@extends('dashboard')
@section('title_dashboard','Listado de cronogramas por convocatorias')
@section('breadcrumbs')
    {{ Breadcrumbs::render('cronogramas.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
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
                    @foreach($convocatorias as $concovatoria)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$concovatoria->nombre}}</td>
                            <td>{{$concovatoria->estado}}</td>
                            <td>{{$concovatoria->created_at}}</td>
                            <td>{{$concovatoria->updated_at}}</td>
                            <td>                                
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @can('Crear Cronograma')
                                                <a class='btn btn-danger' href="{{route('cronogramas.show',$concovatoria->id)}}" title="Cronograma"><i class='fas fa-calendar'></i></a>
                                            @endcan
                                        </div>
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