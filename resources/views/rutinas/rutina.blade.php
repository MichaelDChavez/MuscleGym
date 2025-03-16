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

@php
    $dias = [
        "Lunes",
        "Martes",
        "Miércoles",
        "Jueves",
        "Viernes",
        "Sábado",
        "Domingo",
    ]
@endphp

@extends('layouts.layout')

@section('content')

<section class="home">
    <div class="max-width">
        <div>
            @if(Auth::user()->rol == 2)
                @if (!empty($membresia))
                    <h4 style="color: white; font-size: 20px;">Cuentas con membresia {{ $membresia }}</h4>
                    <h4 style="color: white; font-size: 20px;">La rutina sugerida de tu membresia es:</h4>
                    <div style="display: grid; grid-template-columns: auto auto auto; gap: 10px; margin-top: 10px">
                        @foreach ($rutinasUsuario as $key => $rutina)
                            <div style="width: full; background-color: tomato; display: flex; flex-direction: column; align-items: center; border-radius: 20px; padding: 2px">
                                <h5 style="text-align: center; font-size: 20px;">{{ $dias[$key] }}: {{$rutina->Nombre_rutina}}</h5>
                                <p style="padding: 5px; text-align: justify;"> {{ $rutina->Descripcion }} </p>
                            </div>

                        @endforeach
                    </div>
                @else
                    <h4 style="color: white; font-size: 20px;">No cuentas con membresia para ver las rutinas</h4>
                @endif

            @else
                <div style="display: flex; gap: 20px; width: 75vw; overflow: auto;">
                    {{-- @foreach ($usuarios as $usuario) --}}

                        {{-- <div style="width: 200px; height: 230px; background-color: tomato; display: flex; flex-direction: column; align-items: center; border-radius: 20px">
                            <h4 style="text-align: center; font-size: 50px">{{$rutina->Descripcion}}</h4>
                            @if ($rutina->Descripcion === "Pierna")
                                <img src="{{ asset('storage/rutinas/pierna.png') }}" style="width: 100px; height: 100px;" />
                                @elseif ($rutina->Descripcion === 'Espalda')
                                <img src="{{ asset('storage/rutinas/espalda.png') }}" style="width: 100px; height: 100px;" />
                            @else
                            <img src="{{ asset('storage/rutinas/brazo.png') }}" style="width: 100px; height: 100px;" />
                            @endif
                            <p>{{ $rutina->ID_Cliente }}</p>
                        </div> --}}


                    {{-- @endforeach --}}
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Dieta</th>
                        </tr>
                        @foreach ($usuarios as $usuario)
                            @php
                                // $dietas = DB::table('planes_usuario as pu')
                                //     ->where('Id_Cliente', $usuario->id)
                                //     ->join('planes_nutricionales as pn', 'pn.Id_plan_nutricional', '=', 'pu.ID_Plan')
                                //     ->get();
                                $rutinas = DB::table('rutinas')
                                    ->where('ID_Cliente', $usuario->id)
                                    ->get();
                            @endphp
                            @if (count($rutinas) > 0)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <th>Rutina</th>
                                                <th>Descripción</th>
                                            </tr>
                                            @foreach ($rutinas as $rutina)
                                                <tr>
                                                    <td>{{ $rutina->Nombre_rutina }}</td>
                                                    <td>{{ $rutina->Descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                            @else
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>No tiene membresia activa</td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
