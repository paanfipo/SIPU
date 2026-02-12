@extends('dashboard')
@section('title_dashboard','Detalle Central')
@section('breadcrumbs')
    {{ Breadcrumbs::render('centrales.update',$central) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Central</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('centrales.update',$central->id)}}">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <fieldset>
                        <legend>Actualizar Central</legend>
                        @include('basico.centrales.form')
                    </fieldset>
                </div>

                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Grabar</button>
                        <!--<button type="reset" class="btn btn-default"><i class="fa fa-file-o"></i> Limpiar</button>-->
                        <a href="{{route('centrales.index')}}" class="btn btn-primary pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection