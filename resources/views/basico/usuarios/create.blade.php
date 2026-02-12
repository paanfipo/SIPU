@extends('dashboard')
@section('title_dashboard','Crear Usuario')
@section('breadcrumbs')
    {{ Breadcrumbs::render('usuarios.create') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Usuario</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('usuarios.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    @include('basico.usuarios.form')
                </div>
                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                        <!--<button type="reset" class="btn btn-default"><i class="fa fa-file-o"></i> Limpiar</button>-->
                        <a href="{{route('usuarios.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection