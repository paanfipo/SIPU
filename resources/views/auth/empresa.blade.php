<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIPU Registro Empresa</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{url('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<body class="bg-gradient-danger">

  <div class="container">
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
             
              <form class="user" method="POST" action="{{ route('crear.empresa') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">  Datos usuario!</h1>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="first_name" placeholder="Nombres" value="{{old('first_name')}}" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="last_name" placeholder="Apellidos" value="{{old('last_name')}}" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email" value="{{old('email')}}" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="password_confirmation" placeholder="Repetir Password" required>
                  </div>
                </div>
                <br>
                <br>
                
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">  Datos empresa!</h1>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="" name="nombre_empresa" placeholder="Nombre Empresa" value="{{old('nombre_empresa')}}" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="" name="nit_empresa" placeholder="Nit" value="{{old('nit_empresa')}}" required>
                  </div>
                </div>
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
                                
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="direccion" name="direccion" placeholder="Dirección Empresa" value="{{old('direccion')}}" required>
                </div>
                <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Alerta!</h4>
                  <p>No podrá publicar ofertas hasta que validen su legalidad.</p>
                </div>
                <div class="form-group">
                  <label for="file_rut">RUT:</label>
                  <input type="file" class="form-control" id="file_rut" name="file_rut" value="{{old('file_rut')}}" required>
                </div>
                <div class="form-group">
                  <label for="file_camara_comercio">Camara de comercio:</label>
                  <input type="file" class="form-control" id="file_camara_comercio" name="file_camara_comercio" value="{{old('file_camara_comercio')}}" required>
                </div>
                <div class="form-group">
                  <label for="file_representante">Camara de comercio:</label>
                  <input type="file" class="form-control" id="file_representante" name="file_representante" value="{{old('file_representante')}}" required>
                </div>
                <hr>

                <button type="submit" class="btn btn-danger btn-user btn-block">
                  Registrar Cuenta
                </button>
                
              </form>
              <hr>
              @if (Route::has('password.request'))
              <div class="text-center">
                <a class="small" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
              </div>
              @endif
              <div class="text-center">
                <a class="small" href="{{ route('login') }}">¿Ya tienes una cuenta? ¡Iniciar sesión!</a>
              </div>
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
  </script>

</body>

</html>
