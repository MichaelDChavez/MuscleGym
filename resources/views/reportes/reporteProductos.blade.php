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
      <th>PRODUCTO</th>
      <th>CANTIDAD</th>
      <th>TOTAL</th>
    </tr>
    @foreach ($ventas as $venta)
        <tr>
            <td>{{$venta->ID_Venta_producto}}</td>
            <td>{{$venta->Nombre}}</td>
            <td>{{$venta->Cantidad}}</td>
            <td>{{$venta->Subtotal}}</td>
        </tr>  
    @endforeach
  </table>