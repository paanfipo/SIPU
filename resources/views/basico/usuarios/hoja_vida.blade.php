@extends('dashboard')
@section('title_dashboard','Hoja de vida del usuario')
@section('breadcrumbs')
    {{ Breadcrumbs::render('usuario.hojaVida', $usuario) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Hoja de vida del usuario</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('usuario.savecv',$usuario->id)}}"  accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$usuario->id}}">
                <div class="col-md-12">
                    {{ csrf_field() }}
                    <div class="row">    
                        <div class="col-md-6">
                            <fieldset>
                                <hr/>
                                <legend>Detalle</legend>
                                
                                <div class="row">       
                                    <div class="col-md-4">
                                        <a class="thumbnail">
                                            @if(isset($usuario->userInfo) && $usuario->userInfo->foto != "")
                                                <img style="width:190px; height:191px;" src="{{ asset('storage/'.$usuario->userInfo->foto ) }}" />
                                            @else
                                                <img style="width:190px; height:191px;" src="{{ asset('storage/users/photo/no_profile.png') }}" />
                                            @endif
                                        </a>
                                    </div>     
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nombre:</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="@if(isset($usuario) ) {{$usuario->name}} @else {{ old('name') }} @endif">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="@if(isset($usuario) ) {{$usuario->email}} @else {{ old('email') }} @endif" disabled>
                                        </div>
                                    </div>                

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">                            
                                                <div class="form-group">                                
                                                    <label for="sexo">Sexo:</label><br/>
                                                    @foreach($items_sexo as $sexo)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sexo" id="sexo_{{$sexo->id}}" value="{{$sexo->id}}" @if((isset($usuario->userInfo) && $usuario->userInfo->sexo == $sexo->id) || (old('sexo') ==  $sexo->id)) checked @endif>
                                                            <label class="form-check-label" for="sexo_{{$sexo->id}}">{{$sexo->nombre}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edad">Edad:</label>
                                                    <input type="edad" class="form-control" name="edad" id="edad" placeholder="Edad" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->edad}} @else {{old('edad')}}  @endif">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="departamento">Departamento</label>
                                                    <select class="form-control" id="departamento" name="departamento">
                                                        <option value="" selected>Seleccione un departamento</option>
                                                        @foreach($departamentos as $departamento)
                                                                <option value="{{$departamento->id}}" @if((isset($usuario->userInfo) && isset($usuario->userInfo->ciudad->departamento) &&  $usuario->userInfo->ciudad->departamento->id == $departamento->id) || old('departamento') == $departamento->id ) selected @endif>{{$departamento->nombre}}</option>                                        
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ciudad">Ciudad</label>
                                                    <select class="form-control" name="ciudad_id" id="ciudad">        
                                                        <option value="" selected>Seleccione una ciudad</option>
                                                        @foreach($ciudades as $ciudad)
                                                                <option value="{{$ciudad->id}}" @if((isset($usuario->userInfo) && $usuario->userInfo->ciudad_id == $ciudad->id) || old('ciudad_id') == $ciudad->id ) selected @endif>{{$ciudad->nombre}}</option>                                        
                                                        @endforeach                         
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="direccion">Dirección:</label>
                                                    <input type="text" class="form-control" name="direccion" id="direccion" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->direccion}}  @endif" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="barrio">Barrio:</label>
                                                    <input type="text" class="form-control" name="barrio" id="barrio" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->barrio}}  @endif" >
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="estrato">Estrato:</label>
                                            <input type="number" class="form-control" name="estrato" id="estrato" 
                                            @if( isset($usuario->userInfo) ) value="{{$usuario->userInfo->estrato}}" @else  value="old('estrato')"  @endif min="1" max="5" >
                                        </div>
                                    </div>                                    
                                    
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="departamento">Tipo de documento de identidad</label>
                                                    <select class="form-control" id="tipo_documento" name="tipo_documento">
                                                        <option value="" selected>Seleccione un tipo de documento de identidad</option>
                                                        @foreach($items_tipos_documento as $tipo)
                                                                <option value="{{$tipo->id}}" @if( (isset($usuario->userInfo) && $usuario->userInfo->tipo_documento == $tipo->id) || old('tipo_documento') == $tipo->id) selected @endif>{{$tipo->nombre}}</option>                                        
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="numero_documento">Numero de documento</label>
                                                    <input type="text" class="form-control" name="numero_documento" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->numero_documento}} @else {{old('numero_documento')}} @endif">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                                    <input class="form-control" 
                                                            type="date"
                                                            id="fecha_nacimiento" 
                                                            name="fecha_nacimiento"
                                                            @if( isset($usuario->userInfo) && $usuario->userInfo->fecha_nacimiento != null) value="{{$usuario->userInfo->fecha_nacimiento->format('Y-m-d')}}" @endif>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lugar_nacimiento">Lugar de Nacimiento</label>
                                                    <select class="form-control" name="lugar_nacimiento" id="lugar_nacimiento">  
                                                        <option value="" selected>Seleccione ciudad de nacimiento</option>
                                                        @foreach($ciudades as $ciudad)
                                                                <option value="{{$ciudad->id}}" @if((isset($usuario->userInfo) && $usuario->userInfo->lugar_nacimiento == $ciudad->id) || old('lugar_nacimiento') == $ciudad->id) selected @endif>{{$ciudad->nombre}}</option>                                        
                                                        @endforeach                               
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fecha_lugar_expedicion">Fecha y lugar de expedición:</label>
                                            <input type="text" class="form-control" name="fecha_lugar_expedicion" id="fecha_lugar_expedicion" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->fecha_lugar_expedicion}} @else {{old('fecha_lugar_expedicion')}} @endif" >
                                        </div>
                                    </div>                                   
                                    
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset>
                                <hr/>
                                <legend>Información</legend>            
                                <div class="row">                             
                                    <div class="col-md-12">
                                        <br/>
                                        <div class="form-group custom-file"> 
                                            <input type="file" class="custom-file-input" id="foto" name="foto">
                                            <label class="custom-file-label" for="foto">Elegir Foto</label>
                                        </div>
                                    </div>
                            
                                </div>
                                <br/>
                                <div class="row">                
                                    <div class="col-md-6">
                                        <label for="phone_numbers" class="font-weight-bold">Agregar numeros</label>
                                        <div style="display: flex; justify-content: space-between;">
                                            <div class="col-md-10">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="fa fa-phone"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="phone_numbers" >
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger" onclick="addCelular()" >
                                                    <i class="fa fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contact_name">Telefonos</label>
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
                                                                <td>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="removeCelular('item_{{$loop->iteration}}')">
                                                                        <i class="fa fa-window-close"></i>
                                                                    </button>
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
                                    <div class="col-md-6">
                                        <label for="libreta_militar" class="font-weight-bold">Agregar Libreta</label>
                                        <div style="display: flex; justify-content: space-between;">
                                            <div class="col-md-10">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="fa fa-address-card" aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="libreta_distrito" placeholder="Distrito">
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: flex; justify-content: space-between;">
                                            <div class="col-md-10">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="fa fa-address-card" aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="libreta_numero" placeholder="Libreta Número">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger" onclick="addLibreta()" >
                                                    <i class="fa fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="libreta_militar">Libreta Militar</label>
                                        <div style="margin-top: 10px;">
                                            <table class="table table-responsive table-striped" id="table_militar">
                                                <thead>
                                                    <tr>
                                                        <th>Distrito</th>
                                                        <th>Numero</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($usuario->userInfo) && $usuario->userInfo->libreta_militar != null)
                                                        @foreach(json_decode($usuario->userInfo->libreta_militar, true) as $lib)
                                                            <tr id="item_{{$loop->iteration}}">
                                                                <td>{{$lib['distrito']}} <input type="hidden" name="libreta_militar[{{$loop->iteration}}][distrito]" value="{{$lib['distrito']}}"></td>
                                                                <td>{{$lib['numero']}} <input type="hidden" name="libreta_militar[{{$loop->iteration}}][numero]" value="{{$lib['numero']}}"></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="removeLibreta('item_{{$loop->iteration}}')">
                                                                        <i class="fa fa-window-close"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nacionalidad">Nacionalidad</label>
                                        <select class="form-control" id="nacionalidad" name="nacionalidad">
                                            <option value="" selected>Seleccione un país</option>
                                            @foreach($paises as $pais)
                                                    <option value="{{$pais->id}}" @if((isset($usuario->userInfo) && $usuario->userInfo->nacionalidad == $pais->id) || old('nacionalidad') == $pais->id) selected @endif>{{$pais->nombre}}</option>                                        
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="estado_civil">Estado Civil</label>
                                        <select class="form-control" id="estado_civil" name="estado_civil">
                                            <option value="" selected>Estado Civil</option>
                                            @foreach($items_estado_civil as $civil)
                                                    <option value="{{$civil->id}}" @if((isset($usuario->userInfo) && $usuario->userInfo->estado_civil == $civil->id) || old('estado_civil') == $civil->id) selected @endif>{{$civil->nombre}}</option>                                        
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">          
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cant_personas_cargo">Cantidad de personas a cargo:</label>
                                                <input type="text" class="form-control" name="cant_personas_cargo" id="cant_personas_cargo" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->personas_a_cargo}} @else  {{old('cant_personas_cargo')}} @endif" >
                                            </div>                        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="posicion_familiar">Posición Familiar:</label>
                                                <input type="text" class="form-control" name="posicion_familiar" id="posicion_familiar" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->posicion_familiar}} @else {{old('posicion_familiar')}}  @endif" >
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                @if($usuario->hasRole('Estudiante'))
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="formato_D10" class="font-weight-bold">Generar formato D10: *</label>
                                                <a href="{{route('usuario.D10',$usuario->id)}}" target="_blank" title="PDF"><i class="fab fa-wpforms fa-2x"></i></a>
                                            </div>
                                        </div>
                                        @if(isset($usuario->curriculum) && $usuario->curriculum->cedula != "")
                                        <div class="col-md-6">                                            
                                            <div class="form-group" id="download_cedula">
                                                <label for="download_cedula_file" class="font-weight-bold">Cedula:</label>                
                                                <a href="{{route('ofertas.downloadFile', [$usuario->id,'Cedula'])}}" class="btn btn-large pull-right" id="download_cedula_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-md-6">            
                                            <div class="form-group" id="upload_cedula">
                                                <label for="cedula">Cedula:</label>
                                                <input type="file" class="form-control-file" id="cedula" name="cedula">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @if(isset($usuario->curriculum) && $usuario->curriculum->tabulado != "")
                                            <div class="col-md-6">
                                                <div class="form-group" id="download_tabulado">
                                                    <label for="download_tabulado_file" class="font-weight-bold">Tabulado:</label>                
                                                    <a href="{{route('ofertas.downloadFile', [$usuario->id,'Tabulado'])}}" class="btn btn-large pull-right" id="download_tabulado_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                                </div>     
                                            </div>
                                        @else
                                            <div class="col-md-6">
                                                <div class="form-group" id="upload_tabulado">
                                                    <label for="tabulado">Tabulado:</label>
                                                    <input type="file" class="form-control-file" id="tabulado" name="tabulado" >
                                                </div> 
                                            </div>    
                                        @endif
                                        @if(isset($usuario->curriculum) && $usuario->curriculum->confidencialidad != "")
                                            <div class="col-md-6">
                                                <div class="form-group" id="download_confidencialidad">
                                                    <label for="download_confidencialidad_file" class="font-weight-bold">Confidencialidad:</label>                
                                                    <a href="{{route('ofertas.downloadFile', [$usuario->id,'Confidencialidad'])}}" class="btn btn-large pull-right" id="download_confidencialidad_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                                </div>     
                                            </div>
                                        @else
                                            <div class="col-md-6">
                                                <div class="form-group" id="upload_confidencialidad">
                                                    <label for="confidencialidad">Formatos de Confidencialidad: </label>
                                                    <input type="file" class="form-control-file" id="confidencialidad" name="confidencialidad">
                                                </div>     
                                            </div>  
                                        @endif  
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @if(isset($usuario->curriculum) && $usuario->curriculum->recibo_pago != "")
                                            <div class="col-md-6">            
                                                <div class="form-group" id="download_recibo_pago">
                                                    <label for="download_recibo_pago_file" class="font-weight-bold">Recibo Pago:</label>                
                                                    <a  href="{{route('ofertas.downloadFile', [$usuario->id,'Recibo de pago'])}}" class="btn btn-large pull-right" id="download_recibo_pago_file"><i class="fa fa-file-download fa-2x"> </i>Download</a>                
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-6">            
                                                <div class="form-group" id="upload_recibo_pago">
                                                    <label for="recibo_pago">Recibo de pago: </label>
                                                    <input type="file" class="form-control-file" id="recibo_pago" name="recibo_pago">
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($usuario->curriculum) && $usuario->curriculum->certificacion_bancaria != "")
                                            <div class="col-md-6">            
                                                <div class="form-group" id="download_certificacion_bancaria">
                                                    <label for="download_certificacion_bancaria_file" class="font-weight-bold">Certificación Bancaria:</label>                
                                                    <a href="{{route('ofertas.downloadFile', [$usuario->id,'Certificacion Bancaria'])}}" class="btn btn-large pull-right" id="download_certificacion_bancaria_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                                </div>
                                            </div>
                                        @else
                                            <di class="col-md-6">
                                                <div class="form-group" id="upload_certificacion_bancaria">
                                                    <label for="certificacion_bancaria">Certificación Bancaria: </label>
                                                    <input type="file" class="form-control-file" id="certificacion_bancaria" name="certificacion_bancaria" >
                                                </div>
                                            </di>
                                        @endif 
                                    </div>
                                </div>
                                @endrole
                            </fieldset>                            
                        </div>                    
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                <h3><i class="fa fa-plus"></i>Estudios</h3>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <hr/>   
                                            <h4>Bachillerato</h4>
                                            <div class="row">
                                                @if(isset($usuario->curriculum) && $usuario->curriculum->bachillerato != null)
                                                    @php                                                    
                                                        $bachillerato = json_decode($usuario->curriculum->bachillerato,true)
                                                    @endphp
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="titulo_obtenido">Titulo Obtenido:</label>
                                                        <input type="text" class="form-control" name="bachillerato[titulo_obtenido]" id="titulo_obtenido" placeholder="Titulo obtenido" value="@if(isset($usuario->curriculum) && isset($bachillerato) ) {{$bachillerato['titulo_obtenido']}}  @endif">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ano_finalizacion">Año Finalización:</label>
                                                        <input type="text" class="form-control" name="bachillerato[ano_finalizacion]" id="ano_finalizacion" placeholder="Año de finalización" value="@if(isset($usuario->curriculum) && isset($bachillerato) ) {{$bachillerato['ano_finalizacion']}}  @endif">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nombre_establecimiento">Nombre del colegio:</label>
                                                        <input type="text" class="form-control" name="bachillerato[nombre_establecimiento]" id="nombre_establecimiento" placeholder="Nombre colegio" value="@if(isset($usuario->curriculum) && isset($bachillerato) ) {{$bachillerato['nombre_establecimiento']}}  @endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>       
                                            <h4>Educación Superior</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="superior_nombre_establecimiento">Nombre del establecimiento:</label>
                                                        <input type="text" class="form-control" name="" id="superior_nombre_establecimiento" placeholder="Nombre establecimiento" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="superior_titulo_obtenido">Titulo Obtenido:</label>
                                                        <input type="text" class="form-control" name="" id="superior_titulo_obtenido" placeholder="Titulo obtenido" value="">
                                                    </div>
                                                </div>                                                

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="superior_ciudad">Ciudad:</label>
                                                        <input type="text" class="form-control" name="" id="superior_ciudad" placeholder="Ciudad" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="superior_ano_finalizacion">Año Finalización:</label>
                                                        <input type="number" class="form-control" name="" id="superior_ano_finalizacion" placeholder="Año de finalización" value="">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="superior_semestres">Semestres:</label>
                                                        <input type="number" class="form-control" name="" id="superior_semetres" placeholder="Cantidad de semestres" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-danger" onclick="addEduSuperior()"><i class="fas fa-plus"></i> Agregar</button>                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-md-12">
                                                <br>
                                                   <div class="table-responsive">
                                                        <table class="table table-striped" id= "table_educacion_superior">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">Titulo Obtenido</th>
                                                                <th scope="col">Nombre del establecimiento</th>
                                                                <th scope="col">Ciudad</th>
                                                                <th scope="col">Año de finalización</th>
                                                                <th scope="col">Semestre</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                @if(isset($usuario->curriculum) && $usuario->curriculum->educacion_superior != null)
                                                                    @foreach(json_decode($usuario->curriculum->educacion_superior,true) as $edu_superior)
                                                                        <tr id="item_eduSuperior_{{$loop->iteration}}">
                                                                            <td>{{$edu_superior['nombre_establecimiento']}} <input type="hidden" name="educacion_superior[{{$loop->iteration}}][nombre_establecimiento]" value="{{$edu_superior['nombre_establecimiento']}}"></td>
                                                                            <td>{{$edu_superior['titulo_obtenido']}} <input type="hidden" name="educacion_superior[{{$loop->iteration}}][titulo_obtenido]" value="{{$edu_superior['titulo_obtenido']}}"></td>
                                                                            <td>{{$edu_superior['ciudad']}} <input type="hidden" name="educacion_superior[{{$loop->iteration}}][ciudad]" value="{{$edu_superior['ciudad']}}"></td>
                                                                            <td>{{$edu_superior['ano_finalizacion']}} <input type="hidden" name="educacion_superior[{{$loop->iteration}}][ano_finalizacion]" value="{{$edu_superior['ano_finalizacion']}}"></td>
                                                                            <td>{{$edu_superior['semestres']}} <input type="hidden" name="educacion_superior[{{$loop->iteration}}][semestres]" value="{{$edu_superior['semestres']}}"></td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-danger"
                                                                                    onclick="removeEduSuperior('item_eduSuperior_{{$loop->iteration}}')">
                                                                                    <i class="fa fa-window-close"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif                                                         
                                                            </tbody>
                                                        </table>
                                                   </div>
                                                    
                                                </div>
                                            </div>
                                            <hr/>   
                                            <h4>Capacitaciones</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="curso_nombre_establecimiento">Nombre del establecimiento:</label>
                                                        <input type="text" class="form-control" name="" id="curso_nombre_establecimiento" placeholder="Nombre establecimiento" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="curso_nombre">Nombre del curso o seminario:</label>
                                                        <input type="text" class="form-control" name="" id="curso_nombre" placeholder="Nombre del curso o Seminario" value="">
                                                    </div>
                                                </div>    
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="curso_duracion">Duración del curso o seminario:</label>
                                                        <input type="text" class="form-control" name="" id="curso_duracion" placeholder="Duración del curso o seminario" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="curso_fecha_finalizacion">Fecha de terminación:</label>
                                                        <input type="date" class="form-control" name="" id="curso_fecha_finalizacion" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-danger" onclick="addCursos()"><i class="fas fa-plus"></i> Agregar</button>                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <br>
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id= "table_cursos">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">Nombre del establecimiento</th>
                                                            <th scope="col">Nombre del curso o seminario</th>
                                                            <th scope="col">Duracion curso o seminario</th>
                                                            <th scope="col">Fecha de finalización</th>
                                                            <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($usuario->curriculum) && $usuario->curriculum->capacitaciones != null)
                                                                @foreach(json_decode($usuario->curriculum->capacitaciones,true) as $capacitacion)
                                                                    <tr id="item_curso_{{$loop->iteration}}">
                                                                        <td>{{$capacitacion['nombre_establecimiento']}} <input type="hidden" name="cursos[{{$loop->iteration}}][nombre_establecimiento]" value="{{$capacitacion['nombre_establecimiento']}}"></td>
                                                                        <td>{{$capacitacion['nombre']}} <input type="hidden" name="cursos[{{$loop->iteration}}][nombre]" value="{{$capacitacion['nombre']}}"></td>
                                                                        <td>{{$capacitacion['duracion']}} <input type="hidden" name="cursos[{{$loop->iteration}}][duracion]" value="{{$capacitacion['duracion']}}"></td>
                                                                        <td>{{$capacitacion['fecha_finalizacion']}} <input type="hidden" name="cursos[{{$loop->iteration}}][fecha_finalizacion]" value="{{$capacitacion['fecha_finalizacion']}}"></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger"
                                                                                onclick="removeCurso('item_curso_{{$loop->iteration}}')">
                                                                                <i class="fa fa-window-close"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif                                                                
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <hr/>   
                                            <h4>Sistemas</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="sistemas">Sistemas o programas que manejas:</label>
                                                        <textarea type="text" class="form-control" name="sistemas" id="sistemas" placeholder="Sistemas o programas que manejas" value="" rows="3">@if(isset($usuario->curriculum) ) {{$usuario->curriculum->sistemas}} @else {{old('sistemas')}}@endif</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>   
                                            <h4>Idiomas</h4>
                                            <p>MARCAR SU NIVEL DE CONOCIMIENTO: MUY BUENO, BUENO, REGULAR</p>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="idioma_nombre">Idioma:</label>
                                                        <input type="text" class="form-control" name="" id="idioma_nombre" placeholder="Nombre del idioma que maneja" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="idioma_habla">Habla:</label>
                                                        <input type="text" class="form-control" name="" id="idioma_habla" placeholder="Nivel de conocmiento en el habla" value="">
                                                    </div>
                                                </div>    
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="idioma_escritura">Escritura:</label>
                                                        <input type="text" class="form-control" name="" id="idioma_escritura" placeholder="Nivel de conocimiento en la escritura" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="idioma_lectura">Lectrura:</label>
                                                        <input type="text" class="form-control" name="" id="idioma_lectura" placeholder="Nivel de conocimeinto en la lectura" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-danger" onclick="addIdiomas()"><i class="fas fa-plus"></i> Agregar</button>                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="table-responsive">
                                                <br>
                                                    <table class="table table-striped" id= "table_idiomas">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">Idioma</th>
                                                            <th scope="col">Habla</th>
                                                            <th scope="col">Escritura</th>
                                                            <th scope="col">Lectura</th>
                                                            <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($usuario->curriculum) && $usuario->curriculum->idiomas != null)
                                                                @foreach(json_decode($usuario->curriculum->idiomas,true) as $idioma)
                                                                    <tr id="item_idioma_{{$loop->iteration}}">
                                                                        <td>{{$idioma['nombre']}} <input type="hidden" name="idiomas[{{$loop->iteration}}][nombre]" value="{{$idioma['nombre']}}"></td>
                                                                        <td>{{$idioma['habla']}} <input type="hidden" name="idiomas[{{$loop->iteration}}][habla]" value="{{$idioma['habla']}}"></td>
                                                                        <td>{{$idioma['escritura']}} <input type="hidden" name="idiomas[{{$loop->iteration}}][escritura]" value="{{$idioma['escritura']}}"></td>
                                                                        <td>{{$idioma['lectura']}} <input type="hidden" name="idiomas[{{$loop->iteration}}][lectura]" value="{{$idioma['lectura']}}"></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger"
                                                                                onclick="removeIdioma('item_idioma_{{$loop->iteration}}')">
                                                                                <i class="fa fa-window-close"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif                                                          
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <h3><i class="fa fa-plus"></i>Perfil Laboral</h3>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <hr/>   
                                            <h4>Experienca Laboral</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_nombre">Nombre de la empresa:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_nombre" placeholder="Nombre de la empresa" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_tipo_empresa">Tipo empresa:</label>
                                                        <input class="form-control" id="ex_laboral_tipo_empresa" placeholder="Tipo empresa" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_direccion">Dirección:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_direccion" placeholder="Dirección" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_telefono">Telefono:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_telefono" placeholder="Telefono" value="">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_fechaini">Fecha Inicio:</label>
                                                        <input type="date" class="form-control" name="" id="ex_laboral_fechaini" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_fechafi">Fecha Finalización:</label>
                                                        <input type="date" class="form-control" name="" id="ex_laboral_fechafi" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_cargo">Cargo:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_cargo" placeholder="Cargo" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_funciones">Funciones realizadas:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_funciones" placeholder="Funciones realizadas" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_logros">Logros:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_logros" placeholder="Logros" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_dependenca">Dependencia:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_dependenca" placeholder="Dependencia" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_jefe">Jefe Inmediato:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_jefe" placeholder="Jefe Inmediato" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_correo">Correo:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_correo" placeholder="Correo" value="">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_pais">País:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_pais" placeholder="País" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_depa">Departamento:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_depa" placeholder="Departamento" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ex_laboral_ciudad">Ciudad:</label>
                                                        <input type="text" class="form-control" name="" id="ex_laboral_ciudad" placeholder="Ciudad" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-danger" onclick="addExLaboral()"><i class="fas fa-plus"></i> Agregar Experiencia Laboral</button>                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="row"> 
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id= "table_experiencia_laboral">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">Empresa</th>
                                                            <th scope="col">Tipo</th>
                                                            <th scope="col">Dirección</th>
                                                            <th scope="col">Telefono </th>
                                                            <th scope="col">Inicio</th>
                                                            <th scope="col">Final</th>
                                                            <th scope="col">Cargo</th>
                                                            <th scope="col">Funciones</th>
                                                            <th scope="col">Logros</th>
                                                            <th scope="col">Dependencias</th>
                                                            <th scope="col">Jefe</th>
                                                            <th scope="col">Correo</th>
                                                            <th scope="col">País</th>
                                                            <th scope="col">Departamento</th>
                                                            <th scope="col">Ciudad</th>
                                                            <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($usuario->curriculum) && $usuario->curriculum->experiencia_laboral != null)
                                                                @foreach(json_decode($usuario->curriculum->experiencia_laboral,true) as $item)
                                                                    <tr id="item_laboral_{{$loop->iteration}}">
                                                                        <td>{{$item['nombre']}} <input type="hidden" name="laboral[{{$loop->iteration}}][nombre]" value="{{$item['nombre']}}"></td>
                                                                        <td>{{$item['tipo_empresa']}} <input type="hidden" name="laboral[{{$loop->iteration}}][tipo_empresa]" value="{{$item['tipo_empresa']}}"></td>
                                                                        <td>{{$item['direccion']}} <input type="hidden" name="laboral[{{$loop->iteration}}][direccion]" value="{{$item['direccion']}}"></td>
                                                                        <td>{{$item['telefono']}} <input type="hidden" name="laboral[{{$loop->iteration}}][telefono]" value="{{$item['telefono']}}"></td>
                                                                        <td>{{$item['fechaini']}} <input type="hidden" name="laboral[{{$loop->iteration}}][fechaini]" value="{{$item['fechaini']}}"></td>
                                                                        <td>{{$item['fechafin']}} <input type="hidden" name="laboral[{{$loop->iteration}}][fechafin]" value="{{$item['fechafin']}}"></td>
                                                                        <td>{{$item['cargo']}} <input type="hidden" name="laboral[{{$loop->iteration}}][cargo]" value="{{$item['cargo']}}"></td>
                                                                        <td>{{$item['funciones']}} <input type="hidden" name="laboral[{{$loop->iteration}}][funciones]" value="{{$item['funciones']}}"></td>
                                                                        <td>@if(isset($item['logros'])) {{$item['logros']}} @endif <input type="hidden" name="laboral[{{$loop->iteration}}][logros]" value="@if(isset($item['logros'])) {{$item['logros']}} @else null @endif"></td>
                                                                        <td>{{$item['dependencia']}} <input type="hidden" name="laboral[{{$loop->iteration}}][dependencia]" value="{{$item['dependencia']}}"></td>
                                                                        <td>{{$item['jefe']}} <input type="hidden" name="laboral[{{$loop->iteration}}][jefe]" value="{{$item['jefe']}}"></td>
                                                                        <td>{{$item['correo']}} <input type="hidden" name="laboral[{{$loop->iteration}}][correo]" value="{{$item['correo']}}"></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger"
                                                                                onclick="removeExperiencia('item_laboral_{{$loop->iteration}}')">
                                                                                <i class="fa fa-window-close"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif                                                              
                                                        </tbody>
                                                    </table>
                                                </div>                                          
                                            </div>
                                            <hr/>   
                                            <h4>Perfil Ocupacional</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="perfil_ocupacional">Perfil Ocupacional:</label>
                                                        <textarea type="text" class="form-control" name="perfil_ocupacional" id="perfil_ocupacional" placeholder="Describa el perfil ocupacional" value="" rows="3">@if(isset($usuario->curriculum->perfil_ocupacional) ) {{$usuario->curriculum->perfil_ocupacional}} @else {{old('perfil_ocupacional')}}@endif</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>   
                                            <h4>Referencias Personales</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ref_personal_nombre">Nombre y Apellidos:</label>
                                                                <input type="text" class="form-control" id="ref_personal_nombre" placeholder="Nombre y apellidos" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ref_personal_telefono">Telefono:</label>
                                                                <input type="text" class="form-control" id="ref_personal_telefono" placeholder="Telefono" value="">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ref_personal_ocupacion">Ocupación:</label>
                                                                <input type="text" class="form-control" id="ref_personal_ocupacion" placeholder="Ocupación" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ref_personal_ciudad">Ciudad:</label>
                                                                <input type="text" class="form-control" id="ref_personal_ciudad" placeholder="Ciudad" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-danger" onclick="addReferenciaPersonal()"><i class="fas fa-plus"></i> Agregar Referencia</button>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="table-responsive">
                                                        <table class="table table-striped" id= "table_ref_personal">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">Nombre y apellidos</th>
                                                                <th scope="col">Telefono</th>
                                                                <th scope="col">Ocupación</th>
                                                                <th scope="col">Ciudad</th>
                                                                <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                @if(isset($usuario->curriculum) && $usuario->curriculum->referencias_personales != null)
                                                                    @foreach(json_decode($usuario->curriculum->referencias_personales,true) as $item)
                                                                        <tr id="item_refPer_{{$loop->iteration}}">
                                                                            <td>{{$item['nombre']}} <input type="hidden" name="ref_personal[{{$loop->iteration}}][nombre]" value="{{$item['nombre']}}"></td>
                                                                            <td>{{$item['telefono']}} <input type="hidden" name="ref_personal[{{$loop->iteration}}][telefono]" value="{{$item['telefono']}}"></td>
                                                                            <td>{{$item['ocupacion']}} <input type="hidden" name="ref_personal[{{$loop->iteration}}][ocupacion]" value="{{$item['ocupacion']}}"></td>
                                                                            <td>{{$item['ciudad']}} <input type="hidden" name="ref_personal[{{$loop->iteration}}][ciudad]" value="{{$item['ciudad']}}"></td>
                                                                           
                                                                            <td>
                                                                                <button type="button" class="btn btn-danger"
                                                                                    onclick="removeRefPersonal('item_refPer_{{$loop->iteration}}')">
                                                                                    <i class="fa fa-window-close"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif                                                               
                                                            </tbody>
                                                        </table>
                                                </div>
                                            </div>
                                            <hr/>   
                                            <h4>Referencias Profesionale</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ref_profesional_nombre">Nombre y Apellidos:</label>
                                                                <input type="text" class="form-control" id="ref_profesional_nombre" placeholder="Nombre y apellidos" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ref_profesional_telefono">Telefono:</label>
                                                                <input type="text" class="form-control" id="ref_profesional_telefono" placeholder="Telefono" value="">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ref_profesional_ocupacion">Ocupación:</label>
                                                                <input type="text" class="form-control" id="ref_profesional_ocupacion" placeholder="Ocupación" value="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ref_profesional_ciudad">Ciudad:</label>
                                                                <input type="text" class="form-control" id="ref_profesional_ciudad" placeholder="Ciudad" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-danger" onclick="addReferenciaProfesional()"><i class="fas fa-plus"></i> Agregar Referencia</button>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="table-responsive">
                                                    <table class="table table-striped" id= "table_ref_profesional">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">Nombre y apellidos</th>
                                                            <th scope="col">Telefono</th>
                                                            <th scope="col">Ocupación</th>
                                                            <th scope="col">Ciudad</th>
                                                            <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>  
                                                                @if(isset($usuario->curriculum) && $usuario->curriculum->referencias_profesionales != null)
                                                                    @foreach(json_decode($usuario->curriculum->referencias_profesionales,true) as $item)
                                                                        <tr id="item_refPro_{{$loop->iteration}}">
                                                                            <td>{{$item['nombre']}} <input type="hidden" name="ref_profesional[{{$loop->iteration}}][nombre]" value="{{$item['nombre']}}"></td>
                                                                            <td>{{$item['telefono']}} <input type="hidden" name="ref_profesional[{{$loop->iteration}}][telefono]" value="{{$item['telefono']}}"></td>
                                                                            <td>{{$item['ocupacion']}} <input type="hidden" name="ref_profesional[{{$loop->iteration}}][ocupacion]" value="{{$item['ocupacion']}}"></td>
                                                                            <td>{{$item['ciudad']}} <input type="hidden" name="ref_profesional[{{$loop->iteration}}][ciudad]" value="{{$item['ciudad']}}"></td>
                                                                           
                                                                            <td>
                                                                                <button type="button" class="btn btn-danger"
                                                                                    onclick="removeRefProfesional('item_refPro_{{$loop->iteration}}')">
                                                                                    <i class="fa fa-window-close"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif                                                               
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <h3><i class="fa fa-plus"></i>Horarios de disponibilidad</h3>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <hr/>   
                                            <h4>Horario de disponibilidad</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dispo_dia">Dia de la semana:</label>
                                                        <select class="form-control" id="dispo_dia">
                                                            <option value="">Seleccione un día a la semana</option>
                                                            <option value="LUNES">LUNES</option>
                                                            <option value="MARTES">MARTES</option>
                                                            <option value="MIERCOLES">MIERCOLES</option>
                                                            <option value="JUEVES">JUEVES</option>
                                                            <option value="VIERNES">VIERNES</option>
                                                            <option value="SABADO">SABADO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dispo_horaini">Hora Inicio:</label>
                                                        <input type="time" class="form-control" id="dispo_horaini" min="05:00" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dispo_horafin">Hora Final:</label>
                                                        <input type="time" class="form-control" id="dispo_horafin"  min="5:00">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-danger" onclick="addDisponibilidad()"><i class="fas fa-plus"></i> Agregar Horario Disponibilidad</button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                               <div class="table-responsive">
                                                    <table class="table table-striped" id= "table_horario_disponibilidad">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">Día</th>
                                                            <th scope="col">Hora Inicio</th>
                                                            <th scope="col">Hora Final</th>
                                                            <th scope="col"></th>
                                                        </thead>
                                                        <tbody>  
                                                                @if(isset($usuario->curriculum) && $usuario->curriculum->horario_disponibilidad != null)
                                                                    @foreach(json_decode($usuario->curriculum->horario_disponibilidad,true) as $item)
                                                                        <tr id="item_dispo_{{$loop->iteration}}">
                                                                            <td>{{$item['dia']}} <input type="hidden" name="horario[{{$loop->iteration}}][dia]" value="{{$item['dia']}}"></td>
                                                                            <td>{{$item['hora_inicio']}} <input type="hidden" name="horario[{{$loop->iteration}}][hora_inicio]" value="{{$item['hora_inicio']}}"></td>
                                                                            <td>{{$item['hora_final']}} <input type="hidden" name="horario[{{$loop->iteration}}][hora_final]" value="{{$item['hora_final']}}"></td>
                                                                            
                                                                            <td>
                                                                                <button type="button" class="btn btn-danger"
                                                                                    onclick="removeHorario('item_dispo_{{$loop->iteration}}')">
                                                                                    <i class="fa fa-window-close"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif                                                        
                                                        </tbody>
                                                    </table>
                                               </div>
                                            </div>    
                                                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>

        let lineNo = 0;
        function addCelular() {
            console.log($("#phone_numbers").val());
    
            var num_cel = $("#phone_numbers").val();
    
            if (num_cel != "") {
                lineNo++;
                var markup = "<tr id='item_" + lineNo + "'><td>" + num_cel + " <input type='hidden' name='phone_numbers[]' value='" + num_cel + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeCelular('item_" + lineNo + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                var tableBody = $("#table_phones tbody");
                tableBody.append(markup);
            }
        }

        let lineNoLibreta = 0;
        function addLibreta(){
            var libreta_distrito = $("#libreta_distrito").val();
            var libreta_numero = $("#libreta_numero").val();

            if (libreta_distrito != "" && libreta_numero != "") {
                lineNoLibreta++;
                var markup = "<tr id='item_libreta_" + lineNoLibreta + "'><td>" + libreta_distrito + " <input type='hidden' name='libreta_militar["+lineNoLibreta+"][distrito]' value='" + libreta_distrito + "'></td><td>" + libreta_numero + " <input type='hidden' name='libreta_militar["+lineNoLibreta+"][numero]' value='" + libreta_numero + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeLibreta('item_libreta_" + lineNoLibreta + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                var tableBody = $("#table_militar tbody");
                tableBody.append(markup);
            }

        }

        function removeCelular(elemt) {
            console.log("removeCelular");
            lineNo--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        function removeLibreta(elemt) {
            console.log("removeLibreta");
            lineNoLibreta--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        //Educación superior
        @php $count = (isset($usuario->curriculum) && $usuario->curriculum->educacion_superior != null)? count(json_decode($usuario->curriculum->educacion_superior,true)) : 0; @endphp

        let lineNoSuperior = {{$count}};
        
        function addEduSuperior(){
            var superior_nombre_establecimiento = $("#superior_nombre_establecimiento").val();
            var superior_titulo_obtenido = $("#superior_titulo_obtenido").val();
            var superior_ciudad = $("#superior_ciudad").val();
            var superior_ano_finalizacion = $("#superior_ano_finalizacion").val();
            var superior_semetres = $("#superior_semetres").val();

            if (superior_nombre_establecimiento != "" && superior_titulo_obtenido != "" && superior_ciudad != ""  && superior_ano_finalizacion != "" && superior_semetres != "" ) {
                lineNoSuperior++;
                var markup = "<tr id='item_eduSuperior_" + lineNoSuperior + "'><td>" + superior_nombre_establecimiento + " <input type='hidden' name='educacion_superior["+lineNoSuperior+"][nombre_establecimiento]' value='" + superior_nombre_establecimiento + "'></td><td>" + superior_titulo_obtenido + " <input type='hidden' name='educacion_superior["+lineNoSuperior+"][titulo_obtenido]' value='" + superior_titulo_obtenido + "'></td><td>"+superior_ciudad+" <input type='hidden' name='educacion_superior["+lineNoSuperior+"][ciudad]' value='" + superior_ciudad + "'></td><td>"+superior_ano_finalizacion+" <input type='hidden' name='educacion_superior["+lineNoSuperior+"][ano_finalizacion]' value='" + superior_ano_finalizacion + "'></td><td>"+superior_semetres+" <input type='hidden' name='educacion_superior["+lineNoSuperior+"][semestres]' value='" + superior_semetres + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeEduSuperior('item_eduSuperior_" + lineNoSuperior + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                var tableBody = $("#table_educacion_superior tbody");
                tableBody.append(markup);
            }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe ingresar todos los campos para añadir un título obtenido en educación superior',
                    });
            }

        }

        function removeEduSuperior(elemt) {
            console.log("removeEduSuperior");
            lineNoSuperior--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        //Cursos
        @php $count_cp = (isset($usuario->curriculum) && $usuario->curriculum->capacitaciones != null)? count(json_decode($usuario->curriculum->capacitaciones,true)) : 0; @endphp

        let lineNoCurso = {{$count_cp}};

        function addCursos(){
            var curso_nombre_establecimiento = $("#curso_nombre_establecimiento").val();
            var curso_nombre = $("#curso_nombre").val();
            var curso_duracion = $("#curso_duracion").val();
            var curso_fecha_finalizacion = $("#curso_fecha_finalizacion").val();

            if (curso_nombre_establecimiento != "" && curso_nombre != "" && curso_duracion != ""  && curso_fecha_finalizacion != "") {
                lineNoCurso++;
                var markup = "<tr id='item_curso_" + lineNoCurso + "'><td>" + curso_nombre_establecimiento + " <input type='hidden' name='cursos["+lineNoCurso+"][nombre_establecimiento]' value='" + curso_nombre_establecimiento + "'></td><td>" + curso_nombre + " <input type='hidden' name='cursos["+lineNoCurso+"][nombre]' value='" + curso_nombre + "'></td><td>"+curso_duracion+" <input type='hidden' name='cursos["+lineNoCurso+"][duracion]' value='" + curso_duracion + "'></td><td>"+curso_fecha_finalizacion+" <input type='hidden' name='cursos["+lineNoCurso+"][fecha_finalizacion]' value='" + curso_fecha_finalizacion + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeCurso('item_curso_" + lineNoCurso + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                var tableBody = $("#table_cursos tbody");
                tableBody.append(markup);
            }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe ingresar todos los campos para añadir un curso o seminario',
                    });
            }

        }

        function removeCurso(elemt) {
            console.log("removeCurso");
            lineNoCurso--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        //Idiomas
        @php $count_i = (isset($usuario->curriculum) && $usuario->curriculum->idiomas != null)? count(json_decode($usuario->curriculum->idiomas,true)) : 0; @endphp

        let lineNoIdioma = {{$count_i}};
        function addIdiomas(){
            var idioma_nombre = $("#idioma_nombre").val();
            var idioma_habla = $("#idioma_habla").val();
            var idioma_escritura = $("#idioma_escritura").val();
            var idioma_lectura = $("#idioma_lectura").val();

            if (idioma_nombre != "" && idioma_habla != "" && idioma_escritura != ""  && idioma_lectura != "") {
                lineNoIdioma++;
                var markup = "<tr id='item_idioma_" + lineNoIdioma + "'><td>" + idioma_nombre + " <input type='hidden' name='idiomas["+lineNoCurso+"][nombre]' value='" + idioma_nombre + "'></td><td>" + idioma_habla + " <input type='hidden' name='idiomas["+lineNoCurso+"][habla]' value='" + idioma_habla + "'></td><td>"+idioma_escritura+" <input type='hidden' name='idiomas["+lineNoCurso+"][escritura]' value='" + idioma_escritura + "'></td><td>"+idioma_lectura+" <input type='hidden' name='idiomas["+lineNoCurso+"][lectura]' value='" + idioma_lectura + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeIdioma('item_idioma_" + lineNoIdioma + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                var tableBody = $("#table_idiomas tbody");
                tableBody.append(markup);
            }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe ingresar todos los campos para añadir un idioma',
                    });
            }

        }

        function removeIdioma(elemt) {
            console.log("removeIdioma");
            lineNoIdioma--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        //Experiencia laboral
        @php $count_exlaboral = (isset($usuario->curriculum) && $usuario->curriculum->experiencia_laboral != null)? count(json_decode($usuario->curriculum->experiencia_laboral,true)) : 0; @endphp

        let lineNoExLaboral = {{$count_exlaboral}};
        function addExLaboral(){
            var nombre = $("#ex_laboral_nombre").val();
            var tipo_empresa = $("#ex_laboral_tipo_empresa").val();
            var direccion = $("#ex_laboral_direccion").val();
            var telefono = $("#ex_laboral_telefono").val();
            var fechaini = $("#ex_laboral_fechaini").val();
            var fechafin = $("#ex_laboral_fechafi").val();
            var cargo = $("#ex_laboral_cargo").val();
            var funciones = $("#ex_laboral_funciones").val();
            var logros = $("#ex_laboral_logros").val();
            var dependencia = $("#ex_laboral_dependenca").val();
            var jefe = $("#ex_laboral_jefe").val();
            var correo = $("#ex_laboral_correo").val();

            var pais = $("#ex_laboral_pais").val();
            var depa = $("#ex_laboral_depa").val();
            var ciudad = $("#ex_laboral_ciudad").val();

            if (nombre != "" && tipo_empresa != "" && direccion != ""  && telefono != "" && fechaini != "" && fechafin != "" && cargo != "" && funciones != "" && logros != "" && dependencia != "" && jefe != "" && correo != "" && pais != "" && depa != "" && ciudad != "") {
                lineNoExLaboral++;
                var markup = "<tr id='item_laboral_" + lineNoExLaboral + "'><td>" + nombre + " <input type='hidden' name='laboral["+lineNoExLaboral+"][nombre]' value='" + nombre + "'></td><td>" + tipo_empresa + " <input type='hidden' name='laboral["+lineNoExLaboral+"][tipo_empresa]' value='" + tipo_empresa + "'></td><td>"+direccion+" <input type='hidden' name='laboral["+lineNoExLaboral+"][direccion]' value='" + direccion + "'></td><td>"+telefono+" <input type='hidden' name='laboral["+lineNoExLaboral+"][telefono]' value='" + telefono + "'></td><td>"+fechaini+" <input type='hidden' name='laboral["+lineNoExLaboral+"][fechaini]' value='" + fechaini + "'></td><td>"+fechafin+" <input type='hidden' name='laboral["+lineNoExLaboral+"][fechafin]' value='" + fechafin + "'></td><td>"+cargo+" <input type='hidden' name='laboral["+lineNoExLaboral+"][cargo]' value='" + cargo + "'></td><td>"+cargo+" <input type='hidden' name='laboral["+lineNoExLaboral+"][funciones]' value='" + funciones + "'></td><td>"+logros+" <input type='hidden' name='laboral["+lineNoExLaboral+"][logros]' value='" + logros + "'>"+logros+"</td><td>"+dependencia+" <input type='hidden' name='laboral["+lineNoExLaboral+"][dependencia]' value='" + dependencia + "'></td><td>"+jefe+" <input type='hidden' name='laboral["+lineNoExLaboral+"][jefe]' value='" + jefe + "'></td><td>"+correo+" <input type='hidden' name='laboral["+lineNoExLaboral+"][correo]' value='" + correo + "'></td><td></td><td></td><td></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeExperiencia('item_laboral_" + lineNoExLaboral + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                var tableBody = $("#table_experiencia_laboral tbody");
                tableBody.append(markup);
            }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe ingresar todos los campos para añadir una experencia laboral',
                    });
            }

        }

        function removeExperiencia(elemt) {
            console.log("removeExperiencia");
            lineNoIdioma--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        //Horario Disponibilidad        
        @php $count_horario = (isset($usuario->curriculum) && $usuario->curriculum->horario_disponibilidad != null)? count(json_decode($usuario->curriculum->horario_disponibilidad,true)) : 0; @endphp

        let lineNoDispo = {{$count_horario}};
        function addDisponibilidad(){

            var dispo_dia = $("#dispo_dia").val();
            var dispo_horaini = $("#dispo_horaini").val();
            var dispo_horafin = $("#dispo_horafin").val();

            if(dispo_horaini != "" && dispo_horafin != ""){
                
                console.log(typeof  dispo_horaini+" "+ typeof dispo_horafin);
                console.log(dispo_horaini+" "+ dispo_horafin);
                //Validar Hora
                var array_hora_inicio = dispo_horaini.split(":");
                var array_hora_final = dispo_horafin.split(":");
                console.log(parseInt(array_hora_inicio[0])+" "+parseInt(array_hora_final[0]));

                if(parseInt(array_hora_inicio[0]) < parseInt(array_hora_final[0])){
                    
                    if (dispo_dia != "") {            
                        lineNoDispo++;
                        var markup = "<tr id='item_dispo_" + lineNoDispo + "'><td>" + dispo_dia + " <input type='hidden' name='horario["+lineNoDispo+"][dia]' value='" + dispo_dia + "'></td><td>" + dispo_horaini + " <input type='hidden' name='horario["+lineNoDispo+"][hora_inicio]' value='" + dispo_horaini + "'></td><td>"+dispo_horafin+" <input type='hidden' name='horario["+lineNoDispo+"][hora_final]' value='" + dispo_horafin + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeHorario('item_dispo_" + lineNoDispo + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                        var tableBody = $("#table_horario_disponibilidad tbody");
                        tableBody.append(markup);
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Debe seleccionar el día de la semana',
                        });
                    }

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'La hora inicio debe ser menor a la hora final',
                    });
                }

            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe ingresar todos los campos para añadir un horario de disponibilidad',
                });
            }
        }

        function removeHorario(elemt) {
            console.log("removeHorario");
            lineNoDispo--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        //Referencias Personales
        @php $count_refp = (isset($usuario->curriculum) && $usuario->curriculum->referencias_personales != null)? count(json_decode($usuario->curriculum->referencias_personales,true)) : 0; @endphp

        let lineNoRefPersonal = {{$count_refp}};

        function addReferenciaPersonal(){

            var nombre = $("#ref_personal_nombre").val();
            var telefono = $("#ref_personal_telefono").val();
            var ocupacion = $("#ref_personal_ocupacion").val();
            var ciudad = $("#ref_personal_ciudad").val();
            
            if (nombre != "" && telefono != "" && ocupacion != "" && ciudad != "") {            
                lineNoRefPersonal++;
                var markup = "<tr id='item_refPer_" + lineNoRefPersonal + "'><td>" + nombre + " <input type='hidden' name='ref_personal["+lineNoRefPersonal+"][nombre]' value='" + nombre + "'></td><td>" + telefono + " <input type='hidden' name='ref_personal["+lineNoRefPersonal+"][telefono]' value='" + telefono + "'></td><td>"+ocupacion+" <input type='hidden' name='ref_personal["+lineNoRefPersonal+"][ocupacion]' value='" + ocupacion + "'></td><td>"+ciudad+" <input type='hidden' name='ref_personal["+lineNoRefPersonal+"][ciudad]' value='" + ciudad + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeRefPersonal('item_refPer_" + lineNoRefPersonal + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                var tableBody = $("#table_ref_personal tbody");
                tableBody.append(markup);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes ingresar todos los campos para añadir un referencia personal',
                });
            }
            
        }

        function removeRefPersonal(elemt) {
            console.log("removeRefPersonal");
            lineNoRefPersonal--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        //Referencia Profesionales
        @php $count_refpro = (isset($usuario->curriculum) && $usuario->curriculum->referencias_profesionales != null)? count(json_decode($usuario->curriculum->referencias_profesionales,true)) : 0; @endphp

        let lineNoRefProfesional = {{$count_refpro}};

        function addReferenciaProfesional(){

            var nombre = $("#ref_profesional_nombre").val();
            var telefono = $("#ref_profesional_telefono").val();
            var ocupacion = $("#ref_profesional_ocupacion").val();
            var ciudad = $("#ref_profesional_ciudad").val();
            
            if (nombre != "" && telefono != "" && ocupacion != "" && ciudad != "") {            
                lineNoRefProfesional++;
                var markup = "<tr id='item_refPro_" + lineNoRefProfesional + "'><td>" + nombre + " <input type='hidden' name='ref_profesional["+lineNoRefProfesional+"][nombre]' value='" + nombre + "'></td><td>" + telefono + " <input type='hidden' name='ref_profesional["+lineNoRefProfesional+"][telefono]' value='" + telefono + "'></td><td>"+ocupacion+" <input type='hidden' name='ref_profesional["+lineNoRefProfesional+"][ocupacion]' value='" + ocupacion + "'></td><td>"+ciudad+" <input type='hidden' name='ref_profesional["+lineNoRefProfesional+"][ciudad]' value='" + ciudad + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeRefProfesional('item_refPro_" + lineNoRefProfesional + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
                var tableBody = $("#table_ref_profesional tbody");
                tableBody.append(markup);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes ingresar todos los campos para añadir una referencia profesional',
                });
            }
            
        }

        function removeRefProfesional(elemt) {
            console.log("removeRefPersonal");
            lineNoRefPersonal--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }


        $(document).ready( function () {
            $( "#departamento" ).change(function() {
                console.log($( this ).val());
                $.ajax({
                    type: 'POST',
                    url: '{{ route("ciudad.getAjaxCiudades") }}',            
                    data: {  
                            "_token": "{{ csrf_token() }}",
                            "departamento_id": $( this ).val(),
                        },
                    dataType: 'json',
                    success: function(data){
                    //console.log(data);
                    $("#ciudad").html(data.html);    
                    },
                    error: function(data) {
                        console.log('ERROR AJAX: '+data);
                    }
        
                });
            });

            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function(){
                $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });
        });

    </script>
@endsection