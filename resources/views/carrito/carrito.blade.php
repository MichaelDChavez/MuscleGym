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

    .btn_ {
        padding: 10px;
        background-color: #17c617;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn_:hover {
        background-color: #0a900a;
    }
</style>

@if ($message = Session::get('carritoMessage'))
    <div style="position: absolute; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@extends('layouts.layout')

@section('content')

    @include('carrito.partials.modalMembresia')
    @include('carrito.partials.modalProductos')

    <section class="home">
        <div style="margin-inline: auto">
            <div
                onclick="document.getElementById('modalMembresia').style.display = 'block';"
                style="display: flex; justify-content: space-between; margin-bottom: 2px;"
            >
                <h2>Membresia</h2>
                @if (count($membresias) > 0)
                    <button style="padding: 5px; background-color: #0a900a; border-radius: 5px; color: white; cursor: pointer;">Pagar Membresia</button>
                @endif
            </div>
            <table>
                <tr>
                    <th>Membresia</th>
                    <th>Precio</th>
                    <th>Pagado?</th>
                </tr>
                @foreach ($membresias as $membresia)
                    @php
                        $membresiaNombre = DB::table('membresia')
                            ->where('ID_Membresia', $membresia->ID_Membresia)
                            ->value("Tipo_Membresia");
                    @endphp
                    <tr>
                        <td>{{ $membresiaNombre }}</td>
                        <td>{{ number_format($membresia->Monto_o_Cantidad) }}</td>
                        <td>No se ha pagado</td>
                    </tr>
                @endforeach
            </table>
            <br>
            <div style="display: flex; justify-content: space-between; margin-bottom: 2px;">
                <h2>Productos</h2>
                @if (count($productos) > 0)
                    <button onclick="
                        document.getElementById('modalProductos').style.display = 'block';
                    " style="padding: 5px; background-color: #0a900a; border-radius: 5px; color: white; cursor: pointer;">Pagar Productos</button>
                    <form method="POST" action="{{ route('eliminar.productos.compra', Auth::user()->id) }}">
                        @method('DELETE')
                        @csrf
                        <button style="padding: 5px; background-color: #e25252; border-radius: 5px; color: white; cursor: pointer;">Eliminar</button>
                    </form>
                @endif
            </div>
            <table>
                <tr>
                    <th>Compra</th>
                    <th>Precio</th>
                    <th>Pagado?</th>
                </tr>
                @foreach ($productos as $producto)
                    @php
                        $productoNombre = DB::table('productos')
                            ->where('ID_Producto', $producto->ID_Producto)
                            ->value('Nombre')
                    @endphp
                    <tr>
                        <td>{{ $productoNombre }}</td>
                        <td>{{ number_format($producto->total_precio) }}</td>
                        <td>No se ha pagado</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection