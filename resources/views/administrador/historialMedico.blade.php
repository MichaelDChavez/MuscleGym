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
    <h2 style="margin-top: 100px; margin-bottom: 0; text-align: center;">Historial Medico</h2>
    <input id="searchBox" placeholder="Buscar..." type="text" style="height: 40px; border-radius: 5px; padding: 5px; margin-inline: 30%; border: 1px solid black; width: 40vw; ">
    <section class="home" style="margin-top: 0">
        <div class="max-width">
            <div style="display: flex; gap: 20px; width: 75vw; overflow: auto;">
                <table id="filData">
                    <tr>
                        <th>Cliente</th>
                        <th>Historial Medico</th>
                        <th>Foto</th>
                    </tr>
                    @foreach ($historial as $h)
                        <tr class="filInit">
                            <td class="nameUser">
                                {{ $h->name }}
                            </td>
                            <td>
                                {{ $h->Historial_Medico }}
                            </td>
                            @if (!empty($h->Foto))
                                <td>
                                    <a target="_blank" href="{{ Storage::url($h->Foto) }}">
                                        <img src="{{ Storage::url($h->Foto) }}" alt="{{ $h->Historial_Medico }}-Foto" width="150">
                                    </a>
                                </td>
                            @else
                                <td>No adjunta foto</td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection

<script>
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
