@extends('dashboard')
@section('style')
    <style>
        .bs-example{
            margin: 20px;
        }
        .accordion .fa{
            margin-right: 0.5rem;
        }
    </style>
@endsection

@section('title_dashboard','Detalle Rol')
@section('breadcrumbs')
    {{ Breadcrumbs::render('roles.update',$rol) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Roles</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('roles.update',$rol->id)}}">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <div class="col-md-12">
                        <fieldset @if(isset($disabled)){{$disabled}}@endif>
                            <legend>Datos Rol</legend>
                            @include('config.roles.form')
                        </fieldset>
                    </div>
                </div>

                <div class="col-md-12">

                    <br>
                    <div class="box-footer">
                    @if(!isset($disabled))
                        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Grabar</button>
                    @endif
                        <a href="{{route('roles.index')}}" class="btn btn-light pull-right"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function(){
                $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });

            $("#reset_permisos").change(function () {

                $('.radio').attr('checked',false);
            });

            $("#select_all_permisos").change(function () {

                $('.radio').attr('checked',true);
            });
        });
    </script>
@endsection
