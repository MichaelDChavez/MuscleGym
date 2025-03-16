<link rel="stylesheet" href="{{ asset('css/style3.css') }}" />


<div id="modalProductos" class="modal">

    <div class="modal-content">
        <form method="POST" action="{{ route("pago.productos") }}" enctype="multipart/form-data" >
            <div style="display: flex; justify-content: space-between;">
                <h2 style="color: white">Formulario de Pago</h2>
                <div style="color: white; cursor: pointer;" onclick="document.getElementById('modalProductos').style.display = 'none';">Cerrar</div>
            </div>
            <br>
            @csrf
            <input style="color: white" type="file" name="file" id="file">
            <br><br>
            <button style="padding: 5px; background-color: rgb(81, 219, 81); border-radius: 5px;">Generar Pago</button>
        </form>
    </div>
</div>


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