
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="@if(isset($tipomaestroitem)){{$tipomaestroitem->nombre}}@else{{old('nombre')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="numitem">NUM ITEM:</label>
            <input type="number" class="form-control" name="numitem" id="numitem" min="1" max="10" value="@if(isset($tipomaestroitem)){{$tipomaestroitem->numitem}}@else{{old('numitem')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="observacion">OBSERVACIÓN:</label>
            <textarea class="form-control" name="observacion" id="observacion" required>
                @if(isset($tipomaestroitem)){{$tipomaestroitem->observacion}}@else{{old('observacion')}}@endif
            </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="tipomaestro_id">TIPO MAESTRO:</label>
            <select class="form-control" name="tipomaestro_id" id="tipomaestro_id" required>
                <option value="">Seleccione un tipo maestro</option>
                @foreach($tiposmaestro as $tipo)
                    <option value="{{$tipo->id}}" @if(isset($tipomaestroitem) && $tipomaestroitem->tipomaestro_id == $tipo->id) selected @endif>{{$tipo->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">ESTADO:</label>
            <select class="form-control" name="estado" id="estado" required>
                <option value="1" @if(isset($tipomaestroitem) && $tipomaestroitem->estado == '1') selected @endif>ACTIVO</option>
                <option value="0" @if(isset($tipomaestroitem) && $tipomaestroitem->estado == '0') selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>
</div>