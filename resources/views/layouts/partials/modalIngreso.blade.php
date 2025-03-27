<link rel="stylesheet" href="{{ asset('css/style3.css') }}" />


<div id="myModal" class="modal">

    @if ($message = Session::get('primerIngresoMensaje'))
        <div style="position: fixed; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
            <strong style="color:white">{{ $message }}</strong>
        </div>
    @endif

    <div class="modal-content">
        <form method="POST" action="{{ route("primerIngreso") }}" enctype="multipart/form-data" >
            <h2 style="color: white">Formulario Inicial</h2><br>
            @csrf
            <div class="input-box">
                <span style="color: white; margin-left: 20px;">Fecha de Nacimiento</span>
                <input id="fechaNacimiento" type="date" title="Fecha de Nacimiento" placeholder="Fecha de Nacimiento" name="fechaNacimiento" required>
                <br>
                <x-input-error :messages="$errors->get('fechaNacimiento')" class="mt-2" />
                <br>
                <select name="genero" required>
                    <option style="color: black" value="">Seleccione su género...</option>
                    <option style="color: black" value="M">Masculino</option>
                    <option style="color: black" value="F">Femenino</option>
                    <option style="color: black" value="Otro">Otro</option>
                </select>
                <br>
                <x-input-error :messages="$errors->get('genero')" class="mt-2" />
                <br>
                <input type="number" minlength="10" maxlength="10" placeholder="Télefono o Celular" name="telefono" required>
                <br>
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                <br>
                <input type="text" placeholder="Direccion" name="direccion" required>
                <br>
                <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                <br>
                <span style="color: white">¿Cuenta con alguna restriccion médica?</span><br>
                <div class="display: flex;">
                    <span style="margin-left: 20px; color: white; width: 30px; display: flex;">
                        <input type="radio" onclick="document.getElementById('servicio_salud').disabled = false; document.getElementById('fileSalud').style.display = 'block'" name="validate" id="si" value="si"> Sí
                    </span>
                    <span style="margin-left: 20px; color: white; width: 38px; display: flex;">
                        <input type="radio" onclick="document.getElementById('servicio_salud').disabled = true; document.getElementById('servicio_salud').value = ''; document.getElementById('fileSalud').style.display = 'none'" name="validate" id="no" value="no"> No
                    </span><br>
                </div>
                <textarea id="servicio_salud" disabled name="servicio_salud" placeholder="Especifique que restricciones" style="resize: vertical; height: 100px"></textarea> <br><br>
                <input id="fileSalud" type="file" name="file" style="display: none">
                <button type="submit" class="btn">Terminar</button>
            </div>
        </form>
    </div>
</div>

<script>
    const hoy = new Date();
    hoy.setFullYear(hoy.getFullYear() - 14);

    document.getElementById('fechaNacimiento').max = hoy.toISOString().split('T')[0];
</script>

<style>
    .modal {
        display: block;
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
        margin: auto;
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
