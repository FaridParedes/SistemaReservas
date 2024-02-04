<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="https://www.itca.edu.sv/wp-content/themes/elaniin-itca/images/favicon.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" width="200">
                    <img src="{{ asset('img/LogoLaboratorios.jpg') }}" alt="logo" width="75">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/home">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/reservas/crear">Crear Reserva</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/reservas/show">Mis Reservas</a>
                            </li>

                            @if(Auth::user()->idRoles == 1 )
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active" href="#" role="button"
                                        data-bs-toggle="dropdown">
                                        Administrar
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/usuarios/show">Gestionar Usuarios</a></li>
                                        <li><a class="dropdown-item" href="/reservas/gestionar">Gestionar Reservas</a></li>
                                        <li><a class="dropdown-item" href="/modulos/show">Gestionar Módulos</a></li>
                                        <li><a class="dropdown-item" href="/laboratorios">Gestionar Laboratorios</a></li>
                                    </ul>
                                </li>
                            @endif
                            
                            @if(Auth::user()->idRoles == 1 )
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active" href="#" role="button"
                                        data-bs-toggle="dropdown">
                                        Recursos
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/equipos/show">Gestionar Equipos</a></li>
                                        <li><a class="dropdown-item" href="/herramientas/show">Gestionar Herramientas</a></li>
                                        <li><a class="dropdown-item" href="/materialGastable/show">Gestionar Material Gastable</a></li>
                                    </ul>
                                </li>
                            @endif
                            
                            

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/cuenta">
                                        Mi cuenta
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
