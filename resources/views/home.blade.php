@extends('layouts.app')

@section('content')

    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Sklep antyczny</h1>
                <p class="lead fw-normal text-white-50 mb-0">Najlepszy sklep z dzbanami</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="homeProducts">
                @foreach($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            @if($product->isOnSale())
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            @endif
                            <!-- Product image-->
                            @if($product->image)
                                <img class="card-img-top img img-responsive" src="{{$product->image->url()}}" alt="..." />
                            @else
                                <img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="Product">
                            @endif
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$product->name}}</h5>
{{--                                    {{#if product_rating}}--}}
{{--                                    <div class="d-flex justify-content-center small text-warning mb-2">--}}
{{--                                        {{#stars product_rating}}{{/stars}}--}}
{{--                                    </div>--}}
{{--                                    {{/if}}--}}
                                    <!-- Product price-->
                                    @if($product->isOnSale())
                                        <span class="text-muted text-decoration-line-through">{{$product->cost}}zł</span>
                                        {{$product->saleCost}}zł
                                    @else
                                        {{$product->cost}}zł
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('product', $product->id)}}">Szczegóły</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
