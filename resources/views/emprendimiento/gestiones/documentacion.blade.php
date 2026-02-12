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
@section('title_dashboard','Gestionar Documentación')
@section('breadcrumbs')
    {{ Breadcrumbs::render('gestiones.documentacion',$cronograma) }}
@endsection
@section('content')

@include('emprendimiento.gestiones.encabezado_novedad')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Documentación</h6>
    </div>
    <div class="card-body">
        <div id="contentLoading">
            <div class="loading">Loading...</div>
        </div>

        <form id="form_send_file" role="form" accept-charset="UTF-8" enctype="multipart/form-data" >
            @csrf
            <hr>
                <fieldset>
                    <legend>Form</legend>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="estado">Inscriptos:</label>
                            <select class="form-control"  id="user_id" onchange="searchFileInscripto()" @role('General') disabled @endrole >
                                <option value="">Selecione un usuario</option>
                                @foreach($cronograma->asistencias as $asistencia)
                                    <option value="{{$asistencia->user->id}}" @if((isset($inscripto) || $inscripto != null) && ($inscripto == $asistencia->user->id) ) selected @endif @role('General') @if( auth()->user()->id == $asistencia->user_id ) selected @endif @endrole >{{$asistencia->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>            
            <hr>
            <fieldset>
                <legend>Documentación:</legend>
                <div class="col-md-12" id="list_novedades">
                                      
                </div>
            </fieldset>
          
            <div class="col-md-12">
                <div class="form-group" id="upload_file_1">
                    <label for="file_one">Subir archivo 1</label>
                    <input type="file" class="form-control-file" id="file_one" name="opciones1">
                </div>
    
                <div class="col-md-6" id="download_file_1" style="display: none">
                    <label for="descargar" class="font-weight-bold">Download File 1:</label>
                    <div class="input-group">  
                        <a href="" class="btn btn-large pull-right" id="download_opciones1"><i class="fa fa-file-download fa-2x"> </i> Download File 1 </a>
                    </div> 
                </div> 
            </div>
             

            <div class="col-md-12">
                <div class="form-group" id="upload_file_2">
                    <label for="file_two">Subir archivo 2</label>
                    <input type="file" class="form-control-file" id="file_two" name="opciones2">
                </div>

                <div class="col-md-6" id="download_file_2" style="display: none">
                    <label for="descargar" class="font-weight-bold">Download File 2:</label>
                    <div class="input-group">  
                        <a href="" class="btn btn-large pull-right" id="download_opciones2"><i class="fa fa-file-download fa-2x"> </i> Download File 2 </a>
                    </div> 
                </div> 
            </div>
           

            <div class="col-md-12">

                <div class="form-group" id="upload_file_3">
                    <label for="file_three">Subir archivo 3</label>
                    <input type="file" class="form-control-file" id="file_three" name="opciones3">
                </div>

                
                <div class="col-md-6" id="download_file_3" style="display: none">
                    <label for="descargar" class="font-weight-bold">Download File 3:</label>
                    <div class="input-group">  
                        <a href="" class="btn btn-large pull-right" id="download_opciones3"><i class="fa fa-file-download fa-2x"> </i> Download File 3 </a>
                    </div> 
                </div> 

            </div>
            
            <div class="col-md-12">
                <br>
                <br>                
                <div class="box-footer">
                    <button type="button" class="btn btn-danger" onclick="formsendfile()"><i class="fas fa-save"></i> Enviar</button>
                    <input type="hidden" id="convocatoria_id" value="{{$convocatoria->id}}" />
                    <input type="hidden" id="cronograma_id" value="{{$cronograma->id}}" />
                    <a href="{{route('gestiones.tramites',$convocatoria->id)}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

@stop

@section('script')
<script>
    
    function searchFileInscripto(){
        $.ajax({
            type: 'POST',
            url: '{{ route("gestiones.getFileInscripto") }}',            
            data: {  
                    "_token": "{{ csrf_token() }}",
                    "cronograma_id": $("#cronograma_id").val(),
                    "inscripto": $("#user_id").val(),
                  },
            dataType: 'json',
            success: function(data){

               if((data.files.length > 0 ) && data.url != ""){
                    
                    if(data.files[0].file_1 != null){
                        $("#upload_file_1").css('display', 'none');
                        $("#download_file_1").css('display', 'block');
                        $("#download_opciones1").attr("href", data.url+"/"+1);
                    }
                   
                    if(data.files[0].file_2 != null){
                        $("#upload_file_2").css('display', 'none');
                        $("#download_file_2").css('display', 'block');
                        $("#download_opciones2").attr("href", data.url+"/"+2);
                    }

                    if(data.files[0].file_3 != null){
                        $("#upload_file_3").css('display', 'none');
                        $("#download_file_3").css('display', 'block');
                        $("#download_opciones3").attr("href", data.url+"/"+3);
                    }

                }

            },
            error: function(data) {
                console.log('ERROR AJAX: '+data);
            }

        });

    }

    function formsendfile(){

            var inscripto = $("#user_id").val();

            if(inscripto == "" || inscripto == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe seleccionar un inscripto subir la documentación',
                });
            }else{
                var formData = new FormData($('#form_send_file')[0]);
                var token = $('input[name=_token]').val();
                console.log(formData);
                formData.append("convocatoria_id", $("#convocatoria_id").val());
                formData.append("cronograma_id", $("#cronograma_id").val());
                formData.append("inscripto_id", inscripto);
                //formData.append(f.attr("name"), $(this)[0].files[0]);
                $.ajax({                
                    url: '{{ route("gestiones.store-file") }}',
                    headers: {'X-CSRF-TOKEN':token},
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData  
                })
                .done(function(res){
                    console.log(res);

                    if((res.files != null ) && res.url != ""){

                        if(res.files.file_1 != null){
                            $("#upload_file_1").css('display', 'none');
                            $("#download_file_1").css('display', 'block');
                            $("#download_opciones1").attr("href", res.url+"/"+1);
                        }
    
                        if(res.files.file_2 != null){
                            $("#upload_file_2").css('display', 'none');
                            $("#download_file_2").css('display', 'block');
                            $("#download_opciones2").attr("href", res.url+"/"+2);
                        }
    
                        if(res.files.file_3 != null){
                            $("#upload_file_3").css('display', 'none');
                            $("#download_file_3").css('display', 'block');
                            $("#download_opciones3").attr("href", res.url+"/"+3);
                        }
                    }
                    

                }).fail( function( jqXHR, textStatus, errorThrown ) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: JSON.stringify(jqXHR.responseJSON.errors),
                    });
                
                });
            }
    }

    $(function(){       


        $("#form_send_file").on("submit", function(e){

            

            
        });

    });

    
</script>
@stop
