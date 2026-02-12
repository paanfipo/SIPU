@extends('dashboard')
@section('title_dashboard','Detalle Asistencia')
@section('breadcrumbs')
    {{ Breadcrumbs::render('asistencias.update',$convocatoria) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    @include('emprendimiento.asistencia.encabezado')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Convocatoria</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="col-md-12">                   
                    @include('emprendimiento.asistencia.form')                  
                </div>
                <div class="col-md-12">
                    <br/>
                    <br/>                    
                    <div class="box-footer">
                        <a href="{{route('asistencias.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection