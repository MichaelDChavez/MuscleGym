@extends('layouts.layout')

@section('content')
<section class="home" style="display: flex; justify-content: center">
    <div style="padding-inline: 500px; gap: 20px;">
        <h2>Reporte de Ventas Membresia</h2>
       <form method="GET" action="{{ route('descargar.repoorte') }}">
            <input style="padding: 10px; border-radius: 20px; margin-block: 20px" type="date" name="fechaInicio">
            <input style="padding: 10px; border-radius: 20px; margin-block: 20px" type="date" name="fechaFin">
            
            <button class="btn" type="submit">Descargar</button>
       </form>
       <br>
       <br>
       <br>
        <h2>Reporte de Ventas Productos</h2>
       <form method="GET" action="{{ route('descargar.repoorte.productos') }}">
            {{-- <input style="padding: 10px; border-radius: 20px; margin-block: 20px" type="date" name="fechaInicio">
            <input style="padding: 10px; border-radius: 20px; margin-block: 20px" type="date" name="fechaFin"> --}}
            
            <button class="btn" type="submit">Descargar</button>
       </form>
    </div>
</section>
@endsection