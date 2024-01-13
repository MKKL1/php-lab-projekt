@extends('layouts.app')

@push('header')
    @vite('resources/sass/products.scss')
    <script type="module">
        $(".cart-button").one("click", function() {
            const button = $(this);
            $.ajax({
                url: "{{route('cart.update')}}",
                method: "POST",
                data: {
                    items: [
                        {
                            productId: $(this).attr('productId'),
                            quantity: 1,
                        }
                    ],
                    _token: '{{csrf_token()}}'
                    },
                success: function (response) {
                    console.log(response);
                    button.addClass('bought').text('Dodano do koszyka').prop('disabled', true);
                }
            })
        });


    </script>
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                <div id="shopProducts">

                    @foreach($paginator as $product)
                        <div class="col">
                            <div class="row p-2 bg-white border rounded mt-2">
                                <div class="col-md-3 mt-1 fill">
                                    <a href="{{route('product', ['productId' => $product])}}">
                                    @if($product->image)
                                        <img class="img-fluid img-responsive rounded product-image" src="{{$product->image}}" alt="Product">
                                    @else
                                        <img class="img-fluid img-responsive rounded product-image" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="Product">
                                    @endif
                                    </a>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <a href="{{route('product', ['productId' => $product])}}"><h5>{{$product->name}}</h5></a>
                                    <div class="d-flex flex-row">
                {{--                        {{#if product_rating}}--}}
                {{--                        <div class="ratings mr-2">--}}
                {{--                            {{#starsshop product_rating}}{{/starsshop}}--}}
                {{--                        </div>--}}
                {{--                        {{/if}}--}}
                                    </div>
                                    <p class="para mb-0 description">{{$product->description}}<br><br></p>
                                </div>
                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                    <div class="d-flex flex-row align-items-center">

                                        @if($product->isOnSale())
                                            <h4 class="mr-1">{{$product->saleCost}}zł</h4>
                                            <span class="strike-text">{{$product->cost}}zł</span>
                                        @else
                                            <h4 class="mr-1">{{$product->cost}}zł</h4>
                                        @endif
                                    </div>
                                    <h6 class="text-success">Darmowa dostawa od 30zł</h6>
                                    <div class="d-flex flex-column mt-4">
                                        <button class="cart-button btn btn-outline-primary btn-sm" productId="{{$product->id}}">
                                            Dodaj do koszyka
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $paginator->links('pagination.default') }}



            </div>

        </div>
    </div>

@endsection
