<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SIPU</title>

  <!-- Custom fonts for this template-->
  <link href="{{ url('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-danger">

  <div class="container">
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow row">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" colspan="4"><center><strong>Detalle Convocatoria</strong></center></th>
                      </tr>
                </thead>
                <tbody>
                  <tr>
                        <th>Nombre:</th>
                        <td>@if( $convocatoria !== null) {{$convocatoria->nombre}} @endif</td>
                        <th>Estado:</th>
                        <td>@if( $convocatoria !== null) {{$convocatoria->estado}} @endif</td>
                  </tr>
                  <tr>
                    <th>Fecha Inicio: </th>
                    <td>@if( $convocatoria !== null) {{ optional($convocatoria->fecha_inicio)->format('Y-m-d') }} @endif</td>
                    <th>Fecha Fin: </th>
                    <td>@if( $convocatoria !== null) {{ optional($convocatoria->fecha_fin)->format('Y-m-d') }} @endif</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-7">            
            <div class="p-2">
                
                <form class="user" method="POST" action="{{ route('linkPublicoRegistro.registro') }}">
                  @csrf
                  <fieldset>
                      <legend><center>Datos personales!</center></legend>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="Nombres" value="{{old('first_name')}}" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="Apellidos" value="{{old('last_name')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="{{old('email')}}" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" id="phone" name="phone" placeholder="Numero Telefonico" value="{{old('phone')}}">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" id="estamento" name="estamento" placeholder="Estamento" value="{{old('estamento')}}">
                        </div>
                    </div>    
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <select class="form-control" name="departamento" id="departamento">
                                <option value="" selected>Seleccione un departamento</option>
                                @foreach ($departamentos as $departamento)
                                <option value="{{$departamento->id}}"> {{$departamento->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" name="ciudad"  id="ciudad">
                                <option value="" selected>Seleccione una ciudad</option>
                            </select>
                        </div>
                    </div>    
                    <div class="form-group col-md-12">
                        <textarea class="form-control" id="perfil_profesional" name="perfil_profesional" placeholder="Programa académico al que perteneces? o tu perfil profesional?">{{old('perfil_profesional')}}</textarea>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" required>
                      </div>
                      <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="password_confirmation" placeholder="Repetir Password" required>
                      </div>
                    </div>
                  </fieldset>
                  <hr>
                  <fieldset>
                      <legend><center>Preguntas!</center></legend>

                      <div class="form-group col-md-12">
                        <textarea class="form-control" id="pregunta_1" name="pregunta_1" placeholder="¿En qué área te gustaría recibir capacitación para fortalecer tú proyecto?">{{old('pregunta_1')}}</textarea>
                      </div>

                      <div class="form-group col-md-12">
                        <select class="form-control" name="jornada" id="jornada">
                            <option value="" selected>¿En que jornada te gustaría recibir la capacitación</option>
                            <option value="Nocturna">Nocturna</option>
                            <option value="Diurna ( Mañana )">Diurna ( Mañana )</option>
                            <option value="Diurna ( Tarde )">Diurna ( Tarde )</option>
                        </select>
                      </div>
    
                      <div class="form-group col-md-12">
                        <textarea class="form-control" id="pregunta_2" name="pregunta_2" placeholder="¿Sabes para que es la Unidad de Emprendimiento?">{{old('pregunta_2')}}</textarea>
                      </div>

                      <div class="form-group col-md-12">
                        <textarea class="form-control" id="pregunta_3" name="pregunta_3" placeholder="¿Descríbenos tu idea de emprendimiento?">{{old('pregunta_3')}}</textarea>
                      </div>

                      <div class="form-group col-md-12">
                        <textarea class="form-control" id="pregunta_4" name="pregunta_4" placeholder="¿Descríbenos tu idea o modelo de negocio? (Clientes, producto o servicio,propuesta de valor) *" rows="5">{{old('pregunta_4')}}</textarea>
                      </div>

                      <div class="form-group col-md-12">
                        <textarea class="form-control" id="pregunta_5" name="pregunta_5" placeholder="¿En qué nivel esta tú proyecto de emprendedor? *" rows="5">{{old('pregunta_5')}}</textarea>
                      </div>
                      
                  </fieldset>
                  @if($checkin_on)
                    <button type="submit" class="btn btn-danger btn-user btn-block">
                      Registrate!
                    </button>   
                  @endif        
                  <input type="hidden" name="convocatoria_id" value="{{$convocatoria->id}}">    
                </form>
                <hr>                
              </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}" ></script>
  
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('admin/js/sb-admin-2.min.js') }} "></script>

  <script>
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
    });
    </script>

</body>

</html>
