
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="@if(isset($central)){{$central->nombre}}@else{{old('nombre')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="ciudad_id">CIUDAD:</label>
            <select class="form-control" name="ciudad_id" id="ciudad_id" required>
                <option value="">Selecione una ciudad</option>
                @foreach($ciudades as $ciudad)
                    <option value="{{$ciudad->id}}" @if(isset($central) && $central->ciudad->id == $ciudad->id) selected @endif>{{$ciudad->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>