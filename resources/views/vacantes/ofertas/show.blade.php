@extends('dashboard')
@section('title_dashboard','Detalle Oferta')
@section('breadcrumbs')
    {{ Breadcrumbs::render('ofertas.update',$oferta) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Oferta</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('ofertas.update',$oferta->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <fieldset @if(isset($disabled)){{$disabled}}@endif>
                        <legend>Datos Oferta</legend>
                        @include('vacantes.ofertas.form')
                    </fieldset>
                    @if(isset(Auth::user()->curriculum) && (Auth::user()->curriculum->cedula != "" ||  Auth::user()->curriculum->tabulado != "" || Auth::user()->curriculum->confidencialidad != "" || Auth::user()->curriculum->recibo_pago != "" || Auth::user()->curriculum->certificacion_bancaria != ""))
                    <fieldset>                        
                        <legend>Documentación</legend>
                        <div class="row"> 
                            
                            @if(isset(Auth::user()->curriculum) && Auth::user()->curriculum->cedula != "")
                            <div class="col-md-3">                                            
                                <div class="form-group" id="download_cedula">
                                    <label for="download_cedula_file" class="font-weight-bold">Cedula:</label>                
                                    <a href="{{route('ofertas.downloadFile', [Auth::user()->id,'Cedula'])}}" class="btn btn-large pull-right" id="download_cedula_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                </div>
                            </div>
                            @endif
                            @if(isset(Auth::user()->curriculum) && Auth::user()->curriculum->tabulado != "")
                            <div class="col-md-3">
                                <div class="form-group" id="download_tabulado">
                                    <label for="download_tabulado_file" class="font-weight-bold">Tabulado:</label>                
                                    <a href="{{route('ofertas.downloadFile', [Auth::user()->id,'Tabulado'])}}" class="btn btn-large pull-right" id="download_tabulado_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                </div>     
                            </div>
                            @endif    
                            @if(isset(Auth::user()->curriculum) && Auth::user()->curriculum->confidencialidad != "")
                            <div class="col-md-3">
                                <div class="form-group" id="download_confidencialidad">
                                    <label for="download_confidencialidad_file" class="font-weight-bold">Confidencialidad:</label>                
                                    <a href="{{route('ofertas.downloadFile', [Auth::user()->id,'Confidencialidad'])}}" class="btn btn-large pull-right" id="download_confidencialidad_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                </div>     
                            </div>  
                            @endif    
                        </div>
                        <div class="row">
                            @if(isset(Auth::user()->curriculum) && Auth::user()->curriculum->recibo_pago != "")
                            <div class="col-md-3">            
                                <div class="form-group" id="download_recibo_pago">
                                    <label for="download_recibo_pago_file" class="font-weight-bold">Recibo Pago:</label>                
                                    <a  href="{{route('ofertas.downloadFile', [Auth::user()->id,'Recibo de pago'])}}" class="btn btn-large pull-right" id="download_recibo_pago_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                </div>
                            </div>
                            @endif    
                            @if(isset(Auth::user()->curriculum) && Auth::user()->curriculum->certificacion_bancaria != "")
                            <div class="col-md-3">            
                                <div class="form-group" id="download_certificacion_bancaria">
                                    <label for="download_certificacion_bancaria_file" class="font-weight-bold">Certificación Bancaria:</label>                
                                    <a href="{{route('ofertas.downloadFile', [Auth::user()->id,'Certificacion Bancaria'])}}" class="btn btn-large pull-right" id="download_certificacion_bancaria_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                </div>
                            </div>
                            @endif    
                        </div>
                    </fieldset>                                     
                    @endif    
                    <div class="col-md-12">
                        <div class="box-footer">
                            @if(!isset($disabled))
                                <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                            @endif                            
                            <a href="{{route('ofertas.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                        </div>
                        </br>
                    </div>  
                </div>                  
            </form>
            <div class="col-md-12">
                <div class="row">
                    @if(isset($disabled))
                        @if(!$checkin_on)
                            @can('Postular Oferta')    
                                @if(($oferta->tipoOferta->nombre == 'Monitorias') )
                                    @role('Estudiante')
                                    <form method="POST" action="{{route('ofertas.postularEstudiante',$oferta->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <legend>Documentación Solicitada</legend>
                                                <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group" id="formato_D10">
                                                                <label for="formato_D10">Generar formato D10: *</label></br>
                                                                <a  href="{{route('usuario.hojaVida',\Auth::user()->id)}}" class="btn btn-large pull-right" title="Hoja de vida"><i class="fas fa-address-book fa-2x"></i> Hoja de vida</a>
                                                            </div> 
                                                        </div>    
                                                        <div class="col-md-3">            
                                                            <div class="form-group" id="upload_cedula">
                                                                <label for="cedula">Cedula: *</label>
                                                                <input type="file" class="form-control-file" id="cedula" name="cedula">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" id="upload_tabulado">
                                                                <label for="tabulado">Tabulado: *</label>
                                                                <input type="file" class="form-control-file" id="tabulado" name="tabulado">
                                                            </div>  
                                                        </div>    
                                                        <div class="col-md-3">
                                                            <div class="form-group" id="upload_confidencialidad">
                                                                <label for="confidencialidad">Formatos de Confidencialidad: </label>
                                                                <input type="file" class="form-control-file" id="confidencialidad" name="confidencialidad">
                                                            </div>     
                                                        </div>  
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">            
                                                            <div class="form-group" id="upload_recibo_pago">
                                                                <label for="recibo_pago">Recibo de pago: </label>
                                                                <input type="file" class="form-control-file" id="recibo_pago" name="recibo_pago" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">            
                                                            <div class="form-group" id="upload_certificacion_bancaria">
                                                                <label for="certificacion_bancaria">Certificación Bancaria: *</label>
                                                                <input type="file" class="form-control-file" id="certificacion_bancaria" name="certificacion_bancaria" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Postularse</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">
                                                &times;
                                            </button>
                                            <ul>
                                                <li>Debe ser estudiante para postularse en esta oferta</li>                                        
                                            </ul>
                                        </div>
                                    </div>
                                    @endrole   
                                @else
                                    <a href="{{route('ofertas.postular',$oferta->id)}}" class='btn btn-danger'><i class='fas fa-bookmark'></i>  Postularse</a>
                                @endif
                            @endcan
                        @endif
                    @endif
                    @if(isset($disabled))
                        @if($checkin_on)
                            @can('Retirar Oferta')
                                <a href="{{route('ofertas.retirar',$oferta->id)}}" class='btn btn-danger'><i class='fa fa-ban'></i>  Retirar</a>
                            @endcan
                        @endif
                    @endif
                </div>
            </div>
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
                            <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="created_at" value="{{$oferta->created_at}}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="updated_at" class="font-weight-bold">FECHA MODIFICACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="updated_at" value="{{$oferta->updated_at}}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="user_created_at" class="font-weight-bold">USUARIO CREACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="Usuario" id="user_created_at" value="@if(isset($oferta->usuario_creacion)) {{$oferta->usuario_creacion->name}} @endif">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="user_updated_at" class="font-weight-bold">USUARIO MODIFICACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="Usuario" id="user_updated_at" value="@if(isset($oferta->usuario_modificacion)) {{$oferta->usuario_modificacion->name}} @endif">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection