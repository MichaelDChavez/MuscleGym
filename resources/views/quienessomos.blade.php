@extends('layouts.layout')

@section('content')
<section class="home">
    <div class="max-width">
        <h1 style="color: black; font-size: 50px;">Quienes Somos</h1>

    </div>
    <div >
        <div style="background-color:  rgba(224, 119, 27, 0.6); padding: 20px; margin-inline: auto; margin-block: 3px; display: flex; border-radius: 10px;">
            <img src="{{ asset('storage/imagenes/imagen3.jpeg') }}" height="200" alt="vision" style="border-radius: 5px; margin-block: auto; margin-right: 10px;">
            <div style="margin-block: auto; text-align: justify;">
                <h2 style="color: white; font-size: 50px;">Misión</h2>
                <p style="font-size: 20px">Nos dedicamos a proporcionar un espacio inclusivo y motivador donde cada persona pueda superar sus propios límites a través del entrenamiento de CrossFit. Ofrecemos un ambiente profesional y dinámico, con entrenadores altamente capacitados que brindan atención personalizada para garantizar que cada miembro logre sus objetivos de manera eficiente, segura y con una actitud positiva. Nos comprometemos a fomentar una comunidad activa, fuerte y saludable, impulsando a cada individuo a alcanzar el siguiente nivel de rendimiento físico y bienestar.</p>
            </div>
        </div>

        <div style="background-color:  rgba(224, 119, 27, 0.6); padding: 20px; margin-inline: auto; margin-block: 3px; display: flex; border-radius: 10px;">
            <img src="{{ asset('storage/imagenes/vision.jpeg') }}" height="300" alt="vision" style="border-radius: 5px; margin-block: auto; margin-right: 10px;">
            <div style="margin-block: auto; text-align: justify;">
                <h2 style="color: white; font-size: 50px;">Visión</h2>
                <p style="font-size: 20px">En el 2026 ser el gimnasio de CrossFit líder en la localidad de Santa Rita, Bogotá, reconocido por su enfoque en el desarrollo integral de nuestros miembros, ofreciendo un entrenamiento de calidad, innovador y adaptado a las necesidades de cada persona. Nuestra visión es crear una comunidad sólida que inspire a las personas a llevar un estilo de vida más saludable y activo, destacándonos por nuestra excelencia, compromiso y el constante apoyo a los desafíos personales y deportivos de cada uno de nuestros atletas.</p>
            </div>
        </div>
    </div>
</section>
@endsection
