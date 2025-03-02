    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Registro</title>
        <link rel="stylesheet" href="{{ asset('css/style3.css') }}" />
        <link
            href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
            rel="stylesheet"
        />
    </head>
    <body style="background: url({{ asset('storage/imagenes/login.jpg') }}) no-repeat; background-size: cover; background-position:center">
        <div class="wrapper">
            <form method="POST" action="{{route('register')}}">
                @csrf
                <h1>Registrate</h1>
                <div class="input-box">
                    <input type="text" placeholder="Nombre" name="name" required>
                    <br>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <br>
                    <input type="text" placeholder="Email" name="email" required>
                    <br>
                    <i class='bx bxs-user'></i>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <br>
                <br>
                <br>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <i class='bx bxs-lock-alt'></i>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="input-box">
                    <input type="password" name="password_confirmation" placeholder="Confirma la Contraseña" required>
                    <i class='bx bxs-lock-alt'></i>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                <button type="submit" class="btn">Registrate</button>

                <div class="register-link">
                    <p>¿Ya eres miembro?  <a
                        href="{{route('login')}}">Inicia sesión</a></p>
                </div>
            </form>
        </div>
        {{-- <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form> --}}
    </body>
    </html>


