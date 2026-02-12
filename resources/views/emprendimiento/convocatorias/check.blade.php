
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE:</label>
            <input type="text" readonly class="form-control" value="{{ Auth::user()->name }}" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="emprendimiento">Empredimientos :</label>
            <select class="form-control" id="emprendimiento" name="emprendimiento" >
                <option value="">Seleccione un emprendimiento</option>
                @foreach($emprendimientos as $emprendimiento)
                    <option value="{{$emprendimiento->id}}">{{$emprendimiento->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
