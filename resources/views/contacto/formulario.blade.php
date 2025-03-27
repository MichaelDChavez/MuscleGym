@extends('layouts.layout')

@if ($message = Session::get('contacto'))
    <div style="position: fixed; right: 10; bottom: 10; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style3.css') }}" />

    <section class="home" style="background-color: black; padding: 20px; border-radius: 20px; margin-block: 100px;">
        <form method="POST" action="{{ route("envio.contacto") }}">
            <h2 style="color: white">Formulario de Contacto</h2><br>
            @csrf
            <div class="input-box">

                <input type="text" placeholder="Nombre Completo" name="nombre" required>
                <br>
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                <br>

                <input type="email" placeholder="Email" name="email" required>
                <br>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <br>

                <input type="celular" placeholder="Celular" name="celular" required>
                <br>
                <x-input-error :messages="$errors->get('celular')" class="mt-2" />
                <br>

                <span style="color: white; margin-left: 20px;">Medio de contacto principal</span>
                <select name="medioContacto" required>
                    <option style="color: black" value="">Seleccione su medio de contacto...</option>
                    <option style="color: black" value="whatsapp">Whatsapp</option>
                    <option style="color: black" value="email">Email</option>
                </select>
                <br>
                <x-input-error :messages="$errors->get('medioContacto')" class="mt-2" />
                <br>
                <button type="submit" class="btn">Contactanos</button>
            </div>
        </form>
    </section>

@endsection
