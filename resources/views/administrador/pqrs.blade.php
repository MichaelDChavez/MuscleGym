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
<section class="home">
    <div class="max-width">
        <div style="display: flex; gap: 20px; width: 75vw; overflow: auto;">
            <table>
                <tr>
                    <th>Email</th>
                    <th>Opinión</th>
                    <th>Respuesta</th>
                </tr>
                @foreach ($pqrs as $p)
                    <tr>
                        <td>
                            {{ $p->email }}
                        </td>
                        <td>
                            {{ $p->opinion }}
                        </td>
                        @if (empty($p->respuesta))
                            <td>
                                <form method="POST" action="{{ route('update.pqrs', $p->id) }}" style="display: flex">
                                    @method('PUT')
                                    @csrf
                                    <input style="padding: 5px; border-radius: 5px;" type="text" name="respuesta" placeholder="respuesta">
                                    <button style="background-color: tomato; color: white; padding: 5px; margin-inline: 5px;">Enviar</button>
                                </form>
                            </td>
                        @else
                            <td>
                                {{$p->respuesta}}
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</section>
@endsection
