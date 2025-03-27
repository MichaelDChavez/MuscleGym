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
        <form method="POST" action="{{ route('new.password') }}">
            @csrf
            <h1>Nueva Contraseña</h1>
            <br>
            <label style="text-align: center">Ingresa el correo que tienes registrado</label>
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

            <button type="submit" type="button" class="btn">Iniciar</button>
        </form>
        <br>
        <center>
            <a style="color: white; text-decoration: none;" href="{{ route('login') }}">
                Volver al inicio de sesión
            </a>
        </center>
    </div>
</body>
@if ($message = Session::get('errorEmail'))
    <div style="margin: 20px; position: fixed; right: 0; bottom: 0; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif
</html>

