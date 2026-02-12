
@extends('dashboard')
@section('title_dashboard','Hoja de vida usuario')
@section('breadcrumbs')
    {{ Breadcrumbs::render('convocatorias.hojaVida',$usuario,$convocatoria,$etapa) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Usuario</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="col-md-12">
                    <div class="row">    
                        <div class="col-md-6">
                            <fieldset disabled>
                                <hr/>
                                    <legend>Detalle Usuario</legend>                                
                                <div class="row">                  
                                    @if(isset($usuario))
                                        <div class="col-md-4">
                                            <a class="thumbnail">
                                                @if(isset($usuario->userInfo) && $usuario->userInfo->foto != "")
                                                    <img style="width:190px; height:191px;" src="{{ asset('storage/'.$usuario->userInfo->foto ) }}" />
                                                @else
                                                    <img style="width:190px; height:191px;" src="{{ asset('storage/users/photo/no_profile.png') }}" />
                                                @endif
                                            </a>
                                        </div>
                                        @if(isset($usuario->userInfo)) 
                                            <div class="col-md-2 offset-md-1">
                                                @if($usuario->userInfo->facebook != "")
                                                    <a href="{{$usuario->userInfo->facebook}}" target="black">
                                                        <i class="fab fa-facebook-f fa-2x"></i>
                                                    </a>
                                                @else
                                                    <a href="https://www.facebook.com/"  target="black">
                                                        <i class="fab fa-facebook-f fa-2x"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="col-md-2 offset-md-1">
                                                @if($usuario->userInfo->instagram != "")
                                                    <a href="{{$usuario->userInfo->instagram}}"  target="black">
                                                        <i class="fab fa-instagram fa-2x" style="color: red"></i>
                                                    </a>
                                                @else
                                                    <a href="https://www.instagram.com/" target="black">
                                                        <i class="fab fa-instagram fa-2x" style="color: red"></i>
                                                    </a>
                                                @endif
                                            </div>                       
                                        @endif                                  
                                    @endif                
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <br/>
                                        <br/>
                                        <div class="form-group">
                                            <label for="name">Nombre:</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="@if(isset($usuario) ) {{$usuario->name}} @else {{ old('name') }} @endif">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email personal:</label>
                                            <p><a href="mailto:{{$usuario->email}}">{{$usuario->email}}</a></p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="rol">Rol:</label>
                                            <select class="form-control" name="rol" id="rol">
                                                <option value="">Seleccione un rol</option>
                                                @foreach($roles as $rol)
                                                    <option value="{{$rol->name}}" @if((isset($usuario) && $usuario->hasRole($rol->name)) || (old('rol') ==  $rol->name)) selected @endif>{{$rol->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset disabled>
                                <hr/>
                                <legend>Información</legend>            
                                <div class="row">      
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email Institucional:</label>
                                            @if($usuario->userInfo->email_institucional != "")
                                                <a href="mailto:{{$usuario->userInfo->email_institucional}}">{{$usuario->userInfo->email_institucional}}</a>
                                            @else
                                                <p>Correo no registrado</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="contact_name">Telefonos:</label>
                                        <div style="margin-top: 10px;">
                                            <table class="table" id="table_phones">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" colspan="2">{{ ucfirst(__('number')) }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($usuario->userInfo) && $usuario->userInfo->telefonos != null)
                                                        @foreach(json_decode($usuario->userInfo->telefonos) as $cel)
                                                            <tr id="item_{{$loop->iteration}}">
                                                                <td>{{$cel}} <input type="hidden" name="phone_numbers[]" value="{{$cel}}">
                                                                </td>                                            
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="contact_name">Emprendimiento:</label>
                                        <div style="margin-top: 10px;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Descripción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                                        
                                                    <tr>
                                                        <td>@if($emprendimiento != null) {{$emprendimiento->nombre}} @endif</td>                                            
                                                        <td>@if($emprendimiento != null) {{$emprendimiento->descripcion}} @endif</td>                                            
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div> 
                </div>
                <div class="col-md-12">
                    <fieldset>
                        <legend>Novedades:</legend>
                        <div class="col-md-12" id="list_novedades">
                            @foreach($novedades as $novedad)
                               <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$novedad["type"]}}</h5>
                                        <p class="card-text">{{$novedad["message"]}}</p>
                                        <p class="card-text">De: {{$novedad["de"]}}</p>
                                        <p class="card-text">Para: {{$novedad["para"]}}</p>
                                    </div>
                                </div>
                            @endforeach                            
                        </div>
                    </fieldset>
                </div>
                
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Documentación</legend>
                            @foreach($files as $file)
                                <div class="col-md-6">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-header">
                                            {{$file->cronograma->actividad->nombre}}
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="col-md-12">        
                                                    <div class="col-md-6" id="download_file_1">
                                                        <label for="descargar" class="font-weight-bold">Download File 1:</label>
                                                        <div class="input-group">  
                                                            <a href="{{route('gestiones.downloadFile', $file->id)}}/1" class="btn btn-large pull-right" id="download_opciones1"><i class="fa fa-file-download fa-2x"> </i> Download File 1 </a>
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="col-md-12">
                                                    <div class="col-md-6" id="download_file_2">
                                                        <label for="descargar" class="font-weight-bold">Download File 2:</label>
                                                        <div class="input-group">  
                                                            <a href="{{route('gestiones.downloadFile', $file->id)}}/2" class="btn btn-large pull-right" id="download_opciones2"><i class="fa fa-file-download fa-2x"> </i> Download File 2 </a>
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="col-md-12">                        
                                                    <div class="col-md-6" id="download_file_3">
                                                        <label for="descargar" class="font-weight-bold">Download File 3:</label>
                                                        <div class="input-group">  
                                                            <a href="{{route('gestiones.downloadFile', $file->id)}}/3" class="btn btn-large pull-right" id="download_opciones3"><i class="fa fa-file-download fa-2x"> </i> Download File 3 </a>
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>                            
                            @endforeach

                        </fieldset>
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
                                <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="created_at" value="{{$usuario->created_at}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="updated_at" class="font-weight-bold">FECHA MODIFICACIÓN</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="updated_at" value="{{$usuario->updated_at}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="user_created_at" class="font-weight-bold">USUARIO CREACIÓN</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                </div>
                                <input type="text" disabled class="form-control" placeholder="Usuario" id="user_created_at" value="@if(isset($usuario->usuario_creacion)) {{$usuario->usuario_creacion->name}} @endif">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="user_updated_at" class="font-weight-bold">USUARIO MODIFICACIÓN</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                </div>
                                <input type="text" disabled class="form-control" placeholder="Usuario" id="user_updated_at" value="@if(isset($usuario->usuario_modificacion)) {{$usuario->usuario_modificacion->name}} @endif">
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{{route('convocatoria.avance',$convocatoria->id)}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection



