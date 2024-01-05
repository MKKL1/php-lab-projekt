@extends('layout.app')
@push('header')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@section('content')
<section class="h-100 gradient-custom">
    <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Cart -  items</h5>
                    </div>
                    <div class="card-body">


                        @foreach($cartData as $id => $value)
                            @php
                                $product = $value['product'];
                            @endphp
                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img
                                        src="{{$product->image}}"
                                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
{{--                                    <h6 class="text-muted">Shirt</h6> KATEGORIA--}}
                                    <h6 class="text-black mb-0">{{$product->name}}</h6>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <button class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); update_price()">
                                        <i class="bi bi-dash-circle"></i>
                                    </button>

                                    <input id="{{$id}}" min="1" name="quantity" value="{{$value['quantity']}}" type="number"
                                           class="form-control form-control-sm"/>

                                    <button class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); update_price()">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h6 class="mb-0">{{$product->realPrice()}} zł</h6>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a href="#!" class="text-muted"><i class="bi bi-x"></i></a>
                                </div>
                            </div>
                            <hr class="my-4"/>
                        @endforeach

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Expected shipping delivery</strong></p>
                        <p class="mb-0">12.10.2020 - 14.10.2020</p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body">
                        <p><strong>We accept</strong></p>
                        <img class="me-2" width="45px"
                             src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                             alt="Visa" />
                        <img class="me-2" width="45px"
                             src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                             alt="American Express" />
                        <img class="me-2" width="45px"
                             src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                             alt="Mastercard" />
                        <img class="me-2" width="45px"
                             src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
                             alt="PayPal acceptance mark" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Products
                                NEEDS TO BE UPDATED
                                <span><div id="productPrice">{{$price}} zł</div></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Shipping
                                <span>Gratis</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total amount</strong>
                                    <strong>
                                        <p class="mb-0">(including VAT)</p>
                                    </strong>
                                </div>
                                <span><strong><div id="totalPrice">{{$price}} zł</div></strong></span>
                            </li>
                        </ul>

                        <button type="button" class="btn btn-primary btn-lg btn-block">
                            Go to checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script>
        //Or save in cookies
        //Also too complicated
        data = {!! json_encode($cartData, JSON_HEX_TAG) !!};
        function update_price(cartData = data) {
            console.log('update');
            let sum = 0;
            for (const key in cartData) {
                const obj = cartData[key];
                const product = obj['product'];
                const quantity = $('#' + key).filter('input[name="quantity"]').val();
                const isSale = !jQuery.isEmptyObject(product['saleCost']);
                const cost = isSale ? product['saleCost'] : product['cost'];
                sum += cost * quantity;
            }
            $('#totalPrice,#productPrice').text(sum.toFixed(2) + " zł");
        }
    </script>
@endpush
