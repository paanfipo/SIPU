
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="codigo">Codigo</label>
            <input type="number" id="codigo" name="codigo" class="form-control" onKeyDown="if(this.value.length==4) return false;" value="@if(isset($dependencia)){{$dependencia->codigo}}@else{{old('codigo')}}@endif" @if($readonly) readonly @endif>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">Nombre dependencia</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="@if(isset($dependencia)){{$dependencia->nombre}}@else{{old('nombre')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="sede">Nombre de la sede</label>
            <input type="text" id="sede" name="sede" class="form-control" value="@if(isset($dependencia)){{$dependencia->sede}}@else{{old('sede')}}@endif" >
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="@if(isset($dependencia)){{$dependencia->email}}@else{{old('email')}}@endif" >
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="encargado">Encargado</label>
            <select class="form-control" name="encargado" id="encargado">
                <option value="">Seleccione un encargado</option>
                @foreach($encargados as $encargado)
                    <option value="{{$encargado->id}}" @if(isset($dependencia->usuarioencargado) && $dependencia->usuarioencargado->id == $encargado->id) selected @endif>{{$encargado->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="encargado">Profesor de apoyo</label>
            <select class="form-control" name="profesor_apoyo" id="profesor_apoyo">
                <option value="">Seleccione un profesor de apoyo</option>
                @foreach($profesoresapoyo as $item)
                    <option value="{{$item->id}}" @if(isset($dependencia->profesordeapoyo) && $dependencia->profesordeapoyo->id == $item->id) selected @endif>{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

   
</div>
