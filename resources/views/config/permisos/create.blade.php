@extends('dashboard')
@section('title_dashboard','Crear Permiso')
@section('breadcrumbs')
    {{ Breadcrumbs::render('permisos.create') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Permisos</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('permisos.store')}}">
                <div class="col-md-12">
                    <fieldset>
                        <legend>Datos Permiso</legend>
                        @include('config.permisos.form')
                    </fieldset>
                </div>

                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                        <!--<button type="reset" class="btn btn-default"><i class="fa fa-file-o"></i> Limpiar</button>-->
                        <a href="{{route('permisos.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop