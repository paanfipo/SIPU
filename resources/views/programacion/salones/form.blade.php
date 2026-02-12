{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="numero">NÚMERO SAl&Oacute;N:</label>
            <input type="text" class="form-control" name="numero" id="numero" placeholder="Número" value="@if(isset($salon)){{$salon->numero}}@else{{old('numero')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="capacidad">CAPACIDAD:</label>
            <input type="number" class="form-control" name="capacidad" id="capacidad" min="1" max="100" value="@if(isset($salon)){{$salon->capacidad}}@else{{old('capacidad')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="universidad">SALÓN DE:</label>
            
            <select class="form-control" name="universidad" id="universidad" required>
                <option value="">Seleccione universidad</option>
                @foreach($universidad as $tipo)
                    <option value="{{$tipo->id}}" @if(isset($salon->universidadDetalle) && $salon->universidadDetalle->id == $tipo->id) selected @endif>{{$tipo->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="observacion">OBSERVACIÓN:</label>
            <textarea class="form-control" name="observacion" id="observacion" required>
                @if(isset($salon))
                    {{$salon->observacion}}
                @else
                    {{old('observacion')}}
                @endif
            </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">ESTADO:</label>
            <select class="form-control" name="estado" id="estado" required>
                <option value="1" @if(isset($salon) && ($salon->getOriginal('estado') == 1)) selected @endif>ACTIVO</option>
                <option value="0" @if(isset($salon) && ($salon->getOriginal('estado') == 0)) selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>
    
</div>