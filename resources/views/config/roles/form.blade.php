
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">NOMBRE:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required value="@if(isset($rol)){{$rol->name}}@endif">
        </div>
    </div>

    @if(isset($modulos))
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="permisos" id="reset_permisos" value="">
                <label class="form-check-label" for="reset_permisos">
                    Reset  Listado
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="permisos" id="select_all_permisos" value="">
                <label class="form-check-label" for="select_all_permisos">
                    Seleccionar todo el listado
                </label>
            </div>
            <br>
        </div>

        <div class="col-md-12">
            <div class="accordion" id="accordion">
                <label>MODULOS:</label>
                @foreach($modulos as $modulo)
                    <div class="card">
                        <div class="card-header" id="headingOne_{{str_replace(" ","",$modulo[0]->modulo->name)}}">
                            <h5 class="mb-0">
                                <a  class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{str_replace(" ","",$modulo[0]->modulo->name)}}" aria-expanded="true" aria-controls="collapse_{{str_replace(" ","",$modulo[0]->modulo->name)}}">
                                    <i class="fa fa-plus"></i>{{$modulo[0]->modulo->name}}
                                </a>
                            </h5>
                        </div>
                        @foreach($modulo as $permiso)
                            <div id="collapse_{{str_replace(" ","",$modulo[0]->modulo->name)}}" class="collapse" aria-labelledby="headingOne_{{str_replace(" ","",$modulo[0]->modulo->name)}}" data-parent="#accordion">
                                <div class="card-body">
                                    <label for="permiso_{{$permiso->id}}"><input type="checkbox" class="radio" value="{{$permiso->name}}" id="permiso_{{$permiso->id}}" name="permisos[]" @if($rol->hasPermissionTo($permiso->name)) checked @endif/>{{$permiso->name}}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
