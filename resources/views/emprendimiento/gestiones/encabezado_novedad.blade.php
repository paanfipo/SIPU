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
                    <th>Nombre Conovcatoria:</th>
                    <td>@if( $convocatoria !== null) {{$convocatoria->nombre}} @endif</td>
                    <th>Estado:</th>
                    <td>@if( $convocatoria !== null) {{$convocatoria->estado}} @endif</td>
              </tr>
              <tr>
                <th>Fecha Inicio: </th>
                <td>@if( $convocatoria !== null) {{ optional($convocatoria->fecha_inicio)->format('Y-m-d') }} @endif</td>
                <th>Fecha Fin: </th>
                <td>@if( $convocatoria !== null) {{ optional($convocatoria->fecha_fin)->format('Y-m-d') }} @endif</td>
              </tr>
            </tbody>
        </table>
        <table class="table">
          <thead>
              <tr>
                  <th scope="col" colspan="4"><center><strong>Detalle Cronograma</strong></center></th>
              </tr>
          </thead>
          <tbody>
            <tr>
                  <th>Etapa:</th>
                  <td>@if( $cronograma !== null) {{ optional(optional($cronograma->actividad)->etapa)->nombre }} @endif</td>
                  <th>Actividad:</th>
                  <td>@if( $cronograma !== null) {{ optional($cronograma->actividad)->nombre }} @endif</td>
            </tr>
            <tr>
                  <th>Fecha Hora Inicio: </th>
                  <td>@if( $cronograma !== null) {{ optional($cronograma->fecha_hora_inicio)->format('Y-m-d H:i:s') }} @endif</td>
                  <th>Fecha Hora Fin: </th>
                  <td>@if( $cronograma !== null) {{ optional($cronograma->fecha_hora_fin)->format('Y-m-d H:i:s') }} @endif</td>
            </tr>
            <tr>
              <th>Asesor:</th>
              <td>@if( $cronograma !== null && isset($cronograma->asesor)) {{$cronograma->asesor->name}} @endif</td>
              <th></th>
              <td></td>
            </tr>
          </tbody>
      </table>
    </div>
</div>

