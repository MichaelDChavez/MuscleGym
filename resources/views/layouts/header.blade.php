<style>

</style>

<header class="header">
    <a href="#" class="Logo">
        <i class="fas fa-dumbbell"></i><b style="color: black">MuscleGym</b> </a
    >
    <nav class="navbar">
        <a href="{{route('principal')}}" style="{{ request()->routeIs('principal') ? "border: 2px solid black; padding: 2px; border-radius: 5px; background-color: tomato" : "color: white" }}">Inicio</a>
        <!--Home-->
        @auth
            <a href="{{route('servicios.view')}}" style="{{ request()->routeIs('servicios.view') ? "border: 2px solid black; padding: 2px; border-radius: 5px; background-color: tomato" : "color: white" }}">Planes Alimenticios</a>
        @endauth
        @guest
            <a href="{{route('quienessomos.view')}}" style="{{ request()->routeIs('quienessomos.view') ? "border: 2px solid black; padding: 2px; border-radius: 5px; background-color: tomato" : "color: white" }}">Quienes Somos</a>
        @endguest
        <!--services-->
        @guest
            <a href="{{ route('formulario.contacto') }}" style="{{ request()->routeIs('formulario.contacto') ? "border: 2px solid black; padding: 2px; border-radius: 5px; background-color: tomato" : "color: white" }}">Contacto</a>
        @endguest
        @auth
            @if (Auth::user()->rol == 1)
                <a href="{{ route('reportes.view') }}" style="{{ request()->routeIs('reportes.view') ? "border: 2px solid black; padding: 2px; border-radius: 5px; background-color: tomato" : "color: white" }}">Reportes</a>
            @endif
        @endauth
        @auth
            <a href="{{ route('tienda.show') }}" style="{{ request()->routeIs('tienda.show') ? "border: 2px solid black; padding: 2px; border-radius: 5px; background-color: tomato" : "color: white" }}">Tienda</a>
        @endauth

        @auth
            <a href="{{ route('horarios.show') }}" style="{{ request()->routeIs('horarios.show') ? "border: 2px solid black; padding: 2px; border-radius: 5px; background-color: tomato" : "color: white" }}">Horarios</a>
        @endauth
        {{-- Rutinas --}}
        <a href="{{ route('rutinas.show') }}" style="{{ request()->routeIs('rutinas.show') ? "border: 2px solid black; padding: 2px; border-radius: 5px; background-color: tomato" : "color: white" }}">Rutinas</a>
        <!--pricing-->
        <a href="#">|</a>

        @auth
            @if (Auth::user()->rol == 2)
                <a class="btn" href="{{ route('carrito.show') }}" style="text-align: center;" href="#">
                    Carrito
                </a>
            @endif
        @endauth

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
                    <a href="{{route('registro.administrador.view')}}">Registro</a>
                    <a href="{{route('historial.medico.administrador')}}">Historial Medico</a>
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
