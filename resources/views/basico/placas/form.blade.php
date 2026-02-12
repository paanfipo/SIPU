
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="placa">PLACA</label>
            <input type="text" class="form-control" name="placa" id="placa" placeholder="Placa" value="@if(isset($placa)){{$placa->placa}}@else{{old('placa')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="state">ESTADO</label>
            <select class="form-control" name="estado" id="estado" required>
                <option value="1" @if(isset($placa) && $placa->estado == '1') selected @endif>ACTIVO</option>
                <option value="0" @if(isset($placa) && $placa->estado == '0') selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="obervacion">OBSERVACIÓN</label>
            <textarea class="form-control" id="obervacion" name="obervacion" rows="5" cols="100" required>@if(isset($placa)){{$placa->obervacion}}@else{{old('obervacion')}}@endif</textarea>
        </div>
    </div>

    @role('Administrador')

   <!-- <div class="col-md-12">
        <div class="form-group">
            <label for="estado">EMPRESAS:</label>
            <select class="form-control" name="empresa_id" id="empresa_id" required>
                <option value="">Selecione la empresa</option>
                @foreach($empresas as $empresa)
                    <option value="{{$empresa->id}}" @if(isset($placa) && $placa->empresa->id == $empresa->id) selected @endif>{{$empresa->usuariodatosterceroitem->empresa_nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">CONDUCTORES:</label>
            <select class="form-control" name="conductor_id" id="conductor_id" required>
                <option value="">Selecione la empresa</option>
                @foreach($conductores as $conductor)
                    <option value="{{$conductor->id}}" @if(isset($placa) && $placa->conductor->id == $conductor->id) selected @endif>{{$empresa->usuariodatosterceroitem->nombre1}}</option>
                @endforeach
            </select>
        </div>
    </div>-->

    @endrole
</div>