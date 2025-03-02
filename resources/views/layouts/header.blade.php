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
            @if(Auth::user()->rol == 2)
                <a href="{{route('servicios.view')}}">Servicios</a>
            @endif
        @endauth
        @guest
            <a href="{{route('servicios.view')}}">Servicios</a>
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
        <!--contact-->
        @guest
            <a href="error500.html">Nosotros</a>
        @endguest

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
