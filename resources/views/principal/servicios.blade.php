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

<link rel="stylesheet" href="{{ asset('css/style3.css') }}" />

@extends('layouts.layout')

@if ($message = Session::get('planUsuario'))
    <div style="position: absolute; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@section('content')
    <section class="home">
        @if(Auth::user()->rol == 2)
            @if (!empty($membresia))
                <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto; ">
                    <table>
                        <tr>
                            <th>Ejemplo</th>
                            <th>Datos</th>
                        </tr>
                        @foreach ($planes as $plan)
                            @php
                            $planUsuario = DB::table('planes_usuario as pu')
                                ->where('ID_Cliente', Auth::user()->id)
                                ->where('ID_Plan', $plan->Id_plan_nutricional)
                                ->exists();
                            @endphp
                            <tr>
                                <td>{{ $plan->Ejemplo }}</td>
                                <td>
                                    <button onclick="mostrar({{$plan->Calorias_Diarias}}, {{$plan->Proteinas}}, {{$plan->Carbohidtaros}}, {{$plan->Grasas}})" style="padding: 5px; background-color: #4295c5; color: white; border-radius: 20px; cursor: pointer;">
                                        Ver datos
                                    </button>
                                    <br><br>
                                    @if ($planUsuario)
                                        <form method="POST" action="{{ route("eliminarPlanUsuario", ["usuario" => Auth::user()->id, "plan" => $plan->Id_plan_nutricional]) }}">
                                            @method("delete")
                                            @csrf
                                            <input name="idPlan" type="hidden" value="{{$plan->Id_plan_nutricional}}">
                                            <button type="submit" style="padding: 5px; background-color: #c54442; color: white; border-radius: 20px; cursor: pointer;">
                                                Eliminar
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('agregarPlanUsuario') }}">
                                            @csrf
                                            <input name="idPlan" type="hidden" value="{{$plan->Id_plan_nutricional}}">
                                            <button style="padding: 5px; background-color: #42c54f; color: white; border-radius: 20px; cursor: pointer;">
                                                Seleccionar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <div style="background-color:  rgba(251, 141, 44, 0.682); padding: 20px; margin-inline: auto">
                    Debes Adquirir y pagar una membresia para seleccionar planes alimenticios
                </div>
            @endif
        @else
            <div>
                <h1>Dietas de Usuarios</h1>
                <div style="margin-inline: auto ">
                    <button onclick="mostrarFormulario()" style="margin-block: 10px; padding: 10px; border-radius: 5px; color: white; background-color: #0a900a; cursor: pointer;">
                        Crear Dieta
                    </button>
                    <a href="{{ route('ver.dietas') }}" style="margin-block: 10px; margin-inline: 5px; padding: 9px; border-radius: 5px; color: white; background-color: #dd7a41; cursor: pointer;">
                        Ver Dietas Creadas
                    </a>
                    <input id="searchBox" placeholder="Buscar..." type="text" style="height: 40px; border-radius: 5px; padding: 5px; margin-right: 0; border: 1px solid black;">
                    <div style="background-color:  rgba(224, 119, 27, 0.418); padding: 20px; margin-inline: auto; width: 1200px;">
                        <table id="filData">
                            <tr>
                                <th>Nombre</th>
                                <th>Dieta</th>
                            </tr>
                            @foreach ($usuarios as $usuario)
                                @php
                                    $dietas = DB::table('planes_usuario as pu')
                                        ->where('Id_Cliente', $usuario->id)
                                        ->join('planes_nutricionales as pn', 'pn.Id_plan_nutricional', '=', 'pu.ID_Plan')
                                        ->get();
                                @endphp
                                @if (count($dietas) > 0)
                                    <tr class="filInit">
                                        <td class="nameUser">{{ $usuario->name }}</td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <th>Ejemplo</th>
                                                    <th>Datos</th>
                                                </tr>
                                                @foreach ($dietas as $dieta)
                                                    <tr>
                                                        <td>{{ $dieta->Ejemplo }}</td>
                                                        <td>
                                                            <button onclick="mostrar({{$dieta->Calorias_Diarias}}, {{$dieta->Proteinas}}, {{$dieta->Carbohidtaros}}, {{$dieta->Grasas}})" style="padding: 5px; background-color: #4295c5; color: white; border-radius: 20px; cursor: pointer;">
                                                                Ver datos
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @else
                                <tr class="filInit">
                                    <td class="nameUser">{{ $usuario->name }}</td>
                                    <td>No hay dietas seleccionadas</td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection

