<link rel="stylesheet" href="{{ asset('css/style2.css') }}" >

<style>
    #snackbar {
  visibility: hidden; /* Hidden by default. Visible on click */
  min-width: 250px; /* Set a default minimum width */
  margin-left: -125px; /* Divide value of min-width by 2 */
  background-color: #333; /* Black background color */
  color: #fff; /* White text color */
  text-align: center; /* Centered text */
  border-radius: 2px; /* Rounded borders */
  padding: 16px; /* Padding */
  position: fixed; /* Sit on top of the screen */
  z-index: 1; /* Add a z-index if needed */
  left: 50%; /* Center the snackbar */
  bottom: 30px; /* 30px from the bottom */
}

/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show {
  visibility: visible; /* Show the snackbar */
  /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>

{{-- <section> --}}
    <div style="margin-top: 20px; border-radius: 20px; background-color:  rgba(224, 119, 27, 0.418); padding: 20px; border: 2px solid black">
        <hr >

        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Actualizar Contraseña
            </h2>
        </header>
    
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')
    
            <div class="input-box">
                <input
                    placeholder="Contraseña Actual"
                    name="current_password"
                    type="password"
                    required
                />
                <i class="bx bxs-user"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            <br>
            <div class="input-box">
                <input
                    placeholder="Contraseña Nueva"
                    name="password"
                    type="password"
                    required
                />
                <i class="bx bxs-user"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            <br>
            <div class="input-box">
                <input
                    placeholder="Confirmar Contraseña"
                    name="password_confirmation"
                    type="password"
                    required
                />
                <i class="bx bxs-user"></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            <br>
            <div style="display: flex; align-items: center; gap: 10px">
                {{-- <x-primary-button>{{ __('Save') }}</x-primary-button> --}}
                <button type="submit" type="button" class="btn">Actualizar</button>
    
                @if (session('status') === 'password-updated')
                    <p>Guardado</p>
                @endif
            </div>
        </form>
    </div>
{{-- </section> --}}
