
<table class="table">
    <thead>
        <tr>
            <th scope="col" colspan="4"><center>Detalle Cronograma</center></th>
          </tr>
    </thead>
    <tbody>
      <tr>
        <th>Fecha Y Hora Inicio: </th>
        <td>@if( $cronograma !== null && $cronograma->fecha_hora_inicio !== null) {{$cronograma->fecha_hora_inicio->format('Y-m-d H:i:s')}} @endif</td>
        <th>Fecha Y Hora Fin: </th>
        <td>@if( $cronograma !== null && $cronograma->fecha_hora_fin !== null) {{$cronograma->fecha_hora_fin->format('Y-m-d H:i:s')}} @endif</td>
      </tr>   
      <tr>
        <th>Duración:</th>
        <td><center>@if( $cronograma !== null) {{$cronograma->duracion}} @endif</center></td>
        <th>Link:</th>
        <td><center><a @if( $cronograma !== null) href="{{$cronograma->enlace}}" @endif target="_blank">@if( $cronograma !== null) {{$cronograma->enlace}} @endif</a></center></td>
      </tr>
      
      <tr>
        <th>Asesor:</th>
        <td colspan="3">@if( $cronograma !== null && $cronograma->asesor !== null) {{$cronograma->asesor->name}} @endif</td>
      </tr>
    </tbody>
  </table>
