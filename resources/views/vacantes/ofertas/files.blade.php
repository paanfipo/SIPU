@extends('dashboard')
@section('title_dashboard','Documentación Solicitada Oferta')
@section('breadcrumbs')
    {{ Breadcrumbs::render('ofertas.uploadFile',$oferta) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Oferta</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('ofertas.uploadFile',$oferta->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <fieldset disabled>
                        <legend>Datos Oferta</legend>
                        @include('vacantes.ofertas.form')
                    </fieldset>
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
                                    <input type="file" class="form-control-file" id="cedula" name="cedula" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="upload_tabulado">
                                    <label for="tabulado">Tabulado: *</label>
                                    <input type="file" class="form-control-file" id="tabulado" name="tabulado" required>
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
                                    <input type="file" class="form-control-file" id="certificacion_bancaria" name="certificacion_bancaria" required>
                                </div>
                            </div>    
                        </div>
                    </fieldset> 
                    <div class="col-md-12">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Subir Archivo</button>
                            <a href="{{route('ofertas.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                        </div>
                        </br>
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