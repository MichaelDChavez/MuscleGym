@if ($message = Session::get('productosMensaje'))
    <div style="position: absolute; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@extends('layouts.layout')

@section('content')
    <section class="home" style="display: flex; justify-content: center">
        <div style="display: flex; padding-inline: 500px; gap: 20px;">
            <a href="{{route('tienda.show')}}"style="width: 200px; height: 200px; background-color:  rgba(224, 119, 27, 0.418); display: flex; justify-content: center; flex-direction: column; align-items: center; gap: 20px; color:black">
                <h2 style="text-align: center">Productos</h2>
                <img src="{{ asset('storage/tienda/productos_2.png') }}" style="width: 100px; height: 100px;" />
            </a>
        </div>
    </section>
    @if (Auth::user()->rol == 1)
        <div style="margin-inline: 200px; gap: 20px; display: grid; grid-template-columns: auto auto auto;">
            <div style="background-color: rgba(224, 119, 27, 0.418); padding: 20px; margin:50px">
                <h3>Crear Usuarios</h3>
                <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data" style="display:flex; flex-direction: column;">
                    @csrf
                    <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="text" placeholder="Nombre" name="nombre" required />
                    <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="number" placeholder="Precio" name="precio" required />
                    <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="number" placeholder="Cantidad disponible" name="cantidad_disponible"  />
                    <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="text" placeholder="Proveedor" name="proveedor" required />
                    <input style="padding: 5px; border-radius: 10px; margin-inline: 10px; margin-block: 5px" type="file" name="file" required />
        
                    <button class="btn" type="submit">Enviar</button>
                </form>
            </div>
            <div style="background-color: rgba(224, 119, 27, 0.418); padding: 20px; margin:50px">
                <h3>Eliminar Productos</h3>
                <form method="POST" action="{{route('delete.productos')}}">
                    @csrf
                    @method('delete')
                    <div style="height: 200px; overflow: auto;">
                        @foreach ($productos as $producto)
                        <label>
                            <input type="radio" name="radioId" value="{{ $producto->ID_Producto }}" /> <b>{{ $producto->Nombre }}</b><br>
                        </label>
                        @endforeach
                    </div>
                    <button class="btn" type="submit">Eliminar</button>
                </form>
            </div>

        </div>
    @else
        <div style="margin-inline: 200px; gap: 20px; display: flex; width: 75%; overflow: auto;">
            @foreach ($productos as $producto)
                <div style="background-color:  rgba(224, 119, 27, 0.418); display: flex; flex-direction: column; padding: 20px; justify-content: center; align-items: center">
                    <form method="POST" action="{{route('comprar.actualizar', $producto->ID_Producto)}}">
                        @csrf
                        <img src="{{ Storage::url($producto->Descripcion) }}" style="width: 200px" />
                        <h3>{{ $producto->Nombre }}</h3>
                        <p><b>Precio:</b> ${{ $producto->Precio }}</p>
                        <p><b>Cantidad Disponible:</b> {{ $producto->Cantidad_disponible }}</p>
                        <button class="btn" type="submit">Comprar</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
@endsection