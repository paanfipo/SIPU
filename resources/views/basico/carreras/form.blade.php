
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="@if(isset($carrera)){{$carrera->nombre}}@else{{old('nombre')}}@endif">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo" class="form-control" value="@if(isset($carrera)){{$carrera->codigo}}@else{{old('codigo')}}@endif" @if($readonly) readonly @endif>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="@if(isset($carrera)){{$carrera->email}}@else{{old('email')}}@endif" required>
        </div>
    </div>
</div>
