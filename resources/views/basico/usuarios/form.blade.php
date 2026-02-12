
{{ csrf_field() }}
<div class="row">    
    <div class="col-md-6">
        <fieldset>
            <hr/>
            @if(isset($usuario))
                <legend>Actualizar Usuario</legend>
            @else
                <legend>Registrar Usuario</legend>
            @endif
            
            <div class="row">                  
                @if(isset($usuario))
                    <div class="col-md-4">
                        <a class="thumbnail">
                            @if(isset($usuario->userInfo) && $usuario->userInfo->foto != "")
                                <img style="width:190px; height:191px;" src="{{ asset('storage/'.$usuario->userInfo->foto ) }}" />
                            @else
                                <img style="width:190px; height:191px;" src="{{ asset('img/no_profile.png') }}" />
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
                    <br/>
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="@if(isset($usuario) ) {{$usuario->name}} @else {{ old('name') }} @endif">
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="@if(isset($usuario) ) {{$usuario->email}} @else {{ old('email') }} @endif">
                    </div>
                </div>                

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
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
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->direccion}} @else {{old('direccion')}}  @endif" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="barrio">Barrio:</label>
                                <input type="text" class="form-control" name="barrio" id="barrio" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->barrio}} @else {{old('barrio')}}  @endif" >
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
                    <div class="form-group">
                        <label for="facebook">Facebook:</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->facebook}} @else {{old('facebook')}} @endif" >
                    </div>
                </div>
        
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="instagram">Instagram:</label>
                        <input type="text" class="form-control" name="instagram" id="instagram" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->instagram}} @else {{old('instagram')}}  @endif" >
                    </div>
                </div>
        
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
                <div class="col-md-12">
                    @if(isset($usuario))
                        @can('Listar Emprendimiento')
                            <a class='btn btn-danger' href="{{route('listar.emprendimiento',$usuario->id)}}"><i class='fas fa-briefcase'></i>Emprendimientos</a>
                        @endcan
                    @endif
                </div>

                

                @hasrole('Administrador')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control" name="rol[]" id="rol" multiple>
                                <option value="">Seleccione un rol</option>
                                @foreach($roles as $rol)
                                    @if($rol->name != "Estudiante")
                                        <option value="{{$rol->name}}" @if((isset($usuario) && $usuario->hasRole($rol->name) ) || (old('rol') ==  $rol->name)) selected @endif>{{$rol->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="roldependencia_id">Dependencias</label>
                            <select class="form-control" name="dependencia_id" id="dependencia_id" >
                                <option value="">Seleccione una dependencia</option>
                                @foreach($dependencias as $dependencia)                                    
                                        <option value="{{$dependencia->id}}" data-codigo="{{$dependencia->codigo}}" @if( (isset($usuario->userInfo) && isset($usuario->userInfo->dependencia) && ($usuario->userInfo->dependencia->id == $dependencia->id)) || old('dependencia_id') == $dependencia->id ) selected @endif>{{$dependencia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="state">Estado: </label>
                            <select class="form-control" name="state" id="state" >
                                <option value="1" @if( isset($usuario) && ($usuario->getOriginal('state') == 1) ) selected @endif > Activo </option>
                                <option value="0" @if( isset($usuario) && ($usuario->getOriginal('state') == 0) ) selected @endif > Inactivo </option>                                                        
                            </select>
                        </div>
                    </div>

                @endhasrole
            </div>
        </fieldset>
        <br>
        <fieldset>
            <hr/>
            <legend>Información Estudiante</legend>
            <div class="row">      
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="rol_e">¿Eres estudiante?</label>
                        <br>
                            <input name="rol_e" id="rol_e" type="radio" value="1" @if( isset($usuario) && $usuario->hasRole('Estudiante') )  checked @endif >  Sí<br>
                            <input name="rol_e" id="rol_e" type="radio" value="0" @if( isset($usuario) && !($usuario->hasRole("Estudiante")) ) checked  @endif  >  No<br>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="codigo_estudiante">Codigo Estudiante:</label>
                        <input type="text" class="form-control" name="codigo_estudiante" id="codigo_estudiante" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->codigo_estudiante}} @else {{ old('codigo_estudiante') }} @endif">
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email Institucional:</label>
                        <input type="email" class="form-control" name="email_institucional" id="email_institucional" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->email_institucional}} @else {{ old('email_institucional') }} @endif">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="codigo_carrera">Carrera</label>
                        <select class="form-control" id="codigo_carrera" name="codigo_carrera">
                            <option value="" selected>Seleccione una carrera</option>
                            @foreach($carreras as $carrera)
                                    <option value="{{$carrera->codigo}}" @if((isset($usuario->userInfo) &&  $usuario->userInfo->codigo_carrera == $carrera->codigo) || old('codigo_carrera') == $carrera->codigo) selected @endif >{{$carrera->codigo}}-{{$carrera->nombre}}</option>                                        
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="semestre">Semestre:</label>
                        <input type="text" class="form-control" name="semestre" id="semestre" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->semestre}} @else {{ old('semestre') }} @endif">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="promedio">Promedio Acumulado:</label>
                        <input type="text" class="form-control" id="promedio" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->promedio}} @else {{ old('promedio') }} @endif" disabled>
                    </div>
                </div>
                @can('Curriculum')
                    @if(isset($usuario))
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hoja_vida" class="font-weight-bold">Hoja Vida</label><br>
                                <a  target="_blank" href="{{route('usuario.hojaVida',$usuario->id)}}"  class="btn btn-large pull-right" title="Hoja de vida"><i class="fas fa-address-book fa-2x"></i> Hoja de vida</a>                                                        
                            </div>
                        </div>
                    @endif
                @endcan
            </div>
            
                
        </fieldset>
        
    </div>
   
