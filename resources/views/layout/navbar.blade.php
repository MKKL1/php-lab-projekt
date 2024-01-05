{{--<nav class="navbar navbar-expand-lg navbar-light bg-light">--}}
{{--    <div class="container px-4 px-lg-5">--}}
{{--        <a class="navbar-brand" href="/">DzbanSklep</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">--}}
{{--                <li class="nav-item"><a class="nav-link" aria-current="page" href="/" data-link>Strona główna</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="{{route('products')}}" data-link>Sklep</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="/edit" data-link>Edycja</a></li>--}}
{{--            </ul>--}}
{{--            <a href="{{route('cart.index')}}" class="btn btn-outline-dark">--}}
{{--                <i class="bi-cart-fill me-1"></i>--}}
{{--                Koszyk--}}
{{--                <span class="badge bg-dark text-white ms-1 rounded-pill">{{$shopping_cart_count}}</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">--}}
{{--    <div class="container-fluid px-4 px-lg-5">--}}
{{--        <a class="navbar-brand" href="{{route('home')}}">DzbanSklep</a>--}}
{{--        <button class="navbar-toggler"--}}
{{--                type="button"--}}
{{--                data-bs-toggle="collapse"--}}
{{--                data-bs-target="#navbarSupportedContent"--}}
{{--                aria-controls="navbarSupportedContent"--}}
{{--                aria-expanded="false"--}}
{{--                aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--            <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}" aria-current="page" href="{{route('home')}}">Home</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{ Route::currentRouteNamed('products') ? 'active' : '' }}" href="{{route('products')}}">Products</a>--}}
{{--                </li>--}}

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{route('cart.index')}}" class="btn btn-outline-light d-inline-flex">--}}
{{--                    <i class="bi-cart-fill me-1"></i>Koszyk--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                    Dropdown--}}
{{--                </a>--}}
{{--                <ul class="dropdown-menu" aria-labelledby="accountDropdown">--}}
{{--                    <li><a class="dropdown-item" href="#">Action</a></li>--}}
{{--                    <li><a class="dropdown-item" href="#">Another action</a></li>--}}
{{--                    <li><hr class="dropdown-divider"></li>--}}
{{--                    <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

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
                    <a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}" aria-current="page" href="{{route('home')}}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteNamed('products') ? 'active' : '' }}" aria-current="page" href="{{route('products')}}">Products</a>
                </li>

                @guest
                    <li class="nav-item {{ Route::currentRouteNamed('login') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('login')}}">Login</a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed('register') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('register')}}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest


            </ul>



            <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                <li class="nav-item">
                    <a href="{{route('cart.index')}}" class="btn btn-outline-light d-inline-flex">
                        <i class="bi-cart-fill me-1"></i>Koszyk
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
