@if ($message = Session::get('horarioMensaje'))
    <div style="position: absolute; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('administradorMensajes'))
    <div style="position: absolute; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
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
    <div style="margin-top: 100px">
        @if (Auth::user()->rol === 1)
            <div style="background-color: rgba(224, 119, 27, 0.418); padding: 20px; margin:50px; margin-inline: 20%">
                <h3>Crear Horarios</h3>
                <form method="POST" action="{{ route('horarios.create') }}" enctype="multipart/form-data" style="display:flex; flex-direction: column;">
                    @csrf
                    <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="text" placeholder="Horario" name="horario" required />
                    <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="time" placeholder="Inicio" name="inicio" required />
                    <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="time" placeholder="Fin" name="fin" required />
                    <textarea style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="time" placeholder="Descripción" name="descripcion"></textarea>

                    <button class="btn" type="submit">Enviar</button>
                </form>
            </div>

            <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin:50px">
                <table>
                    <tr>
                        <th>Horario</th>
                        <th>Usuario</th>
                    </tr>
                    @foreach ($horarios as $horario)
                        <tr>
                            <td>{{$horario->horario}}</td>
                            <td>{{$horario->name}}</td>
                        </tr>
                    @endforeach
                  </table>

            </div>
        @else
            @if($membresia)
                <div style="background-color: rgba(224, 119, 27, 0.418); padding: 20px; margin:50px; margin-inline: 20%">
                    <h3>Seleccionar Horarios</h3>
                    <form method="POST" action="{{ route("horario.cliente.create") }}">
                        @csrf
                        <select style="border-radius: 5px; padding: 20px;" name="horario" id="horario" required>
                            <option value="" selected disabled>Seleccione una opción...</option>
                            @foreach ($horarios_cliente as $horario)
                                <option value="{{ $horario->id }}"> {{ $horario->horario }} Horario: {{ $horario->inicio }} - {{ $horario->fin }} </option>
                            @endforeach
                        </select>
                        <br>
                        <button class="btn" type="submit">Enviar</button>
                    </form>
                </div>
                @if ($horarioActual != Null)
                <div style="background-color: rgba(224, 119, 27, 0.418); padding: 20px; margin:50px; margin-inline: 20%">
                    <h3>Su Horario Actual es: </h3> {{ $horarioActual->horario }} / {{ $horarioActual->inicio }} - {{ $horarioActual->fin }}
                    <form method="POST" action="{{ route("eliminar.horario.cliente", $horarioActual->id_horario) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">Eliminar</button>
                    </form>
                </div>
                @endif
            @else
                <section class="home">
                    <div style="background-color:  rgba(251, 141, 44, 0.682); padding: 20px; margin-inline: auto">
                        Debes Adquirir una membresia para seleccionar horarios
                    </div>
                </section>
            @endif
        @endif
    </div>
@endsection
