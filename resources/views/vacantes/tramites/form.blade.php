
{{ csrf_field() }}
<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre_empresa_dependencia">Nombre empresa o dependencia</label>
            <input type="text" name="nombre_empresa_dependencia" class="form-control" value="{{$tramite->nombre_empresa_dependencia}}" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="tipo_oferta">Tipo de oferta</label>
            <input type="text" name="tipo_oferta" class="form-control" value="{{$tramite->tipoOferta->nombre}}" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre_oferta">Nombre Oferta</label>
            <input type="text" name="nombre_oferta" class="form-control" value="{{$nombre}}" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="fecha">Fecha Creación</label>
            <input type="text" name="fecha" class="form-control" value="{{$tramite->created_at}}" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="fecha_cierre_vacante">Fecha Cierre</label>
            <input type="text" name="fecha_cierre_vacante" class="form-control" value="{{ optional($tramite->fecha_cierre_vacante)->format('Y-m-d') }}" required>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{$estado}}" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="fase">Fase</label>
            <input type="text" name="nombre_oferta" class="form-control" value="{{$fase}}" required>
        </div>
    </div>
    
    
</div>
