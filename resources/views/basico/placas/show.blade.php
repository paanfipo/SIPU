@extends('dashboard')
@section('title_dashboard','Detalle Placa')
@section('breadcrumbs')
    {{ Breadcrumbs::render('placas.update',$placa) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Placas</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('placas.update',$placa->id)}}">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <fieldset>
                        <legend>Actualizar Placa</legend>
                        @include('basico.placas.form')
                    </fieldset>
                </div>

                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Grabar</button>
                        <a href="{{route('placas.index')}}" class="btn btn-primary pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection