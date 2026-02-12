@extends('dashboard')
@section('title_dashboard','Formato  caracterización unidad de emprendimiento para pasar de incubación (asesoria) a aceleración')
@section('breadcrumbs')
    {{ Breadcrumbs::render('asistencia.caracterizacion_incubacion',$convocatoria,$usuario->id) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Caracterización Incubación (Asesorias)</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('asistencia.set_caracterizacion_empresarial')}}">
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
                <div class="col-md-12">                   
                    <div class="row">

                        <div class="col-md-12">
                            <hr/>
                            <fieldset>
                                <legend>Datos personales</legend>
                                <div class="form-group">
                                    <label for="name">Nombre: *</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name" value="@if(isset($usuario) ) {{$usuario->name}} @else {{ old('name') }} @endif" disabled>
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
                                    <label for="direccion">Dirección: *</label>
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
                            
                            </fieldset>
                        </div>

                        <div class="col-md-12"> 
                            <hr/>
                            <fieldset>

                                <legend>Detalle Empresa</legend>

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_emprendimiento">Nombre Emprendimiento: *</label>
                                            <input type="text" class="form-control" name="nombre_emprendimiento" id="nombre_emprendimiento" @if(isset($emprendimiento) ) value="{{$emprendimiento->nombre}}" @else value="{{old('nombre_emprendimiento')}}" @endif required disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion_emprendimiento">Descripción Emprendimiento: *</label>
                                            <textarea  class="form-control" name="descripcion_emprendimiento" id="descripcion_emprendimiento" disabled>
                                                @if(isset($emprendimiento) ) 
                                                    {{$emprendimiento->descripcion}}
                                                @else
                                                    {{old('descripcion_emprendimiento')}}
                                                @endif
                                            </textarea>
                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="tipo_zona">Se encuentra registrado en camara de comercio: *</label>
                                </div>   

                                <div class="row">                      
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="camara_comercio" id="camara_comercio_on" value="true" @if((isset($emprendimiento) && ($emprendimiento->camara_comercio == true)) || (old('camara_comercio') == true) ) checked @endif required>
                                            <label for="camara_comercio_on">SI</label>                                    
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="camara_comercio" id="camara_comercio_off" value="false" @if((isset($emprendimiento) && ($emprendimiento->camara_comercio == false)) || (old('camara_comercio') == false) ) checked @endif required>
                                            <label for="camara_comercio_off">NO</label>                                    
                                        </div>
                                    </div>
                                </div>  


                                <div class="form-group">
                                    <br>
                                    <label for="tipo_empresa">Su empresa u organización es: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($tipos_empresa as $tipo)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tipo_empresa" id="{{$tipo->nombre}}" value="{{$tipo->id}}" @if((isset($emprendimiento) && ($emprendimiento->tipo_empresa == $tipo->id)) || (old('tipo_empresa') == $tipo->id) ) checked @endif required>
                                                <label for="{{$tipo->nombre}}">{{$tipo->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="ruta_emprensarial">Presentación de la ruta empresarial a seguir: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($ruta_emprensarial as $tipo)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ruta_emprensarial" id="{{$tipo->nombre}}" value="{{$tipo->id}}" @if((isset($emprendimiento) && ($emprendimiento->ruta_empresarial == $tipo->id)) || (old('ruta_empresarial') == $tipo->id) ) checked @endif required>
                                                <label for="{{$tipo->nombre}}">{{$tipo->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="ruta_emprensarial">Módulos: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($ruta_modulo as $tipo)                                    
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="ruta_modulo[]" id="{{$tipo->nombre}}" value="{{$tipo->id}}" @if(  isset($emprendimiento->tipo_ruta_modulo) && (in_array($tipo->id, json_decode($emprendimiento->tipo_ruta_modulo) )  )  ) checked @endif>
                                                <label for="{{$tipo->nombre}}">{{$tipo->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="ruta_emprensarial">Tipo de acompañamiento: *</label>
                                </div>
                                <div class="row">                                    
                                    @foreach($ruta_acompañamiento as $tipo)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ruta_acompañamiento" id="{{$tipo->nombre}}" value="{{$tipo->id}}" @if((isset($emprendimiento) && ($emprendimiento->tipo_ruta_acompañamiento == $tipo->id)) || (old('ruta_acompañamiento') == $tipo->id) ) checked @endif required>
                                                <label for="{{$tipo->nombre}}">{{$tipo->nombre}}</label>                                    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>           

                            </fieldset>
                        </div>
                    </div>
                </div>
                <hr/>
                

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