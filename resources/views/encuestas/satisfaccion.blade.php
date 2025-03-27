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

@if ($message = Session::get('correoMessage'))
    <div style="position: fixed; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@extends('layouts.layout')

@section('content')
    <section class="home">
        <div class="max-width">
            <table>
                <tr>
                    <th>Usuarios Con Membresia</th>
                    <th># de Contacto</th>
                    <th>Envio de correo Satisfacción</th>
                    <th>Respuesta</th>
                </tr>
                @foreach ($usuarios as $usuario)
                    @php
                        $respuesta = DB::table('seguimiento')
                            ->where('ID_Cliente', $usuario->id)
                            ->value('Responsable');

                        $telefono = DB::table('Cliente')
                            ->where('ID_Cliente', $usuario->id)
                            ->value('telefono');
                    @endphp
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $telefono }}</td>
                        <td>
                            <a
                                href="{{ route('correo.satisfaccion', $usuario->id) }}"
                                style="padding: 5px; border-radius: 5px; background-color: rgb(247, 194, 114); cursor: pointer; color: black"
                            >
                                Enviar Correo
                            </a>
                        </td>
                        <td>{{ $respuesta }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
