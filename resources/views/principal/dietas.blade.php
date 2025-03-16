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

@if ($message = Session::get('dietaMessage'))
    <div style="position: absolute; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

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
                    <form id="form-{{$dieta->Id_plan_nutricional}}" method="POST" action='{{ route("editar.dieta", "$dieta->Id_plan_nutricional") }}'>
                    </form>
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
                                <button type="button" id="editarDieta-{{$dieta->Id_plan_nutricional}}" onclick="editar('{{$dieta->Id_plan_nutricional}}')" style="padding: 4px; border-radius: 2px; background-color: rgb(230, 182, 53); cursor: pointer;">Editar</button>
                                <form method="POST" action="{{ route('borrar.membresia', $dieta->Id_plan_nutricional) }}">
                                    @method("DELETE")
                                    @csrf()
                                    <button type="submit" style="padding: 4px; border-radius: 2px; background-color: rgb(241, 68, 68); cursor: pointer; color: white;">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
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

        let form = document.getElementById('form-' + id);

        let methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);

        let tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = "{{ csrf_token() }}";
        tokenInput.setAttribute('autocomplete', 'off');
        form.appendChild(tokenInput);

        fields.forEach(function(field) {
            let initTag = document.getElementsByClassName('dieta-' + id + '-' + field);

            for (let i = 0; i < initTag.length; i++) {
                let divData = initTag[i];

                let inputNew = document.createElement('input');
                inputNew.name = divData.dataset.name;
                inputNew.value = divData.innerText;

                if(divData.dataset.name == 'Ejemplo')
                    inputNew.type = "text"
                else
                    inputNew.type = 'number';
                inputNew.step = "any";

                let inputHidden = document.createElement('input');
                inputHidden.type = 'hidden';
                inputHidden.name = divData.dataset.name + '_hidden';
                inputHidden.value = divData.innerText;

                form.appendChild(inputHidden);

                inputNew.addEventListener('keyup', function() {
                    inputHidden.value = inputNew.value;
                });

                divData.parentNode.replaceChild(inputNew, divData);
            }
        });

        let buttonEdit = document.getElementById('editarDieta-' + id);
        let buttonEditNew = document.createElement('button');
        buttonEditNew.type = 'submit';
        buttonEditNew.style.padding = '4px';
        buttonEditNew.style.borderRadius = '2px';
        buttonEditNew.style.backgroundColor = 'rgb(230, 182, 53)';
        buttonEditNew.style.cursor = 'pointer';
        buttonEditNew.setAttribute('form', 'form-' + id);
        buttonEditNew.innerText = 'Guardar';

        buttonEdit.parentNode.replaceChild(buttonEditNew, buttonEdit);
    }

</script>