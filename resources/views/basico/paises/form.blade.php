
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Name" value="@if(isset($pais)){{$pais->nombre}}@else{{old('nombre')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="codigo_dane">CODIGO DANE:</label>
            <input type="text" class="form-control" name="codigo_dane" id="codigo_dane" placeholder="Name" value="@if(isset($pais)){{$pais->codigo_dane}}@else{{old('codigo_dane')}}@endif" @if($readonly) readonly @endif>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="codigo_iso">CODIGO ISO:</label>
            <input type="text" class="form-control" name="codigo_iso" id="codigo_iso" placeholder="Name" value="@if(isset($pais)){{$pais->codigo_iso}}@else{{old('codigo_iso')}}@endif" @if($readonly) readonly @endif>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">ESTADO:</label>
            <select class="form-control" name="estado" id="estado" required>
                <option value="1" @if(isset($pais) && $pais->estado == '1') selected @endif>ACTIVO</option>
                <option value="0" @if(isset($pais) && $pais->estado == '0') selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>
</div>