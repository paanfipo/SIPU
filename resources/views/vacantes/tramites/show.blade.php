@extends('dashboard')
@section('title_dashboard','Detalle Postulación')
@section('breadcrumbs')
    {{ Breadcrumbs::render('tramites.show',$tramite,$user) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tramite</h6>
        </div>
        <div class="card-body">
                <div class="col-md-12">
                    <fieldset @if(isset($disabled)){{$disabled}}@endif>
                        <legend>Datos de Postulación</legend>
                        @include('vacantes.tramites.form')
                    </fieldset>
                    <fieldset>
                        <legend>Usuario</legend>
                        @if($user->hasRole('Estudiante'))
                            <div class="col-md-12">
                                <di class="row form-inline">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label for="name">Estudiante: </label></strong>
                                            <a target="_blank" href="{{route('usuario.hojaVida',$user->id)}}">@if(isset($user)){{$user->name}}@endif</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label for="codigo_estudiante">Codigo Estudiante:</label></strong>
                                            <span>@if(isset($user->userInfo) ) {{$user->userInfo->codigo_estudiante}} @endif</span>
                                        </div>
                                    </div>
                                </di>
                                <br>
                                <div class="row form-inline">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label for="codigo_carrera">Codigo Carrera:</label></strong>
                                            <span>@if(isset($user->userInfo) ) {{$user->userInfo->codigo_carrera}} @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label for="email_institucional">Email Institucional:</label></strong>                                            
                                            <span>@if(isset($user->userInfo) ) {{$user->userInfo->email_institucional}} @endif</span>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-12">
                                <br>
                                <div class="row"> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="formato_D10" class="font-weight-bold">D10:</label>
                                            <a  target="_blank" href="{{route('usuario.D10',$user->id)}}"  class="btn btn-large pull-right" title="Formato D10"><i class="fas fa-address-book fa-2x"></i> Download</a>                                                        
                                        </div>
                                    </div>
                                    @if(isset($user->curriculum) && $user->curriculum->cedula != "")
                                    <div class="col-md-3">                                            
                                        <div class="form-group" id="download_cedula">
                                            <label for="download_cedula_file" class="font-weight-bold">Cedula:</label>                
                                            <a href="{{route('ofertas.downloadFile', [$user->id,'Cedula'])}}" class="btn btn-large pull-right" id="download_cedula_file"><i class="fa fa-file-download fa-2x"> </i> Download </a>                
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($user->curriculum) && $user->curriculum->tabulado != "")
                                    <div class="col-md-3">
                                        <div class="form-group" id="download_tabulado">
                                            <label for="download_tabulado_file" class="font-weight-bold">Tabulado:</label>                
                                            <a href="{{route('ofertas.downloadFile', [$user->id,'Tabulado'])}}" class="btn btn-large pull-right" id="download_tabulado_file"><i class="fa fa-file-download fa-2x"> </i> Download </a>                
                                        </div>     
                                    </div>
                                    @endif    
                                    @if(isset($user->curriculum) && $user->curriculum->confidencialidad != "")
                                    <div class="col-md-3">
                                        <div class="form-group" id="download_confidencialidad">
                                            <label for="download_confidencialidad_file" class="font-weight-bold">Confidencialidad:</label>                
                                            <a href="{{route('ofertas.downloadFile', [$user->id,'Confidencialidad'])}}" class="btn btn-large pull-right" id="download_confidencialidad_file"><i class="fa fa-file-download fa-2x"> </i> Download </a>                
                                        </div>     
                                    </div>  
                                    @endif    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @if(isset($user->curriculum) && $user->curriculum->recibo_pago != "")
                                    <div class="col-md-3">            
                                        <div class="form-group" id="download_recibo_pago">
                                            <label for="download_recibo_pago_file" class="font-weight-bold">Recibo Pago:</label>                
                                            <a  href="{{route('ofertas.downloadFile', [$user->id,'Recibo de pago'])}}" class="btn btn-large pull-right" id="download_recibo_pago_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                        </div>
                                    </div>
                                    @endif    
                                    @if(isset($user->curriculum) && $user->curriculum->certificacion_bancaria != "")
                                    <div class="col-md-3">            
                                        <div class="form-group" id="download_certificacion_bancaria">
                                            <label for="download_certificacion_bancaria_file" class="font-weight-bold">Certificación Bancaria:</label>                
                                            <a href="{{route('ofertas.downloadFile', [$user->id,'Certificacion Bancaria'])}}" class="btn btn-large pull-right" id="download_certificacion_bancaria_file"><i class="fa fa-file-download fa-2x"> </i> Download</a>                
                                        </div>
                                    </div>
                                    @endif    
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="usuario">Detalle Usuario:  </label>
                                    <a href="{{route('usuarios.show',$user->id)}}" name="usuario">{{$usuario}}</a>
                                </div>
                            </div>
                        @endif
                    </fieldset>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4">
                                @if(isset($disabled))
                                    @if(!$checkin_on)
                                    @can('Admitir Postulación')
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class='fas fa-bookmark'></i>  Admitir Postulación</button>
                                    @endcan
                                    @endif
                                @endif
                                @if(isset($disabled))
                                    @if($checkin_on)                                    
                                        @can('Rechazar Postulación')
                                            <button type="button" class='btn btn-danger' onclick="confirmacionRechazar({{$tramite->id}}, {{$user->id}})" ><i class='fas fa-bookmark'></i>  Rechazar Postulación</button>
                                        @endcan
                                    @endif
                                @endif
                            </div>
                        </div>
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
                            <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="created_at" value="{{$tramite->created_at}}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="updated_at" class="font-weight-bold">FECHA MODIFICACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="YY-MM-DD" id="updated_at" value="{{$tramite->updated_at}}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="user_created_at" class="font-weight-bold">USUARIO CREACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="Usuario" id="user_created_at" value="@if(isset($tramite->usuario_creacion)) {{$tramite->usuario_creacion->name}} @endif">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="user_updated_at" class="font-weight-bold">USUARIO MODIFICACIÓN</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <input type="text" disabled class="form-control" placeholder="Usuario" id="user_updated_at" value="@if(isset($tramite->usuario_modificacion)) {{$tramite->usuario_modificacion->name}} @endif">
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <a href="{{route('tramites.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">Descripción lugar de la entrevista con fecha y hora: </label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="5" ></textarea>
                </div>
            </div>
            @if($user->hasRole('Estudiante'))
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="promedio">Promedio Total:</label>
                        <input type="text" class="form-control" name="promedio" id="promedio" value="@if(isset($user->userInfo)){{$user->userInfo->promedio}}@endif" >
                    </div>
                </div>
            </div>
            @endif
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="admitirPostulacion({{$tramite->id}}, {{$user->id}})" >Enviar mensaje</button>
      </div>

    </div>
  </div>
</div>

@endsection

@section('script')
<script>

    function admitirPostulacion(tramite_id,user_id){
        //console.log(tramite_id+" "+user_id);
        var descripcion = $("#descripcion").val();
        var promedio = null;
        
        @if($user->hasRole('Estudiante'))
            console.log("Acepto el promedio");
            var promedio = $("#promedio").val();
            console.log(promedio);
            if(promedio != null && promedio == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes ingresar el promedio total del estudiante',
                });
                return;
            }
        @endif

        if(descripcion == ""){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe indicar el lugar de la entrevista junto con la fecha y hora',
              });
        }else{
            $.ajax({
                type: 'POST',
                url: '{{ route("tramites.admitirPostulacion") }}',      
                data: { 
                        oferta_id: tramite_id,
                        user_id: user_id,
                        descripcion: descripcion,
                        promedio: promedio,
                      },
                dataType: 'json',
                success: function(data){
                    Swal.fire({
                        title: 'Info!',
                        icon: data.type,                    
                        text: data.message,
                        confirmButtonText: `Ok`,
                    }).then((result) => {  
                        window.location.reload();
                    });
                },
                error: function(data) {
                    console.log('ERROR AJAX: '+data);
                }
            });
        }
    }

    function confirmacionRechazar(tramite_id,user_id){

        Swal.fire({
            title: 'Quieres rechazar la postulación?',
            showCancelButton: true,
            confirmButtonText: `Si`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.value) {
                window.location.replace('{{route("tramites.rechazarPostulacion",[$tramite->id, "user_id"=>$user->id])}}');
            } else if (result.dismiss == "cancel") {
                Swal.fire('Los cambios no se guardaron', '', 'info')
            }
        })

        //href="{{route('tramites.rechazarPostulacion',[$tramite->id, 'user_id'=>$user->id])}}"
    }
</script>
@stop