@section('style')
<style>
    input[type="checkbox"] {
        display: none;
    }
    
    label:before {
        background: linear-gradient(to bottom, #fff 0px, #e6e6e6 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        border: 1px solid #035f8f;
        height: 16px;
        width: 16px;
        display: block;
        cursor: pointer;
    }
    input[type="checkbox"] + label:before {
        content: '';
        background: linear-gradient(to bottom, #e6e6e6 0px, #fff 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        border-color: #3d9000;
        color: #96be0a;
        font-size: 18px;
        line-height: 15px;
        text-align: center;
    }
    
    input[type="checkbox"]:disabled + label:before {
        border-color: #eee;
        color: #ccc;
        background: linear-gradient(to top, #e6e6e6 0px, #fff 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
    }
    
    input[type="checkbox"]:checked + label:before {
        content: '✓';
    }
</style>
@stop
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
                    <div id="collapse_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" class="collapse" aria-labelledby="headingOne_{{str_replace("(","",str_replace(")","",str_replace(" ","",$etapa->nombre)))}}" data-parent="#accordion" style="padding: 25px 50px 75px 100px;">                    
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
                                    $cronograma = null;
                                    $cronograma = $actividad->cronogramaConvocatoria($convocatoria->id);
                                @endphp
                                <div class="card-header" id="actividad{{$actividad->id}}">
                                    <h5 class="mb-0">
                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_actividad{{$actividad->id}}" aria-expanded="true" aria-controls="collapseOne">
                                            {{$actividad->nombre}}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseOne_actividad{{$actividad->id}}" class="collapse" aria-labelledby="actividad{{$actividad->id}}" data-parent="#accordion_actividad">
                                    @if($cronograma !== null)
                                        <div class="col-md-12">                                            
                                            @if($actividad->personalizacion === 1)
                                                <div class="card-body">
                                                    <h5 class="card-title">Actividad Personalizada</h5>
                                                    <p class="card-text">Descripción: {{$actividad->descripcion}}</p>                                                
                                                </div>
                                                <hr>
                                            @else
                                                @include('emprendimiento.asistencia.cronograma')
                                            @endif                                            
                                        </div>   
                                        <div class="col-md-12">
                                            <div class="card-header" id="asistencia{{$cronograma->id}}">
                                                <h5 class="mb-0">
                                                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_asistencia{{$cronograma->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                        Lista de asistencia
                                                    </a>
                                                    @if(count($cronograma->asistencias) === 0)
                                                        <button type="button" class="btn btn-primary float-right" onclick="generarAsistencia({{$convocatoria->id}},{{$etapa->id}},{{$actividad->id}},{{$cronograma->id}})">Generar Asistencia</button>                                                    
                                                    @endif
                                                </h5>
                                            </div>
                                            <div id="collapseOne_asistencia{{$cronograma->id}}" class="collapse" aria-labelledby="asistencia{{$actividad->id}}">                                                
                                                
                                                <div class="col-md-12">
                                                    <br>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="permisos" id="reset_asistencia_{{$cronograma->id}}" value="option1" onchange="resetAsistencia({{$cronograma->id}})">
                                                        <label class="form-check-label" for="reset_asistencia_{{$cronograma->id}}">
                                                            Reset  Listado
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="permisos" id="select_all_asistencia_{{$cronograma->id}}" value="option2" onchange="selectAllAsistencia({{$cronograma->id}})">
                                                        <label class="form-check-label" for="select_all_asistencia_{{$cronograma->id}}">
                                                            Seleccionar todo el listado
                                                        </label>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-primary float-right" id="enviar_{{$cronograma->id}}" onclick="enviarAllAsistencia({{$cronograma->id}},{{$convocatoria->id}},{{$etapa->id}})">Registrar todo el listado</button>
                                                    <br>
                                                    <br>
                                                </div>  
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php 
                                                            $asistencias = DB::table('asistencia')->select("asistencia.*","users.name")                                                                                           
                                                                                        ->join('cronogramas', 'cronogramas.id', '=', 'asistencia.cronograma_id')
                                                                                        ->join('users', 'users.id', '=', 'asistencia.user_id')
                                                                                        ->where('asistencia.cronograma_id',$cronograma->id)
                                                                                        ->orderBy('users.name','asc')
                                                                                        ->get();
                                                        @endphp
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-striped">
                                                                            <thead></thead>
                                                                            <tbody>
                                                                                @foreach($asistencias as $asistencia)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="col-md-12">
                                                                                                <input type="checkbox" class="radio_{{$asistencia->cronograma_id}}" value="{{$asistencia->asistencia}}" id="asistencia_{{$asistencia->id}}" @if($asistencia->asistencia) disabled checked @endif onchange="enviarAsistencia({{$asistencia->id}},{{$convocatoria->id}},{{$etapa->id}})" />    
                                                                                                <label for="asistencia_{{$asistencia->id}}">{{$asistencia->name}}</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            @if($etapa->nombre === 'SENSIBILIZACIÓN')
                                                                                                <div class="col-md-12">
                                                                                                    @php 
                                                                                                        $etapaAvanceUsuario = $convocatoria->etapaAvanceUsuario()->wherePivot('user_id', $asistencia->user_id)->get();  
                                                                                                    @endphp
                                                                                                    @foreach($etapaAvanceUsuario as $etapaCarac)
                                                                                                        @if($etapaCarac->nombre == 'SENSIBILIZACIÓN')
                                                                                                        @php 
                                                                                                            $variablex = [$etapaCarac->pivot->caracterizacion,$convocatoria->id,$etapaCarac->id,$actividad->id,$asistencia->user_id,$cronograma->id]; 
                                                                                                        @endphp
                                                                                                        <!--<span>{{var_dump($variablex)}}</span>-->
                                                                                                                
                                                                                                            @if($etapaCarac->pivot->caracterizacion == 0)
                                                                                                                <a href="{{route('asistencia.caracterizacion_sensibilizacion',[$convocatoria->id,$asistencia->user_id])}}" target="_blank"><i class="far fa-thumbs-down fa-2x"></i>Formulario caracterización para pasar de sensibilización a preincubación</a>                                                                                                                                                                   
                                                                                                            @endif

                                                                                                            @if($etapaCarac->pivot->caracterizacion == 1)
                                                                                                                <a href="{{route('asistencia.caracterizacion_sensibilizacion',[$convocatoria->id,$asistencia->user_id])}}" target="_blank"><i class="fas fa-thumbs-up fa-2x"></i>Formulario caracterización para pasar de sensibilización a preincubación</a>
                                                                                                            @endif

                                                                                                        @endif
                                                                                                        
                                                                                                    @endforeach                                                                           
                                                                                                </div> 
                                                                                            @endif                                                                   
                                                                                            @if($etapa->nombre === 'INCUBACIÓN (ASESORIAS)')
                                                                                                <div class="col-md-12">
                                                                                                    @php 
                                                                                                        $etapaAvanceUsuario = $convocatoria->etapaAvanceUsuario()->wherePivot('user_id', $asistencia->user_id)->get();  
                                                                                                    @endphp

                                                                                                    @foreach($etapaAvanceUsuario as $etapaCarac)                                                                                

                                                                                                        @if($etapaCarac->nombre == 'INCUBACIÓN (ASESORIAS)')

                                                                                                            @if($etapaCarac->pivot->caracterizacion == 0)
                                                                                                                <a href="{{route('asistencia.caracterizacion_empresarial',[$convocatoria->id,$asistencia->user_id])}}" target="_blank"><i class="far fa-thumbs-down fa-2x"></i>Formulario caracterización para pasar de incubación a aceleración</a>                                                                                                                                                                   
                                                                                                            @endif

                                                                                                            @if($etapaCarac->pivot->caracterizacion == 1)
                                                                                                                <a href="{{route('asistencia.caracterizacion_empresarial',[$convocatoria->id,$asistencia->user_id])}}" target="_blank"><i class="fas fa-thumbs-up fa-2x"></i>Formulario caracterización para pasar de incubación a aceleración</a>
                                                                                                            @endif

                                                                                                        @endif
                                                                                                        
                                                                                                    @endforeach

                                                                                                </div> 
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            @if($actividad->personalizacion && $asistencia->asesor == null)
                                                                                                <div class="col-md-12" id="asistencia_asesor_{{$asistencia->id}}">
                                                                                                    <button type="button" class="btn btn-primary float-right" id="button_asistencia_{{$asistencia->id}}" onclick="listarAsesores({{$asistencia->id}})" ><i class="fas fa-user-tie">Asesor</i></button>                                                                            
                                                                                                </div>
                                                                                            @else
                                                                                                @if($asistencia->asesor != null)
                                                                                                    @php
                                                                                                        $asesor = DB::table('users')->select("users.name")
                                                                                                                        ->where('users.id',$asistencia->asesor)
                                                                                                                        ->first();
                                                                                                        @endphp
                                                                                                    <div class="col-md-12" id="asistencia_asesor_{{$asistencia->id}}">
                                                                                                        <p>@if($asesor !== null) {{$asesor->name}} @endif</p>
                                                                                                    </div>
                                                                                                @endif
                                                                                                
                                                                                            @endif       
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                            </table>
                                                        </div>
                                                    </div> 
                                                </div>                                                    
                                            </div>                                      
                                        </div>
                                    @endif                                 
                                </div>
                            @endforeach
                        </div>
                    </div>   
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Asesores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
            <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <select class="form-control" id="asesor">
                    <option value="">Seleccione un asesor</option>
                    @foreach($asesores as $asesor)
                        <option value="{{$asesor->id}}">{{$asesor->name}}</option>
                    @endforeach
                </select>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="seleccionarAsesor">Guardar</button>
            <input type="hidden" id="asistencia" value="">            
        </div>
        </div>
    </div>
</div>

@section('script')
<script>

    function enviarAllAsistencia(cronograma,convocatoria,etapa){
        selectAllAsistencia(cronograma);
        $.ajax({
            type: 'POST',
            url: '{{ route("asistencia.setAjaxAllAsistencia") }}',      
            data: { 
                    cronograma: cronograma,
                    convocatoria: convocatoria,
                    etapa: etapa
                    },
            dataType: 'json',
            success: function(data){
                console.log(data.data);
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

    function resetAsistencia(cronograma){
        $('.radio_'+cronograma).attr('checked',false);
    }
    function selectAllAsistencia(cronograma){
        $('.radio_'+cronograma).attr('checked',true);
    }

    function enviarAsistencia(asistencia,convocatoria,etapa){

        var seleccionado = false;
        if( $('#asistencia_'+asistencia).prop('checked') ) {
            seleccionado = true;
           $('#asistencia_'+asistencia).prop('disabled',true);
        }else{
            $('#asistencia_'+asistencia).prop('disabled',false);
        }

        $.ajax({
            type: 'POST',
            url: '{{ route("asistencia.setAjaxAsistencia") }}',      
            data: { 
                    asistencia_id: asistencia,
                    asistencia: seleccionado,
                    convocatoria: convocatoria,
                    etapa: etapa
                    },
            dataType: 'json',
            success: function(data){
                console.log(data);

                if(data.bandera_avance_sensibilizacion == false || data.bandera_avance_incubacion == false){

                    $('#asistencia_'+asistencia).prop('checked',false); 
                    $('#asistencia_'+asistencia).prop('disabled',false);

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe llenar el formulario de caracterización para registrar la asistencia!'
                    });

                }else{

                    Swal.fire({
                        title: 'Info!',
                        icon: data.type,                    
                        text: data.message,
                        confirmButtonText: `Ok`,
                    }).then((result) => {  
                        if(data.bandera_avance){
                            window.location.reload();
                        }                  
                    });
                    
                }
                

            },
            error: function(data) {
                console.log('ERROR AJAX: '+data);
            }
        });

    }

    function generarAsistencia(convocatoria,etapa,actividad,cronograma){

        $.ajax({
            type: 'POST',
            url: '{{ route("asistencia.generarAsistencia") }}',      
            data: { 
                    convocatoria: convocatoria,
                    etapa: etapa,
                    actividad: actividad,
                    cronograma: cronograma
                    },
            dataType: 'json',
            success: function(data){
                console.log(data);
                if(data.type == 'error'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: data.message
                    });
                }else{
                    Swal.fire({
                        title: 'Info!',
                        icon: data.type,                    
                        text: data.message,
                        confirmButtonText: `Ok`,
                    }).then((result) => {  
                            window.location.reload();
                    });                   
                }                

            },
            error: function(data) {
                console.log('ERROR AJAX: '+data);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: (data.responseJSON && data.responseJSON.message) ? data.responseJSON.message : 'No se pudo generar la asistencia.'
                });
            }
        });
    }

    function stringPermutations(str){
        return getPermutations(str);
            array =  removeDuplicates(array);
        return array.sort();
    }

    function getPermutations(str){
        var permutations = [];
            nextWord = [];
            chars = [];

            if(typeof str === 'string') chars = str.split('');
            else if (typeof str === 'number'){
                str = str + "";
                chars = str.split('');
            }

            permutate(chars)

            return permutations;

            function permutate(chars){
                if (chars.length === 0) permutations.push(nextWord.join(''));
                for(var i=0; i< chars.length; i++){
                    chars.push(chars.shift());
                    nextWord.push(chars[0]);
                    permutate(chars.slice(1));
                    nextWord.pop();
                }
            }
    }

    removeDuplicates = array => array.filter((item, index) => array.indexOf(item) == index);

    let freq = {}
    const mostFrequentSum = (t) => {
        const getAllSums = (tree) => {
            if(!tree){
                return 0
            }

            const sum = getAllSums(tree.left) + getAllSums(tree.right) + tree.value
            freq[sum] = (freq[sum] || 0) + 1
            return sum
        }

        getAllSums(t);
        const maxFreq = Object.values(freq).reduce((mx,cur) => Math.max(mx,cur),0)
        return Object.keys(freq)
                    .filter(key => freq[key]=== maxFreq)
                    .map(key => parseInt(key))
                    .sort((a,b) => a - b)
    }

    const nextLarger = (a) => {
        const res = [];

        for(let i = 0; i< a.length; i++){
            let currNum = a[i];
            for(let n = i; n< a.length; n++){
                if(a[n] > currNum){
                    res.push(a[n]);
                    break
                } else if(n === a.length - 1){
                    res.push(-1);
                }
            }
        }

        return res
    }

    function makeArrayConsecutive2(statues){
        var sorted = statues.sort((a,b) => a - b)
        var full = sorted[sorted.length - 1] - sorted[0] + 1
        return full - sorted.length
    }

    function listarAsesores(asistencia){
        $("#asistencia").val(asistencia);
        $("#exampleModal").modal("show");
    }
    
    $( document ).ready(function() {
        var t = { "value": 1, "left": { "value": 2, "left": null, "right": null }, "right": { "value": 3, "left": null, "right": null } };

        console.log(makeArrayConsecutive2([6, 2, 3, 8]));

        $( "#seleccionarAsesor" ).click(function() {
                    
            var asistencia = $("#asistencia").val(); 
            var asesor = $("#asesor").val();               

            if(asistencia != "" && asesor != ""){
                $.ajax({
                        type: 'POST',
                        url: '{{ route("asistencia.ajaxSetAsesor") }}',            
                        data: {  
                                "_token": "{{ csrf_token() }}",
                                "asistencia": asistencia,
                                "asesor": asesor,
                            },
                        dataType: 'json',
                        success: function(data){                          
                            
                            if(data.type == 'error'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'comuníquese con soporte!'
                                });
                            }else{
                                $("#asistencia").val("");
                                $("#asesor").val("");
                                $("#exampleModal").modal("hide");

                                $("#asistencia_asesor_"+asistencia).html("<p>"+data.asesor+"</p>");
                                $("#button_asistencia_"+asistencia).remove();

                                Swal.fire({
                                    icon: 'info',
                                    title: 'Oops...',
                                    text: 'El asesor fue asignado con exito!'
                                });
                            }
                            

                        },
                        error: function(data) {
                            console.log('ERROR AJAX: '+data);
                        }
            
                    });

            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe seleccionar un asesor!'
                });
            }
        });
    });

</script>
@stop
