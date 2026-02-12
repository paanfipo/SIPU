
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">Nombre: *</label>
            <input type="text" name="nombre" class="form-control" value="@if(isset($actividad)){{$actividad->nombre}}@else{{old('nombre')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" cols="100">@if(isset($actividad)){{$actividad->descripcion}}@else{{old('descripcion')}}@endif</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true" name="personalizacion" @if(isset($actividad) && $actividad->personalizacion) checked @endif id="personalizacion">
                <label class="form-check-label" for="personalizacion">
                    ¿Personalización?
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">Etapas: *</label>
            <select class="form-control" name="etapa_id" id="etapa_id" required>
                <option value="">Selecione una etapa</option>
                @foreach($etapas as $etapa)
                    <option value="{{$etapa->id}}" @if(isset($actividad) && $actividad->etapa->id == $etapa->id) selected @endif>{{$etapa->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>
