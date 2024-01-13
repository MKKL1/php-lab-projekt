@extends('layouts.app')
@push('header')
    <script>
        var timerId;
        var throttleFunction = function (func, delay) {
            if (timerId) {
                return
            }
            timerId = setTimeout(function () {
                func()
                timerId = undefined;
            }, delay)
        }

        function selectProductBase(element) {
            return $(element).closest('.productBase');
        }

        function remove(element) {
            const base = selectProductBase(element);
            const id = base.attr('productId');
            $.ajax({
                url: "{{route('cart.remove')}}",
                method: "POST",
                data: {
                    productId: id,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    console.log(response);
                    base.remove();
                    location.reload();
                }
            })
        }

        //TODO Limit server-side as well
        //TODO: cache and send all at once
        function update_quantity(element) {
            throttleFunction(function () {
                const base = selectProductBase(element);
                const id = base.attr('productId');
                const quantity = base.find('input[name=quantity]').val();
                console.log(quantity);
                $.ajax({
                    url: "{{route('cart.update')}}",
                    method: "POST",
                    data: {
                        items: [
                            {
                                productId: id,
                                quantity: quantity,
                            }
                        ],
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    }
                })
            }, 500);
        }

    </script>
@endpush
@section('content')

    @if(session()->has('error'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{session()->get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Koszyk - {{$cart->products->count()}} przedmiotów</h5>
                        </div>
                        <div class="cart-products card-body">


                            @foreach($cart->products as $product)
                                <div productId="{{$product->id}}" class="productBase">
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img
                                                src="{{$product->image}}"
                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-black mb-0">{{$product->name}}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown(); update_quantity(this)">
                                                <i class="fas fa-minus-circle"></i>
                                            </button>

                                            <input min="1" name="quantity" value="{{$product->pivot->quantity}}"
                                                   type="number"
                                                   class="form-control form-control-sm"/>

                                            <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp(); update_quantity(this)">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">

                                            <h6 class="mb-0">{{$product->calculatedPrice()}} zł</h6>
                                            @if($product->isOnSale())
                                                <h6 class="mb-0"><s>{{$product->cost}} zł</s></h6>
                                            @endif
                                        </div>
                                        <button onclick="remove(this)" class="btn px-2 col-md-1 col-lg-1 col-xl-1">
                                            <i class="fas fa-x"></i>
                                        </button>
                                    </div>
                                    <hr class="my-4"/>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <p><strong>Expected shipping delivery</strong></p>
                            <p class="mb-0">{{ $expectedDeliveryStart->format('d.m.Y') }}
                                - {{ $expectedDeliveryEnd->format('d.m.Y') }}</p>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body">
                            <p><strong>We accept</strong></p>
                            <img class="me-2" width="45px"
                                 src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                                 alt="Visa"/>
                            <img class="me-2" width="45px"
                                 src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                                 alt="American Express"/>
                            <img class="me-2" width="45px"
                                 src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                                 alt="Mastercard"/>
                            <img class="me-2" width="45px"
                                 src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
                                 alt="PayPal acceptance mark"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Podsumowanie</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Cena
                                    <span><div id="productPrice">{{$totalCost}} zł</div></span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Cena z rabatem
                                    <span><div id="productPrice">{{$totalSaleCost}} zł</div></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Wysyłka
                                    <span>0 zł</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Całkowity koszt</strong>
                                    </div>
                                    <span><strong><div id="totalPrice">{{$totalSaleCost}} zł</div></strong></span>
                                </li>
                            </ul>

                            <a href="{{ route('checkout.index') }}" class="@if($cart->products->isEmpty()) disabled @endif btn btn-primary btn-lg btn-block">
                                Dostawa i płatność
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
