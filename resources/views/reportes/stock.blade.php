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
@php
    date_default_timezone_set('America/Bogota');
@endphp
<div style="display: flex; justify-content: space-between">
    <h2>Productos en Stock</h2>
    <label>{{ Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</label>
</div>
<table>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Proveedor</th>
        <th>Precio de venta</th>
        <th>Precio de compra</th>
        <th>Cantidad Vendida</th>
        <th>Total Vendido</th>
        <th>Activo</th>
    </tr>
    @foreach ($productos as $producto)
        <tr>
            <td>{{ $producto->Nombre }}</td>
            <td>{{ $producto->Cantidad_disponible }}</td>
            <td>{{ $producto->Proveedor }}</td>
            <td>{{ number_format($producto->Precio) }}</td>
            <td>{{ number_format($producto->Precio_Compra) }}</td>
            <td>{{ $producto->cantidad_vendida }}</td>
            @if ($producto->cantidad_vendida <= 0)
                <td>0</td>
            @else
                <td>{{ number_format($producto->total_vendido) }}</td>
            @endif
            <td>{{ $producto->Estado == 0 ? "Inactivo" : "Activo" }}</td>
        </tr>
    @endforeach
</table>
