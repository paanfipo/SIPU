
{{ csrf_field() }}
<fieldset>
    @if(isset($emprendimiento))
        <legend>Actualizar Emprendimiento</legend>
    @else
        <legend>Registrar Emprendimiento</legend>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required value="@if(isset($emprendimiento) ) {{$emprendimiento->nombre}} @else {{ old('nombre') }} @endif">
            </div>
        </div>  
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Descripción:</label>
                <textarea class="form-control" name="descripcion">
                    @if(isset($emprendimiento) ) {{$emprendimiento->descripcion}} @else {{ old('descripcion') }} @endif
                </textarea>
            </div>
        </div>       

    </div>
</fieldset>


