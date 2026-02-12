
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="@if(isset($banco)){{$banco->name}}@else{{old('name')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="codigo_dane">NIT:</label>
            <input type="text" class="form-control" name="nit" id="nit" placeholder="Name" value="@if(isset($banco)){{$banco->nit}}@else{{old('nit')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">ESTADO:</label>
            <select class="form-control" name="state" id="state" required>
                <option value="1" @if(isset($banco) && $banco->state == '1') selected @endif>ACTIVO</option>
                <option value="0" @if(isset($banco) && $banco->state == '0') selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>
</div>