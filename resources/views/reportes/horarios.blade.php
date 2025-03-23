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
    <h2>Horarios Clientes</h2>
    <label>{{ Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</label>
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
