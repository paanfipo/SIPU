
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE</label>
            <input type="text" name="nombre" class="form-control" value="@if(isset($etapa)){{$etapa->nombre}}@else{{old('nombre')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" cols="100">@if(isset($etapa)){{$etapa->descripcion}}@else{{old('descripcion')}}@endif</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="state">Estado: </label>
            <select class="form-control" name="state" id="state" >
                <option value="1" @if( isset($etapa) && ($etapa->state == 1) ) selected @endif > Activo </option>
                <option value="0" @if( isset($etapa) && ($etapa->state == 0) ) selected @endif > Inactivo </option>                                                        
            </select>
        </div>
    </div>
</div>
