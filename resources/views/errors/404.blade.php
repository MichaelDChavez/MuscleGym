<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pagina no encontrada</title>
        <link rel="stylesheet" href="{{ asset('css/style4.css') }}" />
        <link rel="icon" href="/imagenes/logo/icon.png" />
    </head>
    <body>
        <section id="container">
            <h1 class="heading">404</h1>
            <h3 class="sub-heading">¡Ups! página no encontrada</h3>
            <article>
                Lo sentimos, la página que estas buscando no fue encontrada.
            </article>
            <div class="buttons">
                <div class="buttons">
                    <a href="{{ route('principal') }}">
                        <button class="btn active">Regresar</button>
                    </a>
                </div>
            </div>
        </section>
    </body>
</html>
