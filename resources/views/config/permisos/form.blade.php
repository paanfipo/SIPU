
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">NOMBRE</label>
            <input type="text" name="name" class="form-control" value="@if(isset($permiso)){{$permiso->name}}@else{{old('name')}}@endif" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="modulo_id">MODULOS</label>
            <select class="form-control" name="modulo_id" id="modulo_id" required>
                <option value="">Seleccione un modulo</option>
                @foreach($modulos as $modulo)
                    <option value="{{$modulo->id}}" @if(isset($permiso) && $permiso->modulo->id == $modulo->id) selected @endif>{{$modulo->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
