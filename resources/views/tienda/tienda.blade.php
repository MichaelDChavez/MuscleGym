@extends('layouts.layout')

@section('content')
<section class="home" style="display: flex; justify-content: center">
    <div style="display: flex; padding-inline: 500px; gap: 20px;">
        <a href="{{route('membresias.show')}}"style="width: 200px; height: 200px; background-color:  rgba(224, 119, 27, 0.418); display: flex; justify-content: center; flex-direction: column; align-items: center; gap: 20px; color:black">
            <h2 style="text-align: center">Membresias</h2>
            <img src="{{ asset('storage/tienda/membresia.png') }}" style="width: 100px; height: 100px;" />
        </a>
        <a href="{{route('productos.show')}}" style="width: 200px; height: 200px; background-color:  rgba(224, 119, 27, 0.418); display: flex; justify-content: center; flex-direction: column; align-items: center; gap: 20px; color: black">
            <h2 style="text-align: center">Productos</h2>
            <img src="{{ asset('storage/tienda/productos_2.png') }}" style="width: 100px; height: 100px;" />
        </a>
    </div>
</section>
@endsection