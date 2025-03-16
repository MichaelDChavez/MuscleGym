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

<h2>Usuarios registrados sin membresia</h2>
<table>
    <tr>
      <th>USUARIO</th>
      <th>CORREO ELECTRONICO</th>
      <th>FECHA DE REGISTRO</th>
    </tr>
    @foreach ($usuarios as $usuario)
        <tr>
            <td>{{$usuario->name}}</td>
            <td>{{$usuario->email}}</td>
            <td>{{$usuario->created_at}}</td>
        </tr>
    @endforeach
  </table>