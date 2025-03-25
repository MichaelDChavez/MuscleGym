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

@extends('layouts.layout')

@php
    $productos = DB::table('productos')
        ->where('Estado', 1)
        ->get();

    $horarios = DB::table('horarios_cliente as hc')
        ->join('users as u', 'u.id', '=', 'hc.id_cliente')
        ->join('horarios as h', 'h.id', '=', 'hc.id_horario')
        ->get();

    $ventas = DB::table('ventas_productos')->join('productos', 'productos.ID_Producto', '=', 'ventas_productos.ID_Producto')->get();

    $usuarios = DB::table('users as u')
            ->leftJoin('ventas as v', 'v.ID_Cliente', '=', 'u.id')
            ->where('u.rol', '=', '2')
            ->whereNull('v.ID_Cliente')
            ->orderBy('created_at', 'desc')
            ->get();
@endphp

@section('content')
<section class="home" style="display: flex; justify-content: center">
    <div style="padding-inline: 500px; gap: 20px;">
        <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto">
            <div style="display: flex; justify-content: space-between">
                <h2>Productos en Stock</h2>
                <a href="{{ route('descargar.stock') }}" style="background-color: #0a900a; color: white; padding: 5px; border-radius: 5px;">Descargar</a>
            </div>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Disponible</th>
                </tr>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->Nombre }}</td>
                        <td>{{ $producto->Cantidad_disponible }}</td>
                        <td>{{ $producto->Cantidad_disponible <= 0 ? "No" : "Si" }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <br>
        <br>
        <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto">
            <div style="display: flex; justify-content: space-between">
                <h2>Horarios Clientes</h2>
                <a href="{{ route('descargar.horarios.reporte') }}" style="background-color: #0a900a; color: white; padding: 5px; border-radius: 5px;">Descargar</a>
            </div>
            <table>
                <tr>
                    <th>ID Horario</th>
                    <th>Nombre</th>
                    <th>Hora Inicial</th>
                    <th>Hora Final</th>
                    <th>Cliente</th>
                </tr>
                @foreach ($horarios as $horario)
                    <tr>
                        <td>{{ $horario->id_horario }}</td>
                        <td>{{ $horario->horario }}</td>
                        <td>{{ $horario->inicio }}</td>
                        <td>{{ $horario->fin }}</td>
                        <td>{{ $horario->name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <br>
        <br>
        <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto">
            <h2>Reporte de Ventas Membresia</h2>
           <form method="GET" action="{{ route('descargar.repoorte') }}">
                <input style="padding: 10px; border-radius: 20px; margin-block: 20px; width: 40%;" type="date" name="fechaInicio">
                <input style="padding: 10px; border-radius: 20px; margin-block: 20px; width: 40%;" type="date" name="fechaFin">

                <button class="btn" type="submit">Descargar</button>
           </form>
        </div>
       <br>
       <br>
       <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto">
            <h2>Reporte de Ventas Productos</h2>
            <form method="GET" action="{{ route('descargar.repoorte.productos') }}">
                <button class="btn" type="submit">Descargar</button>
            </form>
            @include('reportes.reporteProductos')
       </div>
       <br>
       <br>
       <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto">
            <h2>Reporte de Usuario sin Membresia</h2>
            <form method="GET" action="{{ route('descargar.repoorte.sinmembresia') }}">
                <button class="btn" type="submit">Descargar</button>
            </form>
            @include('reportes.reporteSinMembresia')
       </div>
    </div>
</section>
@endsection
