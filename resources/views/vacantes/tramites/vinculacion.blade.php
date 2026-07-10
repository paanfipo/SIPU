@extends('dashboard')
@section('title_dashboard','Proceso de Vinculación')
@section('breadcrumbs')
    {{ Breadcrumbs::render('tramites.vinculacion',$user,$tramite) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vinculación</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="#"  accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset disabled>
                                <hr/>
                                <legend>Oferta</legend>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre_empresa_dependencia">Nombre empresa o dependencia</label>
                                            <input type="text" name="nombre_empresa_dependencia" class="form-control" value="{{$tramite->nombre_empresa_dependencia}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tipo_oferta">Tipo de oferta</label>
                                            <input type="text" name="tipo_oferta" class="form-control" value="{{$tramite->tipoOferta->nombre}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre_oferta">Nombre Oferta</label>
                                            <input type="text" name="nombre_oferta" class="form-control" value="{{$tramite->nombre_oferta}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fecha">Fecha Creación</label>
                                            <input type="text" name="fecha" class="form-control" value="{{$tramite->created_at}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fecha_cierre_vacante">Fecha Cierre</label>
                                            <input type="text" name="fecha_cierre_vacante" class="form-control" value="{{ optional($tramite->fecha_cierre_vacante)->format('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <input type="text" name="estado" class="form-control" value="{{$estado}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fase">Fase</label>
                                            <input type="text" name="nombre_oferta" class="form-control" value="{{$fase}}" required>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset>
                                <legend>Usuario</legend>
                                <hr/>
                                <div class="row">
                                    @if($user->hasRole('Estudiante'))
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong><label for="name">Estudiante: </label></strong>
                                                <a target="_blank" href="{{route('usuario.hojaVida',$user->id)}}">@if(isset($user)){{$user->name}}@endif</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong><label for="codigo_estudiante">Codigo Estudiante:</label></strong>
                                                <span>@if(isset($user->userInfo) ) {{$user->userInfo->codigo_estudiante}} @endif</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong><label for="codigo_carrera">Codigo Carrera:</label></strong>
                                                <span>@if(isset($user->userInfo) ) {{$user->userInfo->codigo_carrera}} @endif</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong><label for="email_institucional">Email Institucional:</label></strong>                                            
                                                <span>@if(isset($user->userInfo) ) {{$user->userInfo->email_institucional}} @endif</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="formato_D10" class="font-weight-bold">D10:</label>
                                                        <a  target="_blank" href="{{route('usuario.D10',$user->id)}}"  class="btn btn-large pull-right" title="Formato D10"><i class="fas fa-address-book fa-2x"></i> Download</a>                                                        
                                                    </div>
                                                </div>
                                                @if(isset($user->curriculum) && $user->curriculum->cedula != "")
                                                <div class="col-md-3">                                            
                                                    <div class="form-group" id="download_cedula">
                                                        <label for="download_cedula_file" class="font-weight-bold">Cedula:</label>                
                                                        <a href="{{route('ofertas.downloadFile', [$user->id,'Cedula'])}}" class="btn btn-large pull-right" id="download_cedula_file"><i class="fa fa-file-download fa-2x"> </i> Download </a>                
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                            <div class="row"> 
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="formato_D10" class="font-weight-bold">D10:</label>
                                                        <a  target="_blank" href="{{route('usuario.D10',$user->id)}}"  class="btn btn-large pull-right" title="Formato D10"><i class="fas fa-address-book fa-2x"></i> Download</a>                                                        
                                                    </div>
                                                </div>
                                                @if(isset($user->curriculum) && $user->curriculum->cedula != "")
                                                <div class="col-md-3">                                            
                                                    <div class="form-group" id="download_cedula">
                                                        <label for="download_cedula_file" class="font-weight-bold">Cedula:</label>                
                                                        <a href="{{route('ofertas.downloadFile', [$user->id,'Cedula'])}}" class="btn btn-large pull-right" id="download_cedula_file"><i class="fa fa-file-download fa-2x"> </i> Download </a>                
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($user->curriculum) && $user->curriculum->tabulado != "")
                                                <div class="col-md-3">
                                                    <div class="form-group" id="download_tabulado">
                                                        <label for="download_tabulado_file" class="font-weight-bold">Tabulado:</label>                
                                                        <a href="{{route('ofertas.downloadFile', [$user->id,'Tabulado'])}}" class="btn btn-large pull-right" id="download_tabulado_file"><i class="fa fa-file-download fa-2x"> </i> Download </a>                
                                                    </div>     
                                                </div>
                                                @endif    
                                                @if(isset($user->curriculum) && $user->curriculum->confidencialidad != "")
                                                <div class="col-md-3">
                                                    <div class="form-group" id="download_confidencialidad">
                                                        <label for="download_confidencialidad_file" class="font-weight-bold">Confidencialidad:</label>                
                                                        <a href="{{route('ofertas.downloadFile', [$user->id,'Confidencialidad'])}}" class="btn btn-large pull-right" id="download_confidencialidad_file"><i class="fa fa-file-download fa-2x"> </i> Download </a>                
                                                    </div>     
                                                </div>  
                                                @endif    
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                @if(isset($user->curriculum) && $user->curriculum->recibo_pago != "")
                                                <div class="col-md-3">            
                                                    <div class="form-group" id="download_recibo_pago">
                                                        <label for="download_recibo_pago_file" class="font-weight-bold">Recibo Pago:</label>                
                                                        <a  href="{{route('ofertas.downloadFile', [$user->id,'Recibo de pago'])}}" class="btn btn-large pull-right" id="download_recibo_pago_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                                    </div>
                                                </div>
                                                @endif    
                                                @if(isset($user->curriculum) && $user->curriculum->certificacion_bancaria != "")
                                                <div class="col-md-3">            
                                                    <div class="form-group" id="download_certificacion_bancaria">
                                                        <label for="download_certificacion_bancaria_file" class="font-weight-bold">Certificación Bancaria:</label>                
                                                        <a href="{{route('ofertas.downloadFile', [$user->id,'Certificacion Bancaria'])}}" class="btn btn-large pull-right" id="download_certificacion_bancaria_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                                    </div>
                                                </div>
                                                @endif    
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="usuario">Detalle Usuario:  </label>
                                                <a href="{{route('usuarios.show',$user->id)}}" name="usuario">{{$user->name}}</a>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </form>            
            <div class="col-md-12">
                <br>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for="created_at" class="font-weight-bold">FECHA CREACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="created_at" value="{{$tramite->created_at}}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="updated_at" class="font-weight-bold">FECHA MODIFICACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="updated_at" value="{{$tramite->updated_at}}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="user_created_at" class="font-weight-bold">USUARIO CREACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="Usuario" id="user_created_at" value="@if(isset($tramite->usuario_creacion)) {{$tramite->usuario_creacion->name}} @endif">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="user_updated_at" class="font-weight-bold">USUARIO MODIFICACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="Usuario" id="user_updated_at" value="@if(isset($tramite->usuario_modificacion)) {{$tramite->usuario_modificacion->name}} @endif">
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <a href="{{route('tramites.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@stop