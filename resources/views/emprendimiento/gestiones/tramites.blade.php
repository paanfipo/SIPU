@extends('dashboard')
@section('title_dashboard','Gestionar Tramites')
@section('breadcrumbs')
    {{ Breadcrumbs::render('gestiones.tramites',$convocatoria) }}
@endsection
@section('content')
@include('emprendimiento.gestiones.encabezado')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Tramites</h6>
    </div>
    <div class="card-body">
        <form>
            <div class="col-md-12">                   
                @include('emprendimiento.gestiones.form')                  
            </div>

            <div class="col-md-12">
                <br>
                <br>                
                <div class="box-footer">
                    <a href="{{route('gestiones.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop