<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/">DzbanSklep</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/" data-link>Strona główna</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('products')}}" data-link>Sklep</a></li>
                <li class="nav-item"><a class="nav-link" href="/edit" data-link>Edycja</a></li>
            </ul>
            <a href="{{route('cart.index')}}" class="btn btn-outline-dark">
                <i class="bi-cart-fill me-1"></i>
                Koszyk
                <span class="badge bg-dark text-white ms-1 rounded-pill">{{$shopping_cart_count}}</span>
            </a>
        </div>
    </div>
</nav>
