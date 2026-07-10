@extends('dashboard')
@section('title_dashboard','Listado de convocatorias')
@section('breadcrumbs')
    {{ Breadcrumbs::render('convocatorias.index') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @can('Crear Convocatoria')
                    <a class="btn btn-danger" href="{{route('convocatorias.create')}}"><i class="fa fa-plus"></i>  Crear nuevo</a>
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
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
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
                            <td>{{ optional($concovatoria->fecha_inicio)->format('Y-m-d') }}</td>
                            <td>{{ optional($concovatoria->fecha_fin)->format('Y-m-d') }}</td>
                            <td>{{$concovatoria->created_at}}</td>
                            <td>{{$concovatoria->updated_at}}</td>                            
                            <td>
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        @can('Actualizar Convocatoria')       
                                        <span class="px-2">                                                                      
                                            <a  href="{{route('convocatorias.edit',$concovatoria->id)}}" title="Editar"><i class='fas fa-edit fa-2x'></i></a>
                                        </span>
                                        @endcan
                                        @can('Detalle Convocatoria')    
                                        <span class="px-2">                                                                               
                                            <a href="{{route('convocatorias.show',$concovatoria->id)}}" title="Detalle"><i class='fas fa-eye fa-2x'></i></a>                                        
                                        </span>
                                        @endcan
                                        @can('Avance convocatoria')
                                        <span class="px-2">                                        
                                            <a  href="{{route('convocatoria.avance',$concovatoria->id)}}" title="Avance"><i class="fas fa-walking fa-2x"></i></a>                                        
                                        </span>
                                        @endcan
                                        
                                        @if(count($concovatoria->cronogramasxetapa($concovatoria->primeraetapa[0]->id)) > 0)
                                            @can('Reporte Convocatoria')
                                            <span class="px-2">                                        
                                                <a  href="{{route('convocatorias.reporte',$concovatoria->id)}}" title="Reporte" target="_blank"><i class="fas fa-clock fa-2x"></i></a>                                        
                                            </span>
                                            @endcan
                                            @if($concovatoria->getOriginal('estado') == 1)
                                                @can('Registrarse en la convocatoria')      
                                                    <span class="px-2">                                              
                                                        <a href="{{route('convocatoria.registrarse',$concovatoria->id)}}" title="registrarse"><i class='fas fa-hand-point-up fa-2x'></i></a>                                               
                                                    </span>
                                                @endcan
                                                
                                                @can('Registro masivo convocatoria')
                                                    <span class="px-2">                                        
                                                        <a  href="{{route('convocatoria.registroMasivo',$concovatoria->id)}}" title="Registro masivo"><i class="fas fa-file-upload fa-2x"></i></a>                                        
                                                    </span>
                                                @endcan
                                                @can('Link registro publico')
                                                    <span class="px-2">                                        
                                                        <a  href="{{route('convocatoria.linkPublicoRegistro',$concovatoria->id)}}" title="Link publico" target="_blank"><i class="fas fa-link fa-2x"></i></a>                                        
                                                    </span>
                                                @endcan
                                            @endif
                                            
                                            @if(count(\Auth::user()->convocatorias->where('id',$concovatoria->id)) > 0)
                                                @role('General')
                                                    <span class="px-2">                                        
                                                        <a  href="{{route('asistencia.caracterizacion_sensibilizacion',[$concovatoria->id,auth()->user()->id])}}" title="Formulario Carcaterización Sensiblización" target="_blank"><i class="fas fa-clipboard-list fa-2x"></i></a>                                        
                                                    </span>
                                                @endrole
                                                @role('General')
                                                    <span class="px-2">                                        
                                                        <a  href="{{route('asistencia.caracterizacion_empresarial',[$concovatoria->id,auth()->user()->id])}}" title="Formulario Carcaterización Empresarial" target="_blank"><i class="fas fa-clipboard-list fa-2x"></i></a>                                        
                                                    </span>
                                                @endrole
                                            @endif
                                            
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