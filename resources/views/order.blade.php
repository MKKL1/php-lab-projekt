@extends('layouts.app')
@section('content')
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Szczegóły zakupu</h5>
                        </div>
                        <div class="card-body">
                            <p>Data {{$order->created_at}}</p>
                            <hr class="my-1"/>
                            <p>Status {{$order->status}}</p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Dane dostawy</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $detailsArray =
                                ['Imię' => $order->firstname,
                                'Nazwisko' => $order->lastname,
                                'Adres' => $order->address,
                                'Numer telefonu' => $order->phone];
                            @endphp
                            @foreach($detailsArray as $key => $value)
                                <div class="row">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <p>{{$key}}</p>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <p>{{$value}}</p>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Przedmioty</h5>
                        </div>
                        <div class="card-body">


                            @foreach($order->products as $product)
                                <div>
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">

                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <a href="{{ route('product', $product->id) }}">
                                                <img
                                                    src="{{asset($product->image->url())}}"
                                                    class="img-fluid rounded-3" alt="Product">
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <a href="{{ route('product', $product->id) }}">
                                                <h6 class="text-black mb-0">{{$product->name}}</h6>
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            {{$product->pivot->quantity}}
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">

                                            {{$product->pivot->cost}}
                                        </div>
                                    </div>
                                    <hr class="my-4"/>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
