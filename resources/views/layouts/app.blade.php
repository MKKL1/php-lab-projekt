<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('header')
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        <nav class="navbar navbar-dark navbar-expand-md bg-dark justify-content-center">
            <div class="container-fluid px-4 px-lg-5">
                <a class="navbar-brand d-flex w-50 mr-auto" href="{{route('home')}}">DzbanSklep</a>

                <button class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse w-100" id="navbarSupportedContent">

                    <ul class="navbar-nav w-100 justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}" aria-current="page" href="{{route('home')}}">Strona główna</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('products') ? 'active' : '' }}" aria-current="page" href="{{route('products')}}">Produkty</a>
                        </li>

                        @guest
                            <li class="nav-item {{ Route::currentRouteNamed('auth.login') ? 'active' : '' }}">
                                <a class="nav-link" aria-current="page" href="{{route('login')}}">Logowanie</a>
                            </li>

                            <li class="nav-item {{ Route::currentRouteNamed('auth.register') ? 'active' : '' }}">
                                <a class="nav-link" aria-current="page" href="{{route('register')}}">Rejestracja</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{Auth::user()->name}}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                                    <li><a class="dropdown-item" href="{{ route('orders.index') }}">Historia zamówień</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Wyloguj
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                            @can('update-products')
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteNamed('edit.index') ? 'active' : '' }}" aria-current="page" href="{{route('edit.index')}}">Edycja przedmiotów</a>
                                </li>
                            @endcan
                        @endguest
                    </ul>
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                        @guest
                        @else
                            <li class="nav-item">
                                <a href="{{route('cart.index')}}" class="btn btn-outline-light d-inline-flex">
                                    <i class="fas fa-cart-shopping me-1 mt-1"></i>Koszyk
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="py-2 bg-dark mt-auto">
            <div class="container"><p class="m-0 text-center text-white">KZ&copy;</p></div>
        </footer>
    </div>
</body>
</html>
