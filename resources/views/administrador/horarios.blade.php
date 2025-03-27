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

@if ($message = Session::get('horarioMessage'))
    <div style="position: fixed; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
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
                    <th>Horario</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
                @foreach ($horarios as $horario)
                    <form id="form-{{$horario->id}}" method="POST" action='{{ route("editar.horario", "$horario->id") }}'>
                    </form>
                    <tr>
                        <td>
                            <div data-Name="horario" class="horario-{{$horario->id}}-horario">
                                {{ $horario->horario }}
                            </div>
                        </td>
                        <td>
                            <div data-Name="inicio" class="horario-{{$horario->id}}-inicio">
                                {{ $horario->inicio }}
                            </div>
                        </td>
                        <td>
                            <div data-Name="fin" class="horario-{{$horario->id}}-fin">
                                {{ $horario->fin }}
                            </div>
                        </td>
                        <td>
                            <div data-Name="descripcion" class="horario-{{$horario->id}}-descripcion">
                                {{ $horario->descripcion }}
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; gap: 4px;">
                                <button type="button" id="editarHorario-{{$horario->id}}" onclick="editar('{{$horario->id}}')" style="padding: 4px; border-radius: 2px; background-color: rgb(230, 182, 53); cursor: pointer;">Editar</button>
                                <form method="POST" action="{{ route('borrar.horario', $horario->id) }}">
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
            'horario',
            'inicio',
            'fin',
            'descripcion',
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
            let initTag = document.getElementsByClassName('horario-' + id + '-' + field);

            for (let i = 0; i < initTag.length; i++) {
                let divData = initTag[i];

                let inputNew = document.createElement('input');
                inputNew.name = divData.dataset.name;
                inputNew.value = divData.innerText;

                if(divData.dataset.name == 'inicio' || divData.dataset.name == 'fin')
                    inputNew.type = "time"
                else
                    inputNew.type = 'text';
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

        let buttonEdit = document.getElementById('editarHorario-' + id);
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
