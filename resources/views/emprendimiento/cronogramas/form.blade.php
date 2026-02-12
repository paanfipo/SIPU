<div class="col-md-12">
    <div class="accordion" id="accordion">
        <label>Etapas:</label>
        @if(isset($convocatoria->etapas))
            @foreach($convocatoria->etapas as $etapa)
                <div class="card">
                    <div class="card-header" id="headingOne_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}">
                        <h5 class="mb-0">
                            <a  class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" aria-expanded="true" aria-controls="collapse_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}">
                                <i class="fa fa-plus"></i> {{$etapa->nombre}}
                            </a>
                        </h5>
                    </div>
                    <div id="collapse_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" class="collapse" aria-labelledby="headingOne_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" data-parent="#accordion" style="padding: 25px 50px 75px 60px;">                    
                        <div id="accordion_actividad">
                            <div class="card">
                                <div class="alert alert-warning" id="alert_actividad" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert">
                                        &times;
                                    </button>
                                    <ul id="mensaje_alert"></ul>
                                </div>
                                @foreach($etapa->actividades as $actividad)                   
                                    @php
                                        $cronograma = $actividad->cronogramaConvocatoria($convocatoria->id);
                                        if($cronograma == null){ $cronograma = false; }elseif($cronograma->fecha_hora_inicio == null){ $cronograma = false; }                                    
                                    @endphp
                                    <div class="card-header" id="actividad{{$actividad->id}}">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_actividad{{$actividad->id}}" aria-controls="collapseOne">
                                                {{$actividad->nombre}}
                                            </a>
                                        </h5>
                                    </div>
                            
                                    <div id="collapseOne_actividad{{$actividad->id}}" class="collapse" aria-labelledby="actividad{{$actividad->id}}" data-parent="#accordion_actividad" style="padding: 25px;">
                                        <div class="col-md-12"> 
                                            @if($actividad->personalizacion === true)
                                            <div class="card-body">
                                                <h5 class="card-title">Actividad Personalizada</h5>
                                                <p class="card-text">Descripción: {{$actividad->descripcion}}</p>                                                
                                            </div>
                                            <hr>
                                            @else                                           
                                            <form id="formActividad_{{$actividad->id}}">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="fecha_hora_inicio_{{$actividad->id}}" class="col-6 col-form-label">Fecha y hora inicio: *</label>
                                                        <div class="col-10">
                                                        <input class="form-control" 
                                                                    @if($cronograma) 
                                                                        value="{{str_replace(' ','T',$cronograma->fecha_hora_inicio->format('Y-m-d H:i:s'))}}"                                                                                                                                             
                                                                    @endif                                                                 
                                                                    type="datetime-local"
                                                                    id="fecha_hora_inicio_{{$actividad->id}}" 
                                                                    data-date-format="DD-MM-YYYY HH:mm:ss"
                                                                
                                                                    onchange="calDuracion('fecha_hora_inicio_',this.value,{{$actividad->id}});">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        
                                                        <label for="fecha_hora_fin_{{$actividad->id}}" class="col-6 col-form-label">Fecha y hora fin: *</label>
                                                        <div class="col-10">
                                                        <input class="form-control" 
                                                                @if( $cronograma ) value="{{str_replace(' ','T',$cronograma->fecha_hora_fin->format('Y-m-d H:i:s'))}}" @endif 
                                                                type="datetime-local" 
                                                                id="fecha_hora_fin_{{$actividad->id}}" 
                                                                data-date-format="DD-MM-YYYY HH:mm:ss" 
                                                                onchange="calDuracion('fecha_hora_fin_',this.value,{{$actividad->id}});">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="duracion" class="col-2 col-form-label">Duración: *</label>
                                                        <div class="col-10">
                                                            <input class="form-control" 
                                                                @if( $cronograma ) value="{{$cronograma->duracion}}" @endif
                                                                type="text" 
                                                                id="duracion_{{$actividad->id}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="observacion" class="col-2 col-form-label">Observación:</label>
                                                        <textarea class="form-control" id="observacion_{{$actividad->id}}" rows="3"> @if($cronograma ) {{$cronograma->observacion}} @endif</textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="enlace" class="col-2 col-form-label">Enlace:</label>
                                                        <input type="text" class="form-control" 
                                                                @if( $cronograma ) value="{{$cronograma->enlace}}" @endif    
                                                                id="enlace_{{$actividad->id}}">
                                                    </div>  
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="asesor" class="col-2 col-form-label">Asesor: *</label>
                                                        <select class="form-control" id="asesor_{{$actividad->id}}">      
                                                            <option value="">Seleccione un asesor</option>                                            
                                                        @foreach($asesores as $asesor)
                                                            <option value="{{$asesor->id}}" @if( $cronograma && $cronograma->asesor_id == $asesor->id) selected @endif  >{{$asesor->name}}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="cronograma_id_{{$actividad->id}}"  @if( $cronograma ) value="{{$cronograma->id}}" @endif >
                                                <button type="button" class="btn btn-primary" id="enviar_{{$actividad->id}}" onclick="enviarCronograma({{$actividad->id}},{{$convocatoria->id}})">Enviar Cronograma</button>
                                            </form>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="created_at" class="font-weight-bold">FECHA CREACIÓN</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="created_at_{{$actividad->id}}" 
                                                        @if( $cronograma ) value="{{$cronograma->created_at}}" @else value="" @endif >
                                                    </div>
                                                </div>
                        
                                                <div class="col-md-3">
                                                    <label for="updated_at" class="font-weight-bold">FECHA MODIFICACIÓN</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="updated_at_{{$actividad->id}}" @if( $cronograma ) value="{{$cronograma->updated_at}}" @else value="" @endif>
                                                    </div>
                                                </div>
                        
                                                <div class="col-md-3">
                                                    <label for="user_created_at" class="font-weight-bold">USUARIO CREACIÓN</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                                        </div>
                                                        <input type="text" disabled class="form-control" placeholder="Usuario" id="user_created_at_{{$actividad->id}}"  @if($cronograma && isset($cronograma->usuario_creacion)) value="{{$cronograma->usuario_creacion->name}}" @else value="" @endif>
                                                    </div>
                                                </div>
                        
                                                <div class="col-md-3">
                                                    <label for="user_updated_at" class="font-weight-bold">USUARIO MODIFICACIÓN</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                                        </div>
                                                        <input type="text" disabled class="form-control" placeholder="Usuario" id="user_updated_at_{{$actividad->id}}"  @if($cronograma && isset($cronograma->usuario_modificacion)) value="{{$cronograma->usuario_modificacion->name}}" @else value="" @endif>
                                                    </div>
                                                </div>
                        
                                            </div>
                                        </div>
                                    </div>  
                                    <hr/>                                   

                                @endforeach                
                            </div>
                        </div>   
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@section('script')
<script>

    var fecha_actual = new Date();
    var fecha_hora_inicio = "";
    var fecha_hora_fin = "";
    var convocatoria_fecha_inicio = $("#fecha_inicio").val();
    var convocatoria_fecha_fin = $("#fecha_fin").val();
    var mensaje = "";
    var validacion_fechas = true;

    function calDuracion(tipo,value,id) {       
        console.log("calDuracion");

        fecha_hora_inicio = $("#fecha_hora_inicio_"+id).val();
        fecha_hora_fin = $("#fecha_hora_fin_"+id).val();

        if(fecha_hora_inicio ==  "" && tipo == 'fecha_hora_inicio_'){
            fecha_hora_inicio = value;
        }

        if(fecha_hora_fin ==  "" && tipo == 'fecha_hora_fin_'){
            fecha_hora_fin = value;
        }

        if(fecha_hora_inicio != "" && fecha_hora_fin != ""){
            var obj_fecha_hora_inicio = new Date(fecha_hora_inicio);
            var obj_fecha_hora_fin = new Date(fecha_hora_fin);

            var obj_convocatoria_fecha_inicio = new Date(convocatoria_fecha_inicio);
            var obj_convocatoria_fecha_fin = new Date(convocatoria_fecha_fin);

            if(!(obj_fecha_hora_inicio >= obj_convocatoria_fecha_inicio) || !(obj_fecha_hora_inicio <= obj_convocatoria_fecha_fin)){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes ingresar una fecha y hora inicio que se encuentre dentro del rango de fechas de la convocatoria',
                  });
                  validacion_fechas = false;
            }else if(!(obj_fecha_hora_fin >= obj_convocatoria_fecha_inicio) || !(obj_fecha_hora_fin <= obj_convocatoria_fecha_fin)){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes ingresar una fecha y hora fin que se encuentre dentro del rango de fechas de la convocatoria',
                  });
                  validacion_fechas = false;
            }else{

                if(obj_fecha_hora_fin < obj_fecha_hora_inicio){
                    mensaje = 'La fecha inicio debe ser menor a la fecha fin !';
                    validacion_fechas = false;
                }else{
                    validacion_fechas = true;
                }
    
                var diff = obj_fecha_hora_fin - obj_fecha_hora_inicio;
                var horas = Math.floor(diff/(1000*60*60));
                var minutes = Math.floor((diff/1000)/60) - (horas*60); 
                var duracion = "";
                if(horas > 1){
                    duracion = horas+" horas y "+minutes+" minutos";
                }else{
                    duracion = horas+" hora y "+minutes+" minutos";
                }
    
                $("#duracion_"+id).val(duracion);
    
                if(mensaje != ""){
                    //$("#alert_actividad").show();
                    //$("#mensaje_alert").html(mensaje);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: mensaje,
                    });
                    mensaje = "";
                }

            }           
            
        }
    }

    function enviarCronograma(actividad,convocatoria){

        var data_fecha_hora_inicio = $("#fecha_hora_inicio_"+actividad).val();
        var data_fecha_hora_fin = $("#fecha_hora_fin_"+actividad).val();
        var duracion = $("#duracion_"+actividad).val();
        var observacion = $("#observacion_"+actividad).val();
        var enlace = $("#enlace_"+actividad).val();
        var asesor = $("#asesor_"+actividad).val();
        var cronograma = $("#cronograma_id_"+actividad).val();
        

        if(data_fecha_hora_inicio == ""){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe ingresar la fecha y hora inicio',
              });
        }else if(data_fecha_hora_fin == ""){            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe ingresar la fecha y hora fin',
              });
        }else if(duracion == ""){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'el sistema debe generar la duración del evento, porfavor ingrese las fechas',
              });
        }else if(asesor == ""){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Dede seleccionar un asesor!',
              });

        }else if(validacion_fechas){

            $.ajax({
                type: 'POST',
                url: '{{ route("cronogramas.store") }}',      
                data: { 
                        actividad: actividad,
                        convocatoria: convocatoria,
                        data_fecha_hora_inicio : data_fecha_hora_inicio,
                        data_fecha_hora_fin : data_fecha_hora_fin,
                        duracion : duracion,
                        observacion : observacion,
                        enlace : enlace,
                        asesor : asesor,
                        cronograma : cronograma,
                      },
                dataType: 'json',
                success: function(data){
                    console.log(data);

                    $("#created_at_"+actividad).val(data.data.created_at);
                    $("#updated_at_"+actividad).val(data.data.updated_at);

                    $("#user_created_at_"+actividad).val(data.user_created);
                    $("#user_updated_at_"+actividad).val(data.user_updated);

                    Swal.fire({
                        icon: data.type,
                        title: 'Oops...',
                        text: data.message,
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
                text: 'Revise el formulario, algunos datos no estan bien definidos!'
            })
        }

    }

    $(document).ready(function(){
        
            // Add minus icon for collapse element which is open by default
            $(".collapseEtapa.show").each(function(){
                $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapseEtapa").on('show.bs.collapseEtapa', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapseEtapa', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });

    });

    
</script>
@stop
