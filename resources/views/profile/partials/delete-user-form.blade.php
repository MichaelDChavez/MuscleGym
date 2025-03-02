<link rel="stylesheet" href="{{ asset('css/style2.css') }}" >


<div style="margin-top: 20px; border-radius: 20px; padding: 20px; border: 2px solid black; background-color:  rgba(224, 119, 27, 0.418);">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Eliminar Cuenta
        </h2>
    </header>

   <button class="btn" onclick="deleteConfirm()">Eliminar Cuenta</button>



   <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <button id="eliminar" type="submit" hidden>Eliminar Definitivamente</button>

   </form>
</div>

<script>
    function deleteConfirm(){
        const validate = confirm('¿Seguro desea eliminar su cuenta?')

        if(validate){
            const boton = document.getElementById('eliminar')
            boton.click()
        }
        else{
            alert('Se cancelan cambios')
        }
    }
</script>
