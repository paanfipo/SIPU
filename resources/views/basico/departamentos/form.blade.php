
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="@if(isset($departamento)){{$departamento->nombre}}@else{{old('nombre')}}@endif" @if($readonly) readonly @endif >
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="codigo_dane">CODIGO DANE:</label>
            <input type="text" class="form-control" name="codigo_dane" id="codigo_dane" placeholder="Codigo Dane" value="@if(isset($departamento)){{$departamento->codigo_dane}}@else{{old('codigo_dane')}}@endif" @if($readonly) readonly @endif >
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="observacion">OBSERVACIÓN:</label>
            <textarea class="form-control" name="observacion" id="observacion" required>
                @if(isset($departamento))
                    {{$departamento->observacion}}
                @else
                    {{old('observacion')}}
                @endif
            </textarea>

        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">PAÍS:</label>
            <select class="form-control" name="pais_id" id="pais_id" required>
                <option value="">Selecione un país</option>
                @foreach($paises as $pais)
                    <option value="{{$pais->id}}" @if(isset($departamento) && $departamento->pais->id == $pais->id) selected @endif>{{$pais->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">ESTADO:</label>
            <select class="form-control" name="estado" id="estado" required>
                <option value="1" @if(isset($departamento) && $departamento->estado == '1') selected @endif>ACTIVO</option>
                <option value="0" @if(isset($departamento) && $departamento->estado == '0') selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>
</div>