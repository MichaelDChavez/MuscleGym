<style>
    table, td, th {
      border: 1px solid #ddd;
      text-align: left;
      color: #ddd;
      background: rgba(224, 119, 27, 0.653)
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      padding: 15px;
    }
</style>

<table id="ventasTable">
    <tr>
      <th>USUARIO</th>
      <th>TIPO MEMBRESIA</th>
      <th>VALOR MEMBRESIA</th>
      <th>FECHA DE INICIO</th>
    </tr>
    @foreach ($ventasReporte as $venta)
        <tr class="venta-row">
            <td>{{$venta->name}}</td>
            @switch($venta->ID_Membresia)
                @case(401)
                    <td>CrossFit</td>
                    @break
                @case(402)
                    <td>SemiPerson</td>
                    @break
                @case(403)
                    <td>Personalizado</td>
                    @break
                @default

            @endswitch
            <td>${{$venta->Monto_o_Cantidad}}</td>
            <td class="fecha" data-fecha="{{$venta->Fecha}}">{{$venta->Fecha}}</td>
        </tr>
    @endforeach
  </table>
