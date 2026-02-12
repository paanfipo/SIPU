{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="codigo">CODIGO PROGRAMA:</label>
            <input type="number" class="form-control" name="codigo" id="codigo" placeholder="Codigo Programa" min="4" max="9999" value="@if(isset($programas)){{$programas->codigo}}@else{{old('codigo')}}@endif" required>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">NOMBRE PROGRAMA:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Programa" value="@if(isset($programas)){{$programas->nombre}}@else{{old('nombre')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="email">EMAIL PROGRAMA:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email Programa" value="@if(isset($programas)){{$programas->email}}@else{{old('email')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="email">ASIGNAR COORDINADOR:</label>
            <select class="form-control" name="coordinador_id" style="text-transform: uppercase;">
                @foreach($coordinador as $user)
                    @if(isset($programas->coordinador_id))
                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                    @else
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">ESTADO:</label>
            <select class="form-control" name="estado" id="estado" required>
                <option value="1" @if(isset($programas) && ($programas->getOriginal('estado') == 1)) selected @endif>ACTIVO</option>
                <option value="0" @if(isset($programas) && ($programas->getOriginal('estado') == 0)) selected @endif>INACTIVO</option>
            </select>
        </div>
    </div>
    
</div>