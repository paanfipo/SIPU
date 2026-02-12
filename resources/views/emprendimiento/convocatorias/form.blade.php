
@section('styles')
    <style>
        .listEtapas .etapa.seleccionado {
            transform: scale(1.02) rotate(-1deg);
            box-shadow: 0px 0px 20px rgba(149, 153, 159, .16);
        }

        .listEtapas .etapa.fantasma {
            border: 2px dotted #000;
        }

        .listEtapas .etapa.drag {
            opacity: 0;
        }
    </style>
@stop
{{ csrf_field() }}
<div class="row">

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha inicio: *</label>
                    <input class="form-control" 
                                type="date"
                                id="fecha_inicio" 
                                name="fecha_inicio"
                                @if( isset($convocatoria)) value="{{$convocatoria->fecha_inicio->format('Y-m-d')}}" @endif 
                                 required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">            
                    <label for="fecha_fin">Fecha fin: *</label>
                   
                    <input class="form-control" 
                            type="date" 
                            id="fecha_fin" 
                            name="fecha_fin" 
                            @if( isset($convocatoria)) value="{{$convocatoria->fecha_fin->format('Y-m-d')}}" @endif 
                            required>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="nombre">Nombre: *</label>
            <input type="text" name="nombre" class="form-control" value="@if(isset($convocatoria)){{$convocatoria->nombre}}@else{{old('nombre')}}@endif" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" cols="100">@if(isset($convocatoria)){{$convocatoria->descripcion}}@else{{old('descripcion')}}@endif</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado"> 
                <option value="1" @if(isset($convocatoria) && $convocatoria->getOriginal('estado') == 1) selected @endif>Abierto</option>
                <option value="2"  @if(isset($convocatoria) && $convocatoria->getOriginal('estado') == 2) selected @endif>Cerrado</option>
            </select>

        </div>
    </div>
    

    @if(!isset($convocatoria->etapas) && isset($etapas))
    <div class="col-md-12">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
              ETAPAS
            </div>
            <ul class="list-group list-group-flush listEtapas" @if(!isset($disabled)) id="listEtapas" @endif>
                @foreach($etapas as $etapa)
                    <li class="list-group-item etapa" id="etapa" data-id="{{$loop->iteration}}">
                        {{$etapa->nombre}}
                        <input type="hidden" name="etapas[]" value="{{$etapa->id}}">
                    </li>
                @endforeach
            </ul>
          </div>
    </div>
    @endif


    @if(isset($convocatoria->etapas))
    <div class="col-md-12">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
              ETAPAS
            </div>
            <ul class="list-group list-group-flush listEtapas" @if(!isset($disabled)) id="listEtapas" @endif>
                @foreach($convocatoria->etapas as $etapa)
                    <li class="list-group-item etapa" id="etapa" data-id="{{$loop->iteration}}">
                        {{$etapa->nombre}}
                        <input type="hidden" name="etapas[]" value="{{$etapa->id}}">
                    </li>
                @endforeach
            </ul>
          </div>
    </div>
    @endif
</div>
@section('script')

<!-- sortablejs -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    
    localStorage.removeItem('lista-etapas');
   const lista = document.getElementById("listEtapas");
   Sortable.create(lista,{
       animation: 150,
       chosenClass: "seleccionado",
       //ghostClass: "fantasma"
       dragClass: "drag",

       onEnd: () => {
           console.log('Se inserto un elemento');
       },

       group: "lista-etapas",

       store: {
           //Guardamos el orden de la lista
           set: (sortable) => {
                const orden = sortable.toArray();
                localStorage.setItem(sortable.options.group.name, orden.join('|'));
           },

           //Obtenemos el orden de la lista
           get: (sortable) => {
                const orden = localStorage.getItem(sortable.options.group.name);
                return orden ? orden.split('|') : [] ;
           }
       }

   });
   
</script>
@stop
