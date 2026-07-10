@extends('dashboard')
@section('title_dashboard','Litado de emprendimientos')
@section('breadcrumbs')
    {{ Breadcrumbs::render('listar.emprendimiento',$usuario) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    @include('basico.usuarios.emprendimientos.encabezado')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="pull-right">
                @if(auth()->user()->can('Crear Emprendimiento') || auth()->user()->hasAnyRole(['Asesor','Coordinador de emprendimiento']))
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus"></i>  Crear Emprendimiento</button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de actualización</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emprendimientos as $empre)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$empre->nombre}}</td>
                            <td>{{$empre->descripcion}}</td>
                            <td>{{$empre->created_at}}</td>
                            <td>{{$empre->updated_at}}</td>
                            <td> <button class='btn btn-danger' onclick="updateEmprendimiento({{$empre->id}})"><i class='fas fa-edit'></i></a></td>
                        </tr>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vacante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="nombre" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="form-group">
            <label for="descripcion" class="col-form-label">Descripción:</label>
            <textarea class="form-control" id="descripcion"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="guardarEmprendimiento">Guardar</button>
        <input type="hidden" id="emprendimiento_id" value="">
        
      </div>
    </div>
  </div>
</div>

@stop

@section('script')

<script>
    function reload(){
        location.reload();
    }

    function updateEmprendimiento(emprendimiento_id){

        $.ajax({
            type: 'POST',
            url: '{{ route("emprendimiento.ajaxGetEmprendimiento") }}',            
            data: {  
                    "_token": "{{ csrf_token() }}",
                    "emprendimiento_id": emprendimiento_id
                  },
            dataType: 'json',
            success: function(data){
               console.log(data.data.id);

               $("#nombre").val(data.data.nombre);
               $("#descripcion").val(data.data.descripcion);
               $("#emprendimiento_id").val(data.data.id);

               $("#exampleModal").modal("show");

            },
            error: function(data) {
                console.log('ERROR AJAX: '+data);
            }

        });

    }
    $(document).ready( function () {
      
        $( "#guardarEmprendimiento" ).click(function() {
                    
            var nombre = $("#nombre").val();                    
            var user_id = $("#user_id").val();                    

            if(nombre != "" && user_id != ""){

                var descripcion = $("#descripcion").val();
                var emprendimiento_id = $("#emprendimiento_id").val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("emprendimiento.ajaxGuardarEmprendimiento") }}',            
                    data: {  
                            "_token": "{{ csrf_token() }}",
                            "nombre": nombre,
                            "descripcion": descripcion,
                            "user_id": user_id,
                            "emprendimiento_id": emprendimiento_id,
                          },
                    dataType: 'json',
                    success: function(data){

                        $("#nombre").val("");  
                        $("#descripcion").val(""); 
                        $("#emprendimiento_id").val("");    
                        
                       Swal.fire({
                            title: data.message,
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: `Ok`,
                            denyButtonText: `Cancelar`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            console.log(result);
                            if (result.value) {
                                location.reload();
                            } else if (result.dismiss == "cancel") {
                                location.reload();
                            }
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
                    text: 'Debe ingresar el nombre del emprendimiento por lo menos!'
                });
            }
        });

    });
</script>

@stop
