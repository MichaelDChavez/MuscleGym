<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}" />
    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet"
    />
</head>
<body style="background: url({{ asset('storage/imagenes/login.jpg') }}) no-repeat; background-size: cover; background-position:center">
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    

    <div class="wrapper">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Inicia sesión</h1>
            <div class="input-box">
                <input
                    type="text"
                    placeholder="Correo Electronico"
                    name="email"
                    required
                />
                <i class="bx bxs-user"></i>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            
            <div class="input-box">
                <input type="password" placeholder="Contraseña" name="password" required />
                <i class="bx bxs-lock-alt"></i>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <div class="remember-forgot">
                <label><input type="checkbox" name="remember" />Recuerdame</label>
                <a href="#">Olvidaste la contraseña?</a>
            </div>

            <button type="submit" type="button" class="btn">Iniciar</button>

            <div class="register-link">
                <p>
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}">Registrate</a>
                </p>
            </div>
        </form>
    </div>


    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf
    
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
    
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
    
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
    
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
    
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
    
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
</body>
</html>
