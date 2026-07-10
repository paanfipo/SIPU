@extends('dashboard')
@section('title_dashboard','Listado de convocatorias')
@section('breadcrumbs')
    {{ Breadcrumbs::render('gestiones.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Tramites</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($convocatorias as $concovatoria)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$concovatoria->nombre}}</td>
                            <td>{{$concovatoria->estado}}</td>
                            <td>{{ optional($concovatoria->fecha_inicio)->format('Y-m-d') }}</td>
                            <td>{{ optional($concovatoria->fecha_fin)->format('Y-m-d') }}</td>
                            <td>{{$concovatoria->created_at}}</td>
                            <td>{{$concovatoria->updated_at}}</td>
                            <td>
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        @if(count($concovatoria->cronogramas) > 0)                                                 
                                            <span class="px-2">                                              
                                                <a href="{{route('gestiones.tramites',$concovatoria->id)}}" title="Tramites"><i class="fas fa-mail-bulk fa-2x"></i></a>                                               
                                            </span>
                                            
                                        @endif   
                                        
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