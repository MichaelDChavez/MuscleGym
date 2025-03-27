@if ($message = Session::get('membresiaMensaje'))
    <div style="position: fixed; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('administradorMensajes'))
    <div style="position: fixed; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

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

@section('content')
<section class="home" style="display: flex; justify-content: center">
    <div style="display: flex; padding-inline: 500px; gap: 20px;">
        <a href="{{route('tienda.show')}}"style="width: 200px; height: 200px; background-color:  rgba(224, 119, 27, 0.418); display: flex; justify-content: center; flex-direction: column; align-items: center; gap: 20px; color:black">
            <h2 style="text-align: center">Membresias</h2>
            <img src="{{ asset('storage/tienda/membresia.png') }}" style="width: 100px; height: 100px;" />
        </a>
    </div>
</section>
@if (Auth::user()->rol === 1)
<center>
    <a href="{{ route("crear.membresias.view") }}" class="btn_">
        Crear Membresias
    </a>
</center>
@endif
@if (Auth::user()->rol === 2)
    @if ($membresiaUsuario)
        <center>
            <form method="POST" action="{{ route('eliminar.membresia', Auth::user()->id) }}">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn_" style="background-color: red">
                    Eliminar Membresia
                </button>
            </form>
        </center>
    @endif
@endif
@if (Auth::user()->rol === 1)
    <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin:50px">
        <table>
            <tr>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>TIPO MEMBRESIA</th>
              <th>VALOR MEMBRESIA</th>
              <th>FECHA DE INICIO</th>
              <th>ACTUALIZAR</th>
              <th>ELIMINAR</th>
            </tr>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{$venta->ID_Cliente}}</td>
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
                            <td> {{ $venta->Tipo_Membresia }} </td>
                            @break

                    @endswitch
                    <td>${{$venta->Monto_o_Cantidad}}</td>
                    <td>{{$venta->Fecha}}</td>
                    <td>
                        <form method="POST" action="{{route('actualizar.fecha.venta', $venta->ID_Venta)}}" >
                            @csrf
                            @method('PUT')
                            <button style="padding: 5px; background-color: orange; border-radius: 10px; cursor: pointer;">Actualizar Membresia</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{route('eliminar.venta', $venta->ID_Venta)}}" >
                            @csrf
                            @method('delete')
                            <button style="padding: 5px; background-color: orange; border-radius: 10px; cursor: pointer;">Eliminar Membresia</button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </table>

    </div>
@else

    <div style="margin-inline: 200px; gap: 20px; display: grid; grid-template-columns: auto auto auto; margin-top: 20px;">
        @foreach ($membresias as $membresia)
            <form method="POST" action="{{route('membresias.store', $membresia->ID_Membresia)}}" style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; border-radius: 10px">
                @csrf
                <h2>{{ $membresia->Tipo_Membresia }}</h2>
                @switch($membresia->Tipo_Membresia)
                    @case('CrossFit')
                        <ul style="margin-left: 30px; margin-bottom: 50px">
                            <li>Sistema de entrenamiento basados en ejercicios funcionales de alta intensidad.</li>
                            <li>5 días Crossfit. </li>
                        </ul>
                        @break
                    @case('SemiPerson')
                        <ul style="margin-left: 30px;">
                            <li>Opción ideal para aquellos que buscan objetivos especificos combinando técnicas Crossfit. </li>
                            <li>3 días de entrenamiento funcional.</li>
                            <li>2 días Crossfit. </li>
                        </ul>
                        @break
                    @case('Personalizado')
                        <ul style="margin-left: 30px;">
                            <li>Es la opción ideal para aquellos que buscan objetivos espeficificos con un entrenador personalizado durante todas sus rutinas. </li>
                            <li>5 días de entrenamiento personalizado.</li>
                        </ul>
                        @break
                    @default
                        <p>{{ $membresia->descripcion }}</p>
                        @break
                @endswitch

                <div style="display: flex; align-items: center; gap: 20px;">
                    <h3 style="color: white; margin-top: 30px">${{ $membresia->Precio }}</h3>
                    <button type="submit" class="btn">Suscribirse</button>
                </div>
            </form>
        @endforeach
    </div>
@endif
@endsection