</div>
@if(isset($usuario) && \Auth::user()->hasAnyRole(['Administrador','Coordinador proyeccion social','Empresa']))
<br>
<br>
<br>
<br>
<h3>Información Empresa</h3>
<hr/>    
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                    <div class="form-group">
                       <label for="nombre_empresa">Nombre Empresa:</label>
                       <input type="text" class="form-control" name="" id="nombre_empresa" placeholder="Nombre Empresa" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->nombre_empresa}} @else {{ old('nombre_empresa') }} @endif">
                   </div>
            </div>
            @if(isset($usuario->userInfo) && $usuario->userInfo->file_rut != "")
            <div class="col-md-12">
                <label for="descargar" class="font-weight-bold">RUT:</label>
                <div class="input-group">  
                    <a href="{{route('usuario.fileEmpresa',[$usuario->userInfo->id,'RUT'])}}" class="btn btn-large pull-right" id="rut"><i class="fa fa-file-download fa-2x"> </i> RUT </a>
                </div> 
            </div>
            @endif
            @if(isset($usuario->userInfo) && $usuario->userInfo->file_representante != "")
            <div class="col-md-12">
                <label for="descargar" class="font-weight-bold">RUT:</label>
                <div class="input-group">  
                    <a href="{{route('usuario.fileEmpresa',[$usuario->userInfo->id,'Representante'])}}" class="btn btn-large pull-right" id="rut"><i class="fa fa-file-download fa-2x"> </i> Cedula del representante </a>
                </div> 
            </div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                    <div class="form-group">
                       <label for="nit_empresa">NIT Empresa:</label>
                       <input type="text" class="form-control" name="" id="nit_empresa" placeholder="NIT Empresa" value="@if(isset($usuario->userInfo) ) {{$usuario->userInfo->nit_empresa}} @else {{ old('nit_empresa') }} @endif">
                   </div>
            </div>
            @if(isset($usuario->userInfo) && $usuario->userInfo->file_camara_comercio != "")
            <div class="col-md-12">
                <label for="descargar" class="font-weight-bold">Camra de comercio:</label>
                <div class="input-group">  
                    <a href="{{route('usuario.fileEmpresa',[$usuario->userInfo->id,'Camara de comercio'])}}" class="btn btn-large pull-right" id="Camara de comercio"><i class="fa fa-file-download fa-2x"> </i> Camara de comercio </a>
                </div> 
            </div>
            @endif
        </div>                   
    </div>
    
</div>
@endif



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
                var markup = "<tr id='item_libreta_" + lineNoLibreta + "'><td>" + libreta_distrito + " <input type='hidden' name='libreta_militar['distrito']' value='" + libreta_distrito + "'></td><td>" + libreta_numero + " <input type='hidden' name='libreta_militar['numero']' value='" + libreta_numero + "'></td><td> <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeLibreta('item_libreta_" + lineNoLibreta + "')\"><i class=\"fa fa-window-close\"></i> </button></td></tr>";
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

            $( "#codigo_carrera" ).change(function() {
                console.log($( this ).val());             
                $('#dependencia_id').find('[data-codigo="'+$( this ).val()+'"]').prop('selected', true);           
            });
        });

    </script>

@endsection


