@extends('dashboard')
@section('style')
<style type="text/css">
    #contentLoading {
        display: none;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
    }

    #contentLoading .loading {
        background-color: #4E5555;
        color: #FFFFFF;
        font-weight: bold;
        margin: 0 auto;
        position: relative;
        text-align: center;
        width: 100px;
    }

    #contentLoading .loading {
        border-radius: 0 0 5px 5px;
        font-weight: normal;
        height: 25px;
        line-height: 25px;
    }
</style>
@endsection
@section('title_dashboard','Gestionar Novedades')
@section('breadcrumbs')
    {{ Breadcrumbs::render('gestiones.novedades',$cronograma) }}
@endsection
@section('content')

@include('emprendimiento.gestiones.encabezado_novedad')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Novedades</h6>
    </div>
    <div class="card-body">
        <div id="contentLoading">
            <div class="loading">Loading...</div>
        </div>

        <form>

        <hr>
            <fieldset>
                <legend>Form</legend>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="estado">Inscriptos:</label>
                        <select class="form-control"  id="user_id" onChange="getNovedades({{$cronograma->id}})" @role('General') disabled @endrole >
                            <option value="">Selecione un usuario</option>
                            @foreach($cronograma->asistencias as $asistencia)
                                <option value="{{$asistencia->user->id}}" @if((isset($inscripto) || $inscripto != null) && ($inscripto == $asistencia->user->id) ) selected @endif @role('General') @if( auth()->user()->id == $asistencia->user_id ) selected @endif @endrole >{{$asistencia->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion">Novedad:</label>
                        <textarea class="form-control" id="novedad" rows="5" cols="100"></textarea>                
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="emprendimiento">Empredimientos :</label>
                        <select class="form-control" id="emprendimiento" name="emprendimiento" >
                            <option value="">Seleccione un emprendimiento</option>                           
                        </select>
                    </div>
                </div>

            </fieldset>            
        <hr>
            <fieldset>
                <legend>Novedades:</legend>
                <div class="col-md-12" id="list_novedades">
                                      
                </div>
            </fieldset>
            <div class="col-md-12">
                <br>
                <br>                
                <div class="box-footer">
                    <button type="button" class="btn btn-danger" id="send" onclick="enviarNovedad({{$cronograma->id}})" ><i class="far fa-paper-plane"></i> Enviar</button>
                    <a href="{{route('gestiones.tramites',$convocatoria->id)}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

@stop

@section('script')
<script>

    var __USE_GENERIC_LOADING__ = true;

    $(document).ajaxSend(function (r, s) {
        console.log("ajaxSend");
        if (__USE_GENERIC_LOADING__)
            $("#contentLoading").show();
            $("#send").prop( "disabled", true );
    });

    $(document).ajaxStop(function (r, s) {
        console.log("ajaxStop");
        if (__USE_GENERIC_LOADING__)
            $("#contentLoading").fadeOut("fast");
            $("#send").prop( "disabled", false );
    });

    function invalidateGenericLoading() {
        console.log("invalidateGenericLoading");
        __USE_GENERIC_LOADING__ = false;
    }
        
    function getNovedades(cronograma){
        console.log(cronograma);
        console.log($("#user_id").val());
        var  inscripto = $("#user_id").val();
        //var cronograma = cronograma;
        
        if(inscripto != ""){  
            $.ajax({
                type: 'POST',
                url: '{{ route("gestiones.getAjaxNovedad") }}',      
                data: { 
                        cronograma_id: cronograma,
                        inscripto: inscripto,
                      },
                dataType: 'json',
                success: function(data){
                   console.log(data);
                    $("#list_novedades").html(data.html);
                    $("#emprendimiento").html(data.emprendimientos);
                },
                error: function(data) {
                    console.log('ERROR AJAX: '+data);
                }
            });
        }
    }
    function enviarNovedad(cronograma){
        var inscripto = $("#user_id").val();
        var novedad = $("#novedad").val();
        var emprendimiento = $("#emprendimiento").val();

        if(inscripto == ""){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe seleccionar un inscripto',
              });
        }else if(novedad == ""){            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe ingresar una novedad',
              });
        }else{

            $.ajax({
                type: 'POST',
                url: '{{ route("gestiones.setAjaxNovedad") }}',      
                data: { 
                        cronograma_id: cronograma,
                        inscripto: inscripto,
                        novedad: novedad,
                        emprendimiento: emprendimiento,
                      },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $("#list_novedades").html(data.html);
                    Swal.fire({
                        icon: data.type,
                        title: 'Oops...',
                        text: data.mensaje_response,
                    });
                },
                error: function(data) {
                    console.log('ERROR AJAX: '+data);
                }
            });
        }
    }
    
    $( document ).ready(function() {
        
        var  inscripto = $("#user_id").val();
        var cronograma = {{$cronograma->id}};
        
        if(inscripto != "" && cronograma != ""){ 
            console.log(inscripto+" "+cronograma);
            getNovedades(cronograma);
        }
    });
</script>
@stop
