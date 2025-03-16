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

@extends('layouts.layout')

@section('content')

<section class="home">
    <div class="max-width">
        <div style="display: flex; gap: 20px; width: 75vw; overflow: auto;">
            <table>
                <tr>
                    <th>Dieta</th>
                    <th>Calorias Diarias</th>
                    <th>Calorias Proteinas</th>
                    <th>Carbohidratos</th>
                    <th>Grasas</th>
                    <th>Acciones</th>
                </tr>
                @foreach ($dietas as $dieta)
                    <form id="{{$dieta->Id_plan_nutricional}}" method="POST" action='{{ route("editar.dieta", "$dieta->Id_plan_nutricional") }}'>
                        @method("PUT")
                        @csrf
                        <tr>
                            <td>
                                <div data-Name="Ejemplo" class="dieta-{{$dieta->Id_plan_nutricional}}-ejemplo">
                                    {{ $dieta->Ejemplo }}
                                </div>
                            </td>
                            <td>
                                <div data-Name="Diarias" class="dieta-{{$dieta->Id_plan_nutricional}}-diarias">
                                    {{ $dieta->Calorias_Diarias }}
                                </div>
                            </td>
                            <td>
                                <div data-Name="Proteinas" class="dieta-{{$dieta->Id_plan_nutricional}}-proteinas">
                                    {{ $dieta->Proteinas }}
                                </div>
                            </td>
                            <td>
                                <div data-Name="Carbohidtaros" class="dieta-{{$dieta->Id_plan_nutricional}}-carbohidratros">
                                    {{ $dieta->Carbohidtaros }}
                                </div>
                            </td>
                            <td>
                                <div data-Name="Grasas" class="dieta-{{$dieta->Id_plan_nutricional}}-grasas">
                                    {{ $dieta->Grasas }}
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 4px;">
                                    <button type="button" id="editarDieta" onclick="editar('{{$dieta->Id_plan_nutricional}}')" style="padding: 4px; border-radius: 2px; background-color: rgb(230, 182, 53); cursor: pointer;">Editar</button>
                                    <button type="submit" style="padding: 4px; border-radius: 2px; background-color: rgb(241, 68, 68); cursor: pointer;">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    </form>
                @endforeach
            </table>
        </div>
    </div>
</section>

@endsection

<script>
    function editar(id) {
        let fields = [
            'ejemplo',
            'diarias',
            'proteinas',
            'carbohidratros',
            'grasas'
        ];

        fields.forEach(function(field) {
            let initTag = document.getElementsByClassName('dieta-' + id + '-' + field);

            for (let i = 0; i < initTag.length; i++) {
                let divData = initTag[i];
                let inputNew = document.createElement('input');
                inputNew.name = divData.dataset.name;
                inputNew.value = divData.innerText;

                divData.parentNode.replaceChild(inputNew, divData);
            }
        });

        let buttonEdit = document.getElementById('editarDieta');
        let buttonEditNew = document.createElement('button');
        buttonEditNew.type = 'submit';
        buttonEditNew.style.padding = '4px';
        buttonEditNew.style.borderRadius = '2px';
        buttonEditNew.style.backgroundColor = 'rgb(230, 182, 53)';
        buttonEditNew.style.cursor = 'pointer';
        buttonEditNew.setAttribute('form', id);
        buttonEditNew.innerText = 'Guardar';

        buttonEdit.parentNode.replaceChild(buttonEditNew, buttonEdit);
    }
</script>