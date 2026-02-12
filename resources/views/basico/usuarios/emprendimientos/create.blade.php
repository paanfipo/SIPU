@extends('dashboard')
@section('title_dashboard','Crear Emprendimiento')
@section('breadcrumbs')
    {{ Breadcrumbs::render('crear.emprendimiento',$usuario) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    @include('basico.usuarios.emprendimientos.encabezado')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Crear Emprendimiento</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('guardar.emprendimiento')}}">
                <div class="col-md-12">
                    @include('basico.usuarios.emprendimientos.form')
                </div>
                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                        <input type="hidden"  name="user_id" value="@if(isset($usuario) ) {{$usuario->id}} @endif">
                        <a href="{{route('listar.emprendimiento',$usuario->id)}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection