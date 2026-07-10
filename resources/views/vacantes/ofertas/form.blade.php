
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre_empresa_dependencia">Nombre empresa o dependencia</label>
            <input type="text" name="nombre_empresa_dependencia" class="form-control" value="@if(isset($oferta)){{$oferta->nombre_empresa_dependencia}}@else{{old('nombre_empresa_dependencia')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre_oferta">Nombre Oferta</label>
            <input type="text" name="nombre_oferta" class="form-control" value="@if(isset($oferta)){{$oferta->nombre_oferta}}@else{{old('nombre_oferta')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" name="cargo" class="form-control" value="@if(isset($oferta)){{$oferta->cargo}}@else{{old('cargo')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="funciones">Descripción de funciones</label>
            <textarea class="form-control" name="funciones" id="funciones" required>
                @if(isset($oferta)){{$oferta->funciones}}@else{{old('funciones')}}@endif
            </textarea>
        </div>    
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="tipo_oferta">Tipo Oferta</label>
            <select  class ="form-control" name="tipo_oferta" id="tipo_oferta" type="text" required>
                <option value="">Seleccione un tipo de oferta</option>
                @foreach($item_tipos_oferta as $tipo)
                    <option value="{{$tipo->id}}"  data-name="{{$tipo->nombre}}" @if((isset($oferta->tipoOferta) && $oferta->tipoOferta->id === $tipo->id) || (old('tipo_oferta') === $tipo->id) ) selected @endif  required>{{$tipo->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12" id="tipo_contrato" style="display: none;">
        <div class="form-group">
            <label for="tipo_contrato">Tipo de Contrato</label>
            <select  class ="form-control" name="tipo_contrato" type="text">
                @foreach($item_tipos_contrato as $tipo)
                    <option value="{{$tipo->id}}" @if((isset($oferta->tipoContratacion) && $oferta->tipoContratacion->id === $tipo->id) || (old('tipo_contrato') === $tipo->id) ) selected @endif  required>{{$tipo->nombre}}</option>                 
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="salario">Salario</label>
            <input type="text" name="salario" class="form-control" value="@if(isset($oferta)){{$oferta->salario}}@else{{old('salario')}}@endif">
        </div>
    </div>
    
    
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="duracion_meses">Duración en meses</label>
                    <input type="number" name="duracion_meses" class="form-control" value="@if(isset($oferta)){{$oferta->duracion_meses}}@else{{old('duracion_meses')}}@endif">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="cantidad">Cantidad de vacantes</label>
                    <input type="number" name="cantidad" class="form-control" value="@if(isset($oferta)){{$oferta->cantidad}}@else{{old('cantidad')}}@endif">
                </div>
            </div>   
        </div>
    </div>

    
    <div class="col-md-12" id="tipo_dependencia">
        <div class="form-group">
            <label for="dependencia_id">Dependencias</label>
            <select  class ="form-control" name="dependencia_id" type="text">
                <option value="">Selecione una dependencia</option>
                @foreach($dependencias as $dependencia)
                    <option value="{{$dependencia->id}}" @if((isset($oferta->dependencia) && $oferta->dependencia->id === $dependencia->id) || (old('dependencia_id') === $dependencia->id) ) selected @endif  required>{{$dependencia->nombre}}</option>                 
                @endforeach
            </select>
        </div>
    </div>

    
    <div class="col-md-12">
        <div class="form-group">
            <label for="fecha_cierre_vacante">Fecha cierre vacante</label>
            <input   class="form-control"                 
                type="date"
                name="fecha_cierre_vacante"
                @if(isset($oferta)) value="{{ optional($oferta->fecha_cierre_vacante)->format('Y-m-d') }}" @endif
                required>
        </div>
    </div>
    
</div>


@section('script')
<script>
    $( "#tipo_oferta" ).change(function() {
        
        if($(this).find(':selected').data('name') == "Laborales"){
            $("#tipo_contrato").css({display: "block"});
            $("#tipo_dependencia").css({display: "none"});
        }else{
            $("#tipo_contrato").css({display: "none"});
            $("#tipo_dependencia").css({display: "block"});
        }
    });
</script>
@stop