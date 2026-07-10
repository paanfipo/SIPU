@extends('dashboard')
@section('title_dashboard','Listado Trámites')
@section('breadcrumbs')
    {{ Breadcrumbs::render('tramites.index') }}
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
                            <th>Nombre de empresa o dependencia</th>
                            <th>Tipo de oferta</th>
                            <th>Nombre Oferta</th>
                            <th>Fecha Creación</th>
                            <th>Fecha Cierre</th>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th>Fase</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ofertas as $oferta)
                            @foreach($oferta->postuladosOfertasActivas as $user)
                                <tr>
                                    <td>#</td>
                                    <td>{{$oferta->nombre_empresa_dependencia}}</td>
                                    <td>{{$oferta->tipoOferta->nombre}}</td>
                                    <td>{{$oferta->nombre_oferta}}</td>
                                    <td>{{$oferta->created_at}}</td>
                                    <td>{{ optional($oferta->fecha_cierre_vacante)->format('Y-m-d') }}</td>
                                    <td>#{{$user->id}} {{$user->name}}</td>
                                    <td>{{$user->pivot->estado ? 'Activo':'Inactivo'}}</td>
                                    <td>{{$oferta->faseLst()[$user->pivot->fase] }}</td>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="row">                                           
                                                <div class="col-md-4">
                                                    @can('Detalle Oferta a Tramite')
                                                        <a class='btn btn-danger' href="{{route('tramites.show', [$oferta->id,'user_id'=>$user->id,'tipo'=>$oferta->tipoOferta->nombre])}}"><i class='fas fa-eye'></i></a>
                                                    @endcan
                                                </div>
                                                <div class="col-md-4">
                                                    @if( $oferta->tipoOferta->nombre == 'Monitorias'  && (count( $user->ofertasPostuladas()->where('id',$oferta->id)->wherePivot('fase', 1)->get()) > 0) )
                                                        <a class='btn btn-danger' href="{{route('tramites.vinculacion', [$user->id,$oferta->id])}}"><i class="fas fa-file-signature"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop