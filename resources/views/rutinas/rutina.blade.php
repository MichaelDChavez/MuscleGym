@extends('layouts.layout')

@section('content')

<section class="home">
    <div class="max-width">
        <div>
            @if(Auth::user()->rol == 2)
                <h4 style="color: white; font-size: 20px;">Cuentas con membresia {{ $membresia }}</h4>
                <h4 style="color: white; font-size: 20px;">La rutina sugerida de tu membresia es:</h4>
                <div style="display: grid; grid-template-columns: auto auto auto; gap: 10px; margin-top: 10px">
                {{-- <div > --}}
                    @foreach ($rutinasUsuario as $rutina)
                        <div style="width: full; background-color: tomato; display: flex; flex-direction: column; align-items: center; border-radius: 20px; padding: 2px">
                            <h5 style="text-align: center; font-size: 20px;">{{$rutina->Nombre_rutina}}</h5>
                            <p style="padding: 5px; text-align: justify;"> {{ $rutina->Descripcion }} </p>
                            {{-- @if ($rutina->Descripcion === "Pierna")
                                <img src="{{ asset('storage/rutinas/pierna.png') }}" style="width: 100px; height: 100px;" />
                            @elseif ($rutina->Descripcion === 'Espalda')
                                <img src="{{ asset('storage/rutinas/espalda.png') }}" style="width: 100px; height: 100px;" />
                            @else
                                <img src="{{ asset('storage/rutinas/brazo.png') }}" style="width: 100px; height: 100px;" />
                            @endif --}}
                        </div>

                    @endforeach
                </div>
            @else
                <div style="display: flex; gap: 20px; width: 75vw; overflow: auto;">
                    @foreach ($rutinasAdministrador as $rutina)

                        <div style="width: 200px; height: 230px; background-color: tomato; display: flex; flex-direction: column; align-items: center; border-radius: 20px">
                            <h4 style="text-align: center; font-size: 50px">{{$rutina->Descripcion}}</h4>
                            @if ($rutina->Descripcion === "Pierna")
                                <img src="{{ asset('storage/rutinas/pierna.png') }}" style="width: 100px; height: 100px;" />
                                @elseif ($rutina->Descripcion === 'Espalda')
                                <img src="{{ asset('storage/rutinas/espalda.png') }}" style="width: 100px; height: 100px;" />
                            @else
                            <img src="{{ asset('storage/rutinas/brazo.png') }}" style="width: 100px; height: 100px;" />
                            @endif
                            <p>{{ $rutina->ID_Cliente }}</p>
                        </div>

                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
