@if ($message = Session::get('mensajeMembresia'))
    <div style="position: fixed; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('administradorMensajes'))
    <div style="position: fixed; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@extends('layouts.layout')

@section('content')
<div style="margin-inline: 200px; gap: 20px; display: grid; grid-template-columns: auto auto auto; margin-top: 80px">
    <div style="background-color: rgba(224, 119, 27, 0.418); padding: 20px; margin:50px">
        <h3>Crear Membresias</h3>
        <form method="POST" action="{{ route('membresias.create') }}" enctype="multipart/form-data" style="display:flex; flex-direction: column;">
            @csrf
            <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="text" placeholder="Tipo Membresia" name="tipoMembresia" required />
            <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="number" placeholder="Precio" name="precio" required />
            <textarea style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="number" placeholder="Descripción" name="descripcion"></textarea>

            <button class="btn" type="submit">Enviar</button>
        </form>
    </div>
    <div style="background-color: rgba(224, 119, 27, 0.418); padding: 20px; margin:50px">
        <h3>Eliminar Membresias</h3>
        <form method="POST" action="{{route('delete.membresia')}}">
            @csrf
            @method('delete')
            <div style="height: 200px; overflow: auto;">
                @foreach ($membresias as $membresia)
                <label>
                    <input type="radio" name="radioId" value="{{ $membresia->ID_Membresia }}" /> <b>{{ $membresia->Tipo_Membresia }}</b><br>
                </label>
                @endforeach
            </div>
            <button class="btn" type="submit">Eliminar</button>
        </form>
    </div>

</div>
@endsection
