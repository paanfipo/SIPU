@extends('dashboard')
@section('title_dashboard','Avance Convocatoria')
@section('breadcrumbs')
    {{ Breadcrumbs::render('convocatorias.avance',$convocatoria) }}
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Listado de registrados por etapa</h6>
        </div>
        <div class="card-body">
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
                                <div id="collapse_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" class="collapse @if($etapa->nombre == 'SENSIBILIZACIÓN')show @endif" aria-labelledby="headingOne_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" data-parent="#accordion" style="padding: 25px 50px 75px 100px;">                    
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>User</th>
                                            <th>Emprendimiento</th>
                                            <th>FInalización</th>
                                            <th>Acciones</th>
                                        </tr>
                                        @foreach($convocatoria->registrados()->orderBy('name','asc')->wherePivot('etapa_id', $etapa->id)->wherePivot('finalizado', false)->get() as $registrado)                                            
                                                              
                                            @php $emprendimiento = $registrado->emprendimientos()->where('id',$registrado->pivot->emprendimiento)->get(); @endphp
                                                
                                            <tr>
                                                <td> {{$registrado->name}}</td>
                                                <td>
                                                    @if(count($emprendimiento) > 0)
                                                        <span>{{$emprendimiento[0]->nombre}}</span>
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-danger badge-pill" title="Estado"><i class="fas fa-times"></i> </span></td>
                                                <td>
                                                    <a><i class="fas fa-hand-pointer fa-2x" style="color: red;" title="Seleccionar emprendimiento" onclick="listarEmprendimientos({{$registrado->id}},{{$registrado->pivot->convocatoria_id}})"></i></a>
                                                    <a href="{{route('listar.emprendimiento',$registrado->id)}}" target="_blank"><i class='fas fa-briefcase fa-2x' style="color: red;" title="Registrar emprendimiento"></i></a>
                                                    <a href="{{route('convocatoria.hojaVida',[$registrado->id,$convocatoria->id,$etapa->id])}}" target="_blank"><i class='fas fa-eye fa-2x' style="color: red;" title="Hoja de vida"></i></a>
                                                </td>
                                            </tr>  
                                            
                                        @endforeach       
                                        @foreach($convocatoria->registrados()->orderBy('name','asc')->wherePivot('etapa_id', $etapa->id)->wherePivot('finalizado', true)->get() as $registrado)                                            
                                            
                                            @php $emprendimiento = $registrado->emprendimientos()->where('id',$registrado->pivot->emprendimiento)->get(); @endphp
                                            
                                            <tr>
                                                <td> {{$registrado->name}}</td>
                                                <td>
                                                    @if(count($emprendimiento) > 0)
                                                        <span>{{$emprendimiento[0]->nombre}}</span>
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-danger badge-pill" title="Estado" ><i class="fas fa-check" style="color:white;"></i> </span></td>
                                                <td>
                                                    <a><i class="fas fa-hand-pointer fa-2x" style="color: red;" title="Seleccionar emprendimiento" onclick="listarEmprendimientos({{$registrado->id}},{{$registrado->pivot->convocatoria_id}})"></i></a>
                                                    <a href="{{route('listar.emprendimiento',$registrado->id)}}" target="_blank"><i class='fas fa-briefcase fa-2x' style="color: red;" title="Registrar emprendimiento"></i></a>
                                                    <a href="{{route('convocatoria.hojaVida',[$registrado->id,$convocatoria->id,$etapa->id])}}" target="_blank"><i class='fas fa-eye fa-2x' style="color: red;" title="Hoja de vida"></i></a>
                                                </td>
                                            </tr>                                               
                                           
                                        @endforeach                                   
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
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

    $(document).ready( function () {

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
                            
                        Swal.fire({
                                title: data.mensaje_response,
                                showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: `Ok`,
                                denyButtonText: `Cancelar`,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                //console.log(result);
                                location.reload();
                                /*if (result.value) {
                                    location.reload();
                                } else if (result.dismiss == "cancel") {
                                    location.reload();
                                }*/
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
</script>
@stop
