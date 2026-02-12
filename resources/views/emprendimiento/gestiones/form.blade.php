<div class="col-md-12">
    <div class="accordion" id="accordion">
        <label>Etapas:</label>
        @if(isset($convocatoria->etapas))
            @foreach($convocatoria->etapas as $etapa)
                <div class="card">
                    <div class="card-header" id="headingOne_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}">
                        <h5 class="mb-0">
                            <a  class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" aria-expanded="true" aria-controls="collapse_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}">
                                <i class="fa fa-plus"></i>{{$etapa->nombre}}
                            </a>
                        </h5>
                    </div>
                    <div id="collapse_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" class="collapse show" aria-labelledby="headingOne_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" data-parent="#accordion" style="padding: 25px 50px 75px 100px;">                    
                    <div id="accordion_actividad">
                        <div class="card">                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><strong>Actividad</strong></th>
                                        <th scope="col"><strong>Fecha Hora Inicio</strong></th>
                                        <th scope="col"><strong>Fecha Hora Fin</strong></th>
                                        <th scope="col"><strong>Asesor</strong></th>
                                        <th scope="col"><strong>Acciones</strong></th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach($etapa->actividades as $actividad) 
                                    @php
                                        $cronograma = $actividad->cronogramaConvocatoria($convocatoria->id);
                                    @endphp
                                    @if($cronograma !== null)     
                                        <tr>
                                            <td>{{$actividad->nombre}}</td>
                                            <td>{{$cronograma->fecha_hora_inicio}}</td>
                                            <td>{{$cronograma->fecha_hora_fin}}</td>
                                            <td>{{$cronograma->asesor->name}}</td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="row align-items-center">
                                                        @role('Asesor')
                                                            @if( $etapa->nombre == 'PREINCUBACIÓN' || $etapa->nombre == 'ACELERACIÓN')
                                                                @if($convocatoria->getOriginal('estado') == 1 && count($convocatoria->cronogramas) > 0)
                                                                    @can('Solicitudes')      
                                                                    <!--<span class="px-2">                                              
                                                                            <a href="#" title="Solicitudes"><i class="fas fa-bell fa-2x"></i></a>                                               
                                                                        </span>-->
                                                                    @endcan
                                                                    @can('Novedades')
                                                                        <span class="px-2">                                        
                                                                            <a  href="{{route('gestiones.novedades', $cronograma->id)}}" title="Novedades"><i class="fas fa-envelope-open-text fa-2x"></i></a>                                        
                                                                        </span>
                                                                    @endcan
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if($convocatoria->getOriginal('estado') == 1 && count($convocatoria->cronogramas) > 0)
                                                                @can('Solicitudes')      
                                                                <!--<span class="px-2">                                              
                                                                        <a href="#" title="Solicitudes"><i class="fas fa-bell fa-2x"></i></a>                                               
                                                                    </span>-->
                                                                @endcan
                                                                @can('Novedades')
                                                                    <span class="px-2">                                        
                                                                        <a  href="{{route('gestiones.novedades', $cronograma->id)}}" title="Novedades"><i class="fas fa-envelope-open-text fa-2x"></i></a>                                        
                                                                    </span>
                                                                @endcan
                                                                @can('Documentacion')
                                                                    <span class="px-2">                                        
                                                                        <a  href="{{route('gestiones.documentacion', $cronograma->id)}}" title="Documentación"><i class="fas fa-folder-open fa-2x"></i></a>                                        
                                                                    </span>
                                                                @endcan
                                                            @endif
                                                        @endrole
                                                            
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif        
                                   @endforeach    
                                </tbody>
                            </table>                                          
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
</script>
@stop
