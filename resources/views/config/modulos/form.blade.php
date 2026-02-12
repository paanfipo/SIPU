
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">NOMBRE</label>
            <input type="text" name="name" class="form-control" value="@if(isset($modulo)){{$modulo->name}}@else{{old('name')}}@endif">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="icon">ICONO</label>
            <input type="text" name="icon" class="form-control" value="@if(isset($modulo)){{$modulo->icon}}@else{{old('icon')}}@endif">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="state">ESTADO</label>
            <select class="form-control" name="state" id="state">
                <option value="1" @if(isset($modulo) && $modulo->state == '1') selected @endif>ACTIVO</option>
                <option value="0" @if(isset($modulo) && $modulo->state == '0') selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="paquete_id">PAQUETES</label>
            <select class="form-control" name="paquete_id" id="paquete_id">
                <option value="">Seleccione un paquete</option>
                @foreach($paquetes as $paquete)
                    <option value="{{$paquete->id}}" @if(isset($modulo) && $modulo->paquete->id == $paquete->id) selected @endif>{{$paquete->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="observation">OBSERVACIÓN</label>
            <textarea class="form-control" id="observation" name="observation" rows="5" cols="100">@if(isset($modulo)){{$modulo->observation}}@else{{old('observation')}}@endif</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="url">RUTA</label>
            <input type="text" name="url" class="form-control" value="@if(isset($modulo)){{$modulo->url}}@else{{old('url')}}@endif">
        </div>
    </div>
</div>
