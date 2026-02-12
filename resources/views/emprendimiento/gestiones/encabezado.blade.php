<div class="card shadow mb-4">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" colspan="4"><center><strong>Detalle Convocatoria</strong></center></th>
                  </tr>
            </thead>
            <tbody>
              <tr>
                    <th>Nombre:</th>
                    <td>@if( $convocatoria !== null) {{$convocatoria->nombre}} @endif</td>
                    <th>Estado:</th>
                    <td>@if( $convocatoria !== null) {{$convocatoria->estado}} @endif</td>
              </tr>
              <tr>
                <th>Fecha Inicio: </th>
                <td>@if( $convocatoria !== null) <input class="form-control" id="fecha_inicio" value="{{$convocatoria->fecha_inicio->format('Y-m-d')}}" disabled> @endif</td>
                <th>Fecha Fin: </th>
                <td>@if( $convocatoria !== null) <input class="form-control" id="fecha_fin" value="{{$convocatoria->fecha_fin->format('Y-m-d')}}" disabled> @endif</td>        
              </tr>
            </tbody>
        </table>
    </div>
</div>

