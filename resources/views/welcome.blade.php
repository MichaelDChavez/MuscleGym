@extends('layouts.layout')

@section('content')
    <section class="home">
        <div class="max-width">
            <div class="home-content">
                <h3>El exceso de entreno es bueno pa' la salud</h3>
                <p>
                    ¡En el entreno no hay limites!. Es momento de darla toda
                    y sacar lo mejor de nosotros.Juntos!, vamos a romperla y
                    alcanzar nuestras metras! Aprovecha nuestros beneficios.
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
            {{-- <div class="home-image">
                <img src="imagenes/platano.jpg" alt="" />
            </div> --}}
        </div>
    </section>
@endsection