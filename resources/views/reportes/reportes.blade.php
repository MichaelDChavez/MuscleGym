@extends('layouts.layout')

@section('content')
<section class="home" style="display: flex; justify-content: center">
    <div style="padding-inline: 500px; gap: 20px;">
        <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto">
            <h2>Reporte de Ventas Membresia</h2>
           <form method="GET" action="{{ route('descargar.repoorte') }}">
                <input style="padding: 10px; border-radius: 20px; margin-block: 20px" type="date" name="fechaInicio">
                <input style="padding: 10px; border-radius: 20px; margin-block: 20px" type="date" name="fechaFin">

                <button class="btn" type="submit">Descargar</button>
           </form>
        </div>
       <br>
       <br>
       <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto">
            <h2>Reporte de Ventas Productos</h2>
            <form method="GET" action="{{ route('descargar.repoorte.productos') }}">
                <button class="btn" type="submit">Descargar</button>
            </form>
       </div>
       <br>
       <br>
       <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto">
            <h2>Reporte de Usuario sin Membresia</h2>
            <form method="GET" action="{{ route('descargar.repoorte.sinmembresia') }}">
                <button class="btn" type="submit">Descargar</button>
            </form>
       </div>
    </div>
</section>
@endsection