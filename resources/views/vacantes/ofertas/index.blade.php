@extends('dashboard')
@section('title_dashboard','Listado de Ofertas')
@section('breadcrumbs')
    {{ Breadcrumbs::render('ofertas.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Oferta')
                    <a class="btn btn-danger" href="{{route('ofertas.create')}}"><i class="fa fa-plus"></i> Crear nuevo</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre empresa o dependencia</th>
                        <th>Nombre oferta</th>
                        <th>Tipo Oferta</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ofertas as $oferta)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$oferta["nombre_empresa_dependencia"]}}</td>
                            <td>{{$oferta['nombre_oferta']}}</td>
                            <td>{{$oferta['nombre_tipo_oferta']}}</td>
                            <td>{{$oferta['created_at']}}</td>
                            <td>{{$oferta['updated_at']}}</td>
                            <td>
                                <div class="col-md-12">
                                    <div class="row">
                                        @if(($oferta['nombre_tipo_oferta'] == 'Monitorias') && (Auth::user()->hasRole('Estudiante')) && (count( Auth::user()->ofertasPostuladas()->where('id',$oferta['id'])->wherePivot('estado', true)->get()) > 0))
                                            <div class="col-md-4">
                                                <a class='btn btn-danger' href="{{route('ofertas.uploadFileOferta',$oferta['id'])}}" title="Subir documentos"><i class="fas fa-file-pdf"></i></a>                                                    
                                            </div>
                                        @endif
                                        @can('Actualizar Oferta')
                                            <div class="col-md-4">
                                                <a class='btn btn-danger' href="{{route('ofertas.edit',$oferta['id'])}}" title="Editar Oferta"><i class='fas fa-edit'></i></a>
                                            </div>
                                        @endcan
                                        @can('Detalle Oferta')
                                            <div class="col-md-4">
                                                <a class='btn btn-danger' href="{{route('ofertas.show',$oferta['id'])}}" title="Detalle Oferta"><i class='fas fa-eye'></i></a>
                                            </div>
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

@stop