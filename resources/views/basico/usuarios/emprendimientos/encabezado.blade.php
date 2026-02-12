<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Detalle usuario</h6>
    </div>
    <div class="card-body">
        <form>
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" disabled value="@if(isset($usuario) ) {{$usuario->name}} @else {{ old('name') }} @endif">                        
                        <input type="hidden" name="user_id" id="user_id" value="@if(isset($usuario) ) {{$usuario->id}} @endif">                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>