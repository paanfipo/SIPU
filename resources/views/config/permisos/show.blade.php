@extends('dashboard')
@section('title_dashboard','Actualizar Permiso')
@section('breadcrumbs')
    {{ Breadcrumbs::render('permisos.update',$permiso) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Modulos</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('permisos.update',$permiso->id)}}">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <fieldset @if(isset($disabled)){{$disabled}}@endif>
                        <legend>Actualizar Permiso</legend>
                        @include('config.permisos.form')
                    </fieldset>
                </div>
                <div class="col-md-12">
                    <div class="box-footer">
                    @if(!isset($disabled))
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                    @endif
                        <a href="{{route('permisos.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop