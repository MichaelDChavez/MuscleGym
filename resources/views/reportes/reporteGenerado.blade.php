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

<table>
    <tr>
      <th>ID</th>
      <th>TIPO MEMBRESIA</th>
      <th>VALOR MEMBRESIA</th>
      <th>FECHA DE INICIO</th>
    </tr>
    @foreach ($ventas as $venta)
        <tr>
            <td>{{$venta->ID_Cliente}}</td>
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
            <td>{{$venta->Fecha}}</td>
        </tr>  
    @endforeach
  </table>