
{{ csrf_field() }}

<fieldset>
    <legend>Crear Maestros</legend>                        

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="@if(isset($tipomaestro)){{$tipomaestro->nombre}}@else{{old('nombre')}}@endif" @if($readonly)  readonly @endif >
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="observacion">OBSERVACIÓN:</label>
            <textarea class="form-control" name="observacion" id="observacion" required>
                @if(isset($tipomaestro)){{$tipomaestro->observacion}}@else{{old('observacion')}}@endif
            </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">ESTADO:</label>
            <select class="form-control" name="estado" id="estado" required>
                <option value="1" @if(isset($tipomaestro) && $tipomaestro->estado == '1') selected @endif>ACTIVO</option>
                <option value="0" @if(isset($tipomaestro) && $tipomaestro->estado == '0') selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>
</div>
</fieldset>

