@extends('layouts.layout')
<link rel="stylesheet" href="{{ asset('css/style3.css') }}" />
@if ($message = Session::get('mensajeRegistro'))
    <div style="margin: 20px; position: fixed; right: 0; bottom: 0; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif
@section('content')
    <body style="background: url({{ asset('storage/imagenes/login.jpg') }}) no-repeat; background-size: cover; background-position:center">
        <div class="wrapper" style="margin-top: 80px">
            <form method="POST" action="{{route('registro.administrador.store')}}">
                @csrf
                <div class="input-box">
                    <input type="text" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" placeholder="Nombre" name="name" required>
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

                <div class="input-box">
                    <select name="rol" required>
                        <option style="color: black" value="">Seleccione un rol...</option>
                        <option style="color: black" value="1">Administrador</option>
                        <option style="color: black" value="2">Usuario</option>
                    </select>
                </div>


                <button type="submit" class="btn">Registro</button>
            </form>
        </div>
    </body>
@endsection
