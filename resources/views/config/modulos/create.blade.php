@extends('dashboard')
@section('title_dashboard','Crear Modulo')
@section('breadcrumbs')
    {{ Breadcrumbs::render('modulos.create') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Modulos</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('modulos.store')}}">
                <div class="col-md-12">
                    <fieldset>
                        <legend>Datos Modulo</legend>
                        @include('config.modulos.form')
                    </fieldset>
                </div>
                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                        <a href="{{route('modulos.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop