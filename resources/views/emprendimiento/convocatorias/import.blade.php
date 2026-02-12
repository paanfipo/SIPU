@extends('dashboard')
@section('title_dashboard','Regsitro Masivo')
@section('breadcrumbs')
    {{ Breadcrumbs::render('convocatorias.import', $convocatoria) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Registro Masivo!!</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('convocatoria.importRegistro')}}" enctype="multipart/form-data">
                @include('emprendimiento.convocatorias.encabezado')
                <div class="panel-header panel-header-sm">
                </div>
                {{ csrf_field() }}    
                <fieldset>    
                    <legend>Subir Archivo</legend>   
                    <hr/>             
                    <div class="row">
                        <div class="col-md-6"> 
                            <label for="photo" class="font-weight-bold">Archivo:</label>
                            <div class="input-group">                                        
                                <input class="form-control" type="file"  id="list" name="list" value="{{old('list')}}"  >
                            </div>                      
                        </div>
                        <div class="col-md-6">
                            <label for="descargar" class="font-weight-bold">Formato:</label>
                            <div class="input-group">  
                                <a href="{{route('convocatoria.downloadFileImport')}}" class="btn btn-large pull-right" id="descargar"><i class="fa fa-file-download fa-2x"> </i> Descargar Formato </a>
                            </div> 
                        </div>  
                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
                                                    
                    </div>   
                </fieldset>
                <div class="row">
                    <br>
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-file-upload"></i> Subir</button>                        
                        <a href="{{route('convocatorias.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
@stop