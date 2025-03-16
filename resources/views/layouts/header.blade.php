<style>

</style>

<header class="header">
    <a href="#" class="Logo">
        <i class="fas fa-dumbbell"></i><b style="color: black">MuscleGym</b> </a
    >
    <nav class="navbar">
        <a href="{{route('principal')}}">Inicio</a>
        <!--Home-->
        @auth
            <a href="{{route('servicios.view')}}">Planes Alimenticios</a>
        @endauth
        @guest
            <a href="{{route('servicios.view')}}">Planes Alimenticios</a>
        @endguest
        <!--services-->
        @guest
            <a href="{{ route('formulario.contacto') }}">Contacto</a>
        @endguest
        @auth
            @if (Auth::user()->rol == 1)
                <a href="{{ route('reportes.view') }}">Reportes</a>
            @endif
        @endauth
        @auth
            <a href="{{ route('tienda.show') }}">Tienda</a>
        @endauth

        @auth
            <a href="{{ route('horarios.show') }}">Horarios</a>
        @endauth
        {{-- Rutinas --}}
        <a href="{{ route('rutinas.show') }}">Rutinas</a>
        <!--pricing-->
        <a href="#">|</a>

        <a style="text-align: center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#ffffff" d="M7 22q-.825 0-1.412-.587T5 20t.588-1.412T7 18t1.413.588T9 20t-.587 1.413T7 22m10 0q-.825 0-1.412-.587T15 20t.588-1.412T17 18t1.413.588T19 20t-.587 1.413T17 22M5.2 4h14.75q.575 0 .875.513t.025 1.037l-3.55 6.4q-.275.5-.737.775T15.55 13H8.1L7 15h11q.425 0 .713.288T19 16t-.288.713T18 17H7q-1.125 0-1.7-.987t-.05-1.963L6.6 11.6L3 4H2q-.425 0-.712-.288T1 3t.288-.712T2 2h1.625q.275 0 .525.15t.375.425z"/></svg>
        </a>

        @guest
            <a href="{{ route('login') }}" class="btn">Inicia sesión</a>
            <!--Login-->
            <a href="{{route('register')}}" class="btn"> Registrate</a>
        @endguest

        @auth
        <div class="dropdown">
            <button class="dropbtn">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-content">
                <a href="{{route('profile.edit')}}">Perfil</a>
                @if (Auth::user()->rol == 1)
                    <a href="{{route('encuesta.view')}}">Encuesta</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        Cerrar Sesion
                    </a>
                </form>
            </div>
          </div>
        @endauth

        <!--sign up-->
    </nav>
</header>
