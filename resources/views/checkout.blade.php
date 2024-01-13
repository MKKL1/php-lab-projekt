@extends('layouts.app')
@section('content')
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Dane odbiorcy</h5>
                        </div>
                        <div class="card-body">
                            <form id="checkoutForm" method="POST" action="{{ route('checkout.order') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="text"
                                           id="firstnameInput"
                                           class="form-control @error('firstname') is-invalid @enderror"
                                           name="firstname"
                                           value="{{ old('firstname') }}"
                                           placeholder="Imie"
                                           required/>

                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text"
                                           id="lastnameInput"
                                           class="form-control @error('lastname') is-invalid @enderror"
                                           name="lastname"
                                           value="{{ old('lastname') }}"
                                           placeholder="Nazwisko"
                                           required/>

                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text"
                                           id="addressInput"
                                           class="form-control @error('address') is-invalid @enderror"
                                           name="address"
                                           value="{{ old('address') }}"
                                           placeholder="Adres"
                                           required/>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text"
                                           id="phoneInput"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="Nr telefonu"
                                           required/>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Przedmioty</h5>
                        </div>
                        <div class="card-body">
                            @foreach($cart->products as $product)
                                <div productId="{{$product->id}}" class="productBase">
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-black mb-0">{{$product->name}}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <h6 class="text-black mb-0">x{{$product->pivot->quantity}}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">

                                            <h6 class="mb-0">{{$product->calculatedPrice()}} zł</h6>
                                            @if($product->isOnSale())
                                                <h6 class="mb-0"><s>{{$product->cost}} zł</s></h6>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="my-4"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Metoda płatności</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Zakup opłacony</strong></p>
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
                                    <span><div id="productPrice">{{$totalCost}} zł</div></span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Including discount
                                    <span><div id="productPrice">{{$totalSaleCost}} zł</div></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Shipping
                                    <span>0 zł</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total amount</strong>
                                        <strong>
                                            <p class="mb-0">(including VAT)</p>
                                        </strong>
                                    </div>
                                    <span><strong><div id="totalPrice">{{$totalSaleCost * 1.3}} zł</div></strong></span>
                                </li>
                            </ul>

                            <button type="submit" form="checkoutForm" class="btn btn-primary btn-lg btn-block">
                                Zamów
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