<div id="myModal" class="modal">

    <div class="modal-content">
        <span onclick="cerrar()" class="close">&times;</span>
        <div style="color: white">
            <p>Calorias: <span id="calorias"></span></p>
            <p>Proteinas: <span id="proteinas"></span></p>
            <p>Carbohidratos: <span id="carbohidratos"></span></p>
            <p>Grasas: <span id="grasas"></span></p>
        </div>
    </div>

</div>

<div id="myModalFormulario" class="modalFormulario">

    <div class="modal-content">
        <span onclick="cerrarFormulario()" class="close">&times;</span>
        <div style="color: white">

            <form method="POST" action="{{ route('agregar.plan') }}">
                @csrf
                <div class="input-box">

                    <input type="number" placeholder="Calorias Diarias" name="Calorias_Diarias" required>
                    <br>
                    <x-input-error :messages="$errors->get('caloriasDiarias')" class="mt-2" />
                    <br>

                    <input type="number" placeholder="Proteinas" name="Proteinas" required>
                    <br>
                    <x-input-error :messages="$errors->get('proteinas')" class="mt-2" />
                    <br>

                    <input type="number" placeholder="Carbohidratos" name="Carbohidtaros" required>
                    <br>
                    <x-input-error :messages="$errors->get('Carbohidtaros')" class="mt-2" />
                    <br>

                    <input type="number" placeholder="Grasas" name="Grasas" required>
                    <br>
                    <x-input-error :messages="$errors->get('Grasas')" class="mt-2" />
                    <br>

                    {{-- <input type="number" placeholder="Grasas" name="Grasas" required> --}}
                    <textarea placeholder="Ejemplo de la dieta..." name="Ejemplo"></textarea>
                    <br>
                    <x-input-error :messages="$errors->get('Ejemplo')" class="mt-2" />
                    <br>

                    <button type="submit" class="btn">Crear Plan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>

    function cerrar() {
        let modal = document.getElementById('myModal')

        modal.style = "display: none"
    }

    function cerrarFormulario(){
        let modal = document.getElementById('myModalFormulario')

        modal.style = "display: none"
    }

    function mostrar(caloriasData, proteinasData, carbohidratosData, grasasData) {
        let modal = document.getElementById('myModal')



        let calorias = document.getElementById('calorias')
        let proteinas = document.getElementById('proteinas')
        let carbohidratos = document.getElementById('carbohidratos')
        let grasas = document.getElementById('grasas')

        calorias.innerHTML = caloriasData
        proteinas.innerHTML = proteinasData
        carbohidratos.innerHTML = carbohidratosData
        grasas.innerHTML = grasasData

        modal.style = "display: block"

    }

    function mostrarFormulario(){
        let modal = document.getElementById('myModalFormulario')
        modal.style = "display: block"
    }

    document.addEventListener("DOMContentLoaded", function () {
        let searchInput = document.getElementById('searchBox')

        let table = document.getElementById("filData");

        searchInput.addEventListener("keyup", function () {
            let filter = searchInput.value.toLowerCase();
            let rows = document.querySelectorAll("#filData .filInit");

            rows.forEach(row => {
                let nameCell = row.querySelector(".nameUser");
                if (nameCell) {
                    let textValue = nameCell.textContent || nameCell.innerText;
                    row.style.display = textValue.toLowerCase().includes(filter) ? "" : "none";
                }
            });
        });
    });
</script>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 999999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }

    .modalFormulario {
        display: none;
        position: fixed;
        z-index: 999999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }


    .modal-content {
        background-color: #000;
        margin: 8% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }


    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
