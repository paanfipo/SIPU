@extends('dashboard')
@section('title_dashboard','Formato  caracterización unidad de emprendimiento para pasar de sensibilización a preincubación')
@section('breadcrumbs')
    {{ Breadcrumbs::render('asistencia.caracterizacion_sensibilizacion',$convocatoria,$usuario->id) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Caracterización sensibilización</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('asistencia.set_caracterizacion_sensibilizacion')}}">
                <hr/>
                <div class="col-md-12">                   
                    <fieldset>
                        <legend>Detalle</legend>                        
                            <div class="form-group">
                                <label for="descripcion" class="col-form-label">Descripción:</label>
                                <textarea class="form-control" id="descripcion" rows="2" cols="50" disabled>El siguiente formato se hace con la intención de conocer, analizar y orientar a Estudiantes, Profesores, Empresarios, Comerciantes, Particulares que tengan una idea de negocio por desarrollar o una unidad de negocio en funcionamiento.</textarea>
                            </div>

                            <div class="form-group">
                                <label for="ley" class="col-form-label">Ley de Tratamientos de Datos:</label>
                                <textarea class="form-control" id="ley" rows="5" cols="50" disabled>Le recordamos que al diligenciar el presente formato acepta el tratamiento de datos exclusivos para la Universidad del Valle, tramitados de acuerdo a lo estipulado en la Ley Estatutaria No. 1581 del 17 de octubre de 2012 “Por la cual se dictan disposiciones generales para la protección de datos personales” junto con sus normas reglamentarias, y según la Resolución de Rectoría No. 1.172, de marzo 12 de 2014  “Por la cual se expide el Reglamento Interno para garantizar la protección de los datos personales de la Universidad del Valle”. Ley de Tratamiento de Datos/ Esta opción estara como un checked box, tipo bandera, si no checked esta opción no le permitira llenar el formulario, de lo contrario si.</textarea>
                            </div>
                    </fieldset>                   
                </div>
                <hr/>
                <div class="col-md-12">
                    <fieldset>
                        <legend>Datos Personales</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre: *</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name" value="@if(isset($usuario) ) {{$usuario->name}} @else {{ old('name') }} @endif" disabled>
                                </div>
                                <div class="form-group">
                                    <br>
                                    <label for="sexo">Sexo: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($tipos_sexo as $sexo)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sexo" id="{{$sexo->nombre}}" value="{{$sexo->id}}" @if((isset($usuario->userInfo) && ($usuario->userInfo->sexo == $sexo->id)) || (old('sexo') == $sexo->id)) checked @endif required>
                                                <label for="{{$sexo->nombre}}">{{$sexo->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="etnia">Etnia: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($tipos_etnias as $etnia)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="etnia" id="{{$etnia->nombre}}" value="{{$etnia->id}}" @if((isset($usuario->userInfo) && ($usuario->userInfo->etnia == $etnia->id)) || (old('etnia') == $etnia->id)) checked @endif required>
                                                <label for="{{$etnia->nombre}}">{{$etnia->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="email">Email: *</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" value="@if(isset($usuario) ) {{$usuario->email}} @else {{ old('email') }} @endif" disabled>
                                </div>
                                
                                <div class="row">                
                                    <div class="col-md-6">
                                        <label for="phone_numbers" class="font-weight-bold">Agregar Telefonos</label>
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
                                        <label for="contact_name"></label>
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
                                                <a><i class="fas fa-hand-pointer fa-2x" style="color: red;" title="Seleccionar emprendimiento" onclick="listarEmprendimientos({{$usuario->id}},{{$convocatoria->id}})"></i></a>
                                            @endcan
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edad">Edad: *</label>
                                    <input type="number" class="form-control" name="edad" id="edad" @if(isset($usuario->userInfo) && ($usuario->userInfo->edad != "")) value="{{$usuario->userInfo->edad}}" @else value="{{old('edad')}}" @endif min="1" required>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="ubicacion">Departmento y Ciudad o Municipio: *</label>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" name="departamento_usuario" id="departamento" required>
                                            <option value="" selected>Seleccione un departamento</option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{$departamento->id}}" @if((isset($usuario->userInfo->ciudad) && ($usuario->userInfo->ciudad->departamento->id == $departamento->id)) || (old('departamento_usuario') == $departamento->id)) selected @endif > {{$departamento->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="ciudad_usuario"  id="ciudad" required>
                                            <option value="" selected>Seleccione una ciudad</option>
                                            @if(isset($usuario->userInfo->ciudad)) 
                                                @foreach($ciudades as $ciudad)
                                                    <option value="{{$ciudad->id}}" @if((isset($usuario->userInfo->ciudad) && ($usuario->userInfo->ciudad->id == $ciudad->id)) || (old('ciudad_usuario') == $ciudad->id)) selected @endif > {{$ciudad->nombre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="direccion">Dirección de residencia: *</label>
                                    <input type="text" class="form-control" name="direccion_usuario" id="direccion" placeholder="Direccion" @if(isset($usuario->userInfo) && $usuario->userInfo->direccion != "") value="{{$usuario->userInfo->direccion}}" @else value="{{ old('direccion_usuario') }}" @endif>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="tipo_zona">Tipo Zona: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($tipos_zonas as $tipo)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tipo_zona" id="{{$tipo->nombre}}" value="{{$tipo->id}}" @if((isset($usuario->userInfo) && ($usuario->userInfo->tipo_zona == $tipo->id)) || (old('tipo_zona') == $tipo->id) ) checked @endif required>
                                                <label for="{{$tipo->nombre}}">{{$tipo->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="nivel_estudio">Nivel de Estudios: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($nivel_estudio as $nivel)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="nivel_estudio_usuario" id="{{$nivel->nombre}}" value="{{$nivel->id}}" @if((isset($usuario->userInfo) && ($usuario->userInfo->nivel_estudio == $nivel->id)) || (old('nivel_estudio_usuario') == $nivel->id) ) checked @endif required>
                                                <label for="{{$nivel->nombre}}">{{$nivel->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <hr/>
                <div class="col-md-12">
                    <fieldset>
                        <legend>Información de emprendimiento</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_emprendimiento">Nombre Emprendimiento: *</label>
                                    <input type="text" class="form-control" name="nombre_emprendimiento" id="nombre_emprendimiento" @if(isset($emprendimiento) ) value="{{$emprendimiento->nombre}}" @else value="{{old('nombre_emprendimiento')}}" @endif required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion_emprendimiento">Descripción Emprendimiento: *</label>
                                    <textarea  class="form-control" name="descripcion_emprendimiento" id="descripcion_emprendimiento">
                                        @if(isset($emprendimiento) ) 
                                            {{$emprendimiento->descripcion}}
                                        @else
                                            {{old('descripcion_emprendimiento')}}
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <br>
                                    <label for="ubicacion">Departmento y Ciudad o Municipio: *</label>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" name="departamento_empre" id="departamento__empre" required>
                                            <option value="" selected>Seleccione un departamento</option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{$departamento->id}}" @if((isset($emprendimiento->ciudad->departamento) && ($emprendimiento->ciudad->departamento->id == $departamento->id)) || (old('departamento_empre') == $departamento->id)) selected @endif > {{$departamento->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="ciudad_empre"  id="ciudad_empre" required>
                                            <option value="" selected>Seleccione una ciudad</option>
                                            @if(isset($emprendimiento->ciudad)) 
                                                @foreach($ciudades as $ciudad)
                                                    <option value="{{$ciudad->id}}" @if((isset($emprendimiento->ciudad) && ($emprendimiento->ciudad->id == $ciudad->id)) || (old('ciudad_empre') == $ciudad->id)) selected @endif > {{$ciudad->nombre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="numero_personas">Número de personas que integran el proyecto: *</label>
                                </div>
                                <div class="row">                                                                        
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="integrantes_hombres">Hombres: *</label>
                                            <input type="number" class="form-control" name="integrantes_hombres" id="integrantes_hombres" @if(isset($emprendimiento) && $emprendimiento->integrantes_hombres != "" ) value="{{$emprendimiento->integrantes_hombres}}" @else value="{{old('integrantes_hombres')}}" @endif  min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="integrantes_mujeres">Mujeres: *</label>
                                            <input type="number" class="form-control" name="integrantes_mujeres" id="integrantes_mujeres"  @if(isset($emprendimiento) && $emprendimiento->integrantes_mujeres != "" ) value="{{$emprendimiento->integrantes_mujeres}}" @else value="{{old('integrantes_mujeres')}}" @endif min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="total_integrantes">Total Inte: *</label>
                                            <input type="number" class="form-control" name="total_integrantes" id="total_integrantes" value="{{old('total_integrantes')}}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="sector_economico">Su sector económico: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($sector_economico as $sector)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sector_economico" id="{{$sector->nombre}}" value="{{$sector->id}}" @if((isset($emprendimiento) && ($emprendimiento->sector_economico == $sector->id)) || (old('sector_economico') == $sector->id) ) checked @endif required>
                                                <label for="{{$sector->nombre}}">{{$sector->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <br>
                                    <label for="producto_servicio">Producto o servicio que desea ofrecer es: *</label>
                                    <textarea class="form-control" name="producto_servicio" id="producto_servicio" rows="2" cols="50" required>@if(isset($emprendimiento) && $emprendimiento->producto_servicio != "" ) {{$emprendimiento->producto_servicio}} @else {{ old('producto_servicio') }} @endif</textarea>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="fase_emprendimiento">Fases del emprendimiento: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($fases_emprendimiento as $fase)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="fase_emprendimiento" id="{{$fase->nombre}}" value="{{$fase->id}}" @if((isset($emprendimiento) && ($emprendimiento->fase_emprendimiento == $fase->id)) || (old('fase_emprendimiento') == $fase->id )) checked @endif required>
                                                <label for="{{$fase->nombre}}">{{$fase->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <br>
                                    <textarea class="form-control" id="descripcion_empre" rows="1" cols="100" disabled>
                                        Describa los siguientes elementos de su emprendimiento, para definir el modelo de negocio. 
                                    </textarea>
                                </div>
                                    @if(isset($emprendimiento) && $emprendimiento->modelo_negocio != null)
                                    
                                        @php
                                            $modelo_negocio = json_decode($emprendimiento->modelo_negocio);
                                        @endphp

                                    @endif
                                <div class="form-group">
                                    <label for="propuesta_valor">Propuesta de valor: *</label>
                                    <textarea class="form-control" id="propuesta_valor" name="propuesta_valor" rows="2" cols="100" required>
                                        @if(isset($emprendimiento) && isset($modelo_negocio->propuesta_valor))
                                            {{$modelo_negocio->propuesta_valor}}
                                        @else
                                           ¿Cual seria su propuesta diferenciadora?
                                            {{old('propuesta_valor')}}
                                        @endif
                                        
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="relacion_cliente">Relación con el cliente: *</label>
                                    <textarea class="form-control" id="relacion_cliente" name="relacion_cliente" rows="2" cols="100" required>
                                        @if(isset($emprendimiento) && isset($modelo_negocio->relacion_cliente))
                                        {{$modelo_negocio->relacion_cliente}}
                                        @else
                                        ¿Cuales serian las estrategias para traer y fidelizar clientes?
                                        {{old('relacion_cliente')}}
                                        @endif                                        
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="canal_distribucion">Canal de distribución: *</label>
                                    <textarea class="form-control" id="canal_distribucion" name="canal_distribucion" rows="2" cols="100" required>
                                        @if(isset($emprendimiento) && isset($modelo_negocio->canal_distribucion))
                                        {{$modelo_negocio->canal_distribucion}}
                                        @else
                                        ¿Como accederan sus clientes al producto o servicio?
                                        {{old('canal_distribucion')}}
                                        @endif                                     
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="recursos_actuales">Recursos actuales: *</label>
                                    <textarea class="form-control" id="recursos_actuales" name="recursos_actuales" rows="2" cols="100" required>

                                        @if(isset($emprendimiento) && isset($modelo_negocio->recursos_actuales))
                                        {{$modelo_negocio->recursos_actuales}}
                                        @else
                                        ¿Con que recursos cuenta para iniciar su emprendimiento?
                                        {{old('recursos_actuales')}}
                                        @endif

                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inversion_realizada">Inversión realizada: *</label>
                                    <textarea class="form-control" id="inversion_realizada" name="inversion_realizada" rows="2" cols="100" required>
                                        
                                        @if(isset($emprendimiento) && isset($modelo_negocio->inversion_realizada))
                                        {{$modelo_negocio->inversion_realizada}}
                                        @else
                                        ¿A la fecha cuanto dinero a invertido en el emprendimiento?
                                        {{old('inversion_realizada')}}
                                        @endif
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="aliados_actuales">Aliados actuales: *</label>
                                    <textarea class="form-control" id="aliados_actuales" name="aliados_actuales" rows="2" cols="100" required>                                        
                                        @if(isset($emprendimiento) && isset($modelo_negocio->aliados_actuales))
                                        {{$modelo_negocio->aliados_actuales}}
                                        @else
                                        ¿Que entidades publicas o privadas estan apoyando su emprendimiento?
                                        {{old('aliados_actuales')}}
                                        @endif
                                    </textarea>
                                </div>
                            </div>                            
                        </div>
                    </fieldset>
                </div>

                <div class="col-md-12">
                    <br>
                    <br>
                    
                    <div class="box-footer">
                        <a href="{{route('asistencias.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                        <input type="hidden" name="convocatoria" value="{{$convocatoria->id}}">
                        <input type="hidden" name="etapa" value="{{$etapa->id}}">                        
                        <input type="hidden" name="emprendimiento_id" id="emprendimiento_id" @if(isset($emprendimiento)) value="{{$emprendimiento->id}}" @endif>
                        <input type="hidden" name="usuario" id="usuario" value="{{$usuario->id}}">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Emprendimientos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="nombre" class="col-form-label">Nombre:</label>
                  <select class="form-control" id="emprendimientos">
                      <option value="">Seleccione un emprendimiento</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" id="seleccionarEmprendimiento">Guardar</button>
              <input type="hidden" id="convocatoria_id" value="">
              <input type="hidden" id="user_id" value="">
              
            </div>
          </div>
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

        function removeCelular(elemt) {
            console.log("removeCelular");
            lineNo--;
            $('#' + elemt).fadeOut('slow', function () {
                $('#' + elemt).remove();
            });
        }

        function getCiudades(departamento_id,tipo,old){
            console.log("Old "+old);
            $.ajax({
                type: 'POST',
                url: '{{ route("ciudad.getAjaxCiudades") }}',            
                data: {  
                        "_token": "{{ csrf_token() }}",
                        "departamento_id":departamento_id,
                        "ciudad_old":old,
                      },
                dataType: 'json',
                success: function(data){
                   //console.log(data);
                   if(tipo == 'usuario'){
                    $("#ciudad").html(data.html);    
                   }

                   if(tipo == 'emprendimiento'){
                    $("#ciudad_empre").html(data.html); 
                   }
                   
                },
                error: function(data) {
                    console.log('ERROR AJAX: '+data);
                }
    
            });
        }

        function sumaIntegrantes(){
            var suma = parseInt($( "#integrantes_hombres" ).val()) + parseInt($( "#integrantes_mujeres" ).val());
            $("#total_integrantes").val(suma);
        }

        $(function() {

            if( (parseInt($( "#integrantes_hombres" ).val()) > 0) || (parseInt($( "#integrantes_mujeres" ).val()) > 0) ){
                sumaIntegrantes();
            }

            if($( "#departamento" ).val() != ""){
                var old = @if(old('ciudad_usuario') != "") {{old('ciudad_usuario')}} @else "" @endif;
                if(old != ""){
                    getCiudades($( "#departamento" ).val(),'usuario', old);
                }
                
            }

            $( "#departamento" ).change(function() {      
                var old = @if(old('ciudad_usuario') != "") {{old('ciudad_usuario')}} @else "" @endif;       
                getCiudades($( "#departamento" ).val(),'usuario', old);       
            });

            if($( "#departamento__empre" ).val() != ""){

                var old =  @if(old('ciudad_empre') != "") {{old('ciudad_empre')}} @else "" @endif; 

                if(old != ""){
                    getCiudades($( "#departamento__empre" ).val(),'emprendimiento', old);
                }                
            }

            $( "#departamento__empre" ).change(function() {   
                var old = @if(old('ciudad_empre') != "") {{old('ciudad_empre')}} @else "" @endif; 
                getCiudades($( "#departamento__empre" ).val(),'emprendimiento', old);
            });

            $( "#integrantes_hombres" ).change(function() {
                sumaIntegrantes();                
            });

            $( "#integrantes_mujeres" ).change(function() {
                sumaIntegrantes();
            });

            $( "#seleccionarEmprendimiento" ).click(function() {
                    
                var convocatoria_id = $("#convocatoria_id").val();                      
                var emprendimiento_id = $("#emprendimientos").val();                      
                var user_id = $("#user_id").val();                      
    
                if(emprendimiento_id != "" ){
    
                    if(convocatoria_id != "" || user_id != ""){
    
                        $.ajax({
                            type: 'POST',
                            url: '{{ route("convocatoria.ajaxSetEmprendimiento") }}',            
                            data: {  
                                    "_token": "{{ csrf_token() }}",
                                    "convocatoria_id": convocatoria_id,
                                    "emprendimiento_id": emprendimiento_id,
                                    "user_id": user_id,
                                },
                            dataType: 'json',
                            success: function(data){
        
                                //$("#convocatoria_id").val(""); 
                                $("#emprendimientos").val("");
                                $("#user_id").val("");
    
                                $("#exampleModal").modal("hide");
                                $("#emprendimiento_id").val(emprendimiento_id);

                                
                            Swal.fire({
                                    title: data.mensaje_response,
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: `Ok`,
                                    denyButtonText: `Cancelar`,
                                }).then((result) => {
                                    location.reload();
                                });
    
                            },
                            error: function(data) {
                                console.log('ERROR AJAX: '+data);
                            }
                
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Comuniquese con soporte!'
                        });
                    }
    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe seleccionar un emprendimiento!'
                    });
                }
            });

        });

        function listarEmprendimientos(user_id,convocatoria_id){
            //console.log("listarEmprendimientos"+convocatoria_id);
            $.ajax({
                type: 'POST',
                url: '{{ route("emprendimiento.ajaxListarEmprendimientos") }}',            
                data: {  
                        "_token": "{{ csrf_token() }}",
                        "user_id": user_id,
                        "convocatoria_id": convocatoria_id,
                      },
                dataType: 'json',
                success: function(data){
                   //console.log(data);
                   $("#emprendimientos").html(data.html);
                   $("#convocatoria_id").val(convocatoria_id);
                   $("#user_id").val(user_id);
    
                   $("#exampleModal").modal("show");                   
    
                },
                error: function(data) {
                    console.log('ERROR AJAX: '+data);
                }
    
            });
    
        }
    </script>
@endsection