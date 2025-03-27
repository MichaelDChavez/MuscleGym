@extends('layouts.layout')

@if ($message = Session::get('mensaggeHome'))
    <div style="position: fixed; right: 10px; bottom: 10px; background-color: tomato; padding: 20px; border-radius: 10px">
        <strong style="color:white">{{ $message }}</strong>
    </div>
@endif

@section('content')

<img src="{{ asset('storage/imagenes/index_.png') }}"
    alt="Fondo"
    style="position: absolute; top: 50; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; -webkit-box-shadow: 0px 15px 10px 0px rgba(120,120,120,1);-moz-box-shadow: 0px 15px 10px 0px rgba(120,120,120,1);box-shadow: 0px 15px 10px 0px rgba(120,120,120,1);">

<section class="home">
    <div class="max-width">
        <div class="home-content">
            <h3>Cada paso te llevará donde quieres estar.</h3>
            <p>
                ¡En el entreno no hay limites! Es momento de darla toda y sacar lo mejor de nosotros. Juntos, vamos a romperla y alcanzar nuestras metas. ¡Aprovecha nuestros beneficios!
            </p>
            @guest
                <a href="{{route('login')}}">
                    <button class="btn">¡Inscríbete!</button>
                </a>
            @endguest
            @auth
                <a href="{{route('membresias.show')}}">
                    <button class="btn">¡Inscríbete!</button>
                </a>
            @endauth
        </div>
    </div>
</section>

<div style="width: 100%; display: flex; gap: 50px; padding: 50px;">
    <h2 style="text-align: center; color: black; font-size: 50px; margin-block: auto;">Nuestros Planes</h2>
    <div style="width: 100%; padding-inline: 20px; display: grid; grid-template-columns: auto auto; gap: 10px;">
        <div style="width: 80%; background-color: rgba(224, 119, 27, 0.6); padding: 20px; margin-inline: auto; margin-block: 3px; border-radius: 10px;">
            <center>
                <img src="{{ asset('storage/imagenes/crossfit.png') }}" style="border-radius: 5px;" height="275" alt="Crossfit">
            </center>
            <h3>Crossfit</h3>
            <ul style="margin-left: 30px; margin-bottom: 50px">
                <li>Sistema de entrenamiento basados en ejercicios funcionales de alta intensidad.</li>
                <li>5 días Crossfit. </li>
            </ul>
        </div>
        <div style="width: 80%; background-color: rgba(224, 119, 27, 0.6); padding: 20px; margin-inline: auto; margin-block: 3px; border-radius: 10px;">
            <center>
                <img src="{{ asset('storage/imagenes/imagen1.jpeg') }}" style="border-radius: 5px;" height="275" alt="Crossfit">
            </center>
            <h3>Semipersonal</h3>
            <ul style="margin-left: 30px;">
                <li>Opción ideal para aquellos que buscan objetivos especificos combinando técnicas Crossfit. </li>
                <li>3 días de entrenamiento funcional.</li>
                <li>2 días Crossfit. </li>
            </ul>
        </div>
        <div style="width: 40%; background-color: rgba(224, 119, 27, 0.6); padding: 20px; margin-inline: auto; margin-block: 3px; border-radius: 10px; grid-column: span 2 / span 2;">
            <center>
                <img src="{{ asset('storage/imagenes/personalizado.jpg') }}" style="border-radius: 5px;" width="300" alt="Crossfit">
            </center>
            <h3>Personalizado</h3>
            <ul style="margin-left: 30px;">
                <li>Es la opción ideal para aquellos que buscan objetivos espeficificos con un entrenador personalizado durante todas sus rutinas. </li>
                <li>5 días de entrenamiento personalizado.</li>
            </ul>
        </div>
    </div>
</div>

<div style="width: 100%; gap: 50px; padding: 50px;">
    <h2 style="text-align: center; color: black; font-size: 50px; margin-block: auto;">Nuestra Sede</h2>
    {{-- <center> --}}
        <div style="display: grid; grid-template-columns: auto auto; width: 100%; gap: 15px;">
            <iframe style=" border: 1px solid rgb(191, 191, 191); border-radius: 5px; -webkit-box-shadow: 10px 10px 5px 0px rgba(130,130,130,1); -moz-box-shadow: 10px 10px 5px 0px rgba(130,130,130,1); box-shadow: 10px 10px 5px 0px rgba(130,130,130,1);" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.9939255636227!2d-74.12559642490697!3d4.595109942563695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f993de1ddf667%3A0xb71f305114e38553!2sLEVEL%20GYM!5e0!3m2!1ses-419!2sco!4v1742838426594!5m2!1ses-419!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div style="border-radius: 10px;">
                <img src="{{ asset('storage/imagenes/level.png') }}" style="object-fit: contain; width: 100%; height: 100%; border-radius: 5px;">
            </div>
        </div>
    {{-- </center> --}}
</div>

@endsection
