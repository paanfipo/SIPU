@extends('dashboard')
@section('title_dashboard','Registrarse')
@section('breadcrumbs')
    {{ Breadcrumbs::render('convocatoria.registrarse',$convocatoria->id) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Regístrate!!</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('convocatoria.checkin')}}">
                @include('emprendimiento.convocatorias.encabezado')
                <div class="col-md-12">
                    <fieldset>
                        <legend>Detalle Registro</legend>
                        @include('emprendimiento.convocatorias.check')
                    </fieldset>
                </div>
                <div class="col-md-12">
                    <div class="box-footer">
                        @if($checkin_on)
                            <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                        @endif
                        <a href="{{route('convocatorias.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop