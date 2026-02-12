
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">NOMBRE</label>
            <input type="text" name="name" class="form-control" value="@if(isset($paquete)){{$paquete->name}}@else{{old('name')}}@endif" required>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="icon">ICONO</label>
            <input type="text" name="icon" class="form-control" value="@if(isset($paquete)){{$paquete->icon}}@else{{old('icon')}}@endif" required>

        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="state">ESTADO</label>
            <select class="form-control" name="state" id="state" required>
                <option value="1" @if(isset($paquete) && $paquete->getOriginal('state') == '1') selected @endif>ACTIVO</option>
                <option value="0" @if(isset($paquete) && $paquete->getOriginal('state') == '0') selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="observation">OBSERVACIÓN</label>
            <textarea class="form-control" id="observation" name="observation" rows="5" cols="100" required>@if(isset($paquete)){{$paquete->observation}}@else{{old('observation')}}@endif</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="url">RUTA</label>
            <input type="text" name="url" class="form-control" value="@if(isset($paquete)){{$paquete->url}}@else{{old('url')}}@endif" @if(isset($paquete)) disabled @endif required>
        </div>
    </div>
</div>
