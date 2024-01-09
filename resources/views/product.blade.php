@extends('layouts.app')

@vite('resources/css/products.css')

@push('header')
    <script>
        function add_to_cart(id) {
            $.ajax({
                url: "{{route('cart.add')}}",
                method: "POST",
                data: {
                    productId: id,
                    quantity: 1,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    console.log(response);
                }
            })
        }

    </script>
@endpush

@section('content')

<div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            @if($product->image)
                <img class="card-img-top mb-5 mb-md-0" src="{{$product->image}}" alt="..."/>
            @else
                <img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="Product">
            @endif
        </div>
        <div class="col-md-6">
            <div class="small mb-1">{{$product->id}}</div>
            <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
            <div class="fs-5 mb-5">
                @if($product->isOnSale())
                    <span class="text-decoration-line-through">{{$product->cost}}zł</span>
                    <span>{{$product->saleCost}}zł</span>
                @else
                    <span>{{$product->cost}}zł</span>
                @endif
            </div>
            <p class="lead">{{$product->description}}</p>
            <div class="d-flex">
                <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem"/>
                <button class="btn btn-outline-dark flex-shrink-0" type="button">
                    <i class="bi-cart-fill me-1"></i>
                    Dodaj do koszyka
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
