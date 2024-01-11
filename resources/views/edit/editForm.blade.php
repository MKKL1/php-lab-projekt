@extends('layouts.app')

{{--TODO bad idea https://stackoverflow.com/questions/51667233/single-form-for-insert-and-update-data--}}
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{session()->get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif

    @error('id')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                <form method="post" action="@yield('action')" class="form">
                    @csrf
                    @yield('input')
                    <div class="mb-3">
                        <label class="col-form-label" for="formProductName">Nazwa</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name) }}" placeholder="Nazwa przedmiotu" id="formProductName"/>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label" for="formProductPrice">Cena*</label>
                        <input type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost', $product->cost) }}" placeholder="19.99" id="formProductPrice" />
                        @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label" for="formProductSale">Przecena</label>
                        <input type="text" class="form-control @error('saleCost') is-invalid @enderror" name="saleCost" value="{{ old('saleCost', $product->saleCost) }}" placeholder="19.99" id="formProductSale" />
                        @error('saleCost')
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label" for="formProductQuantity">Quantity</label>
                        <input type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="1" id="formProductQuantity" />
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label" for="formProductDesc">Opis</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Opis przedmiotu" id="formProductDesc">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{--                        <div class="mb-3">--}}
                    {{--                            <label class="col-form-label" for="formProductRating">(Ocena)</label>--}}
                    {{--                            <input  type="text" class="form-control" name="product_rating" placeholder="4" id="formProductRating" />--}}
                    {{--                        </div>--}}

                    <div class="mb-3">
                        <label class="col-form-label" for="formProductImage">Zdjęcie</label>
                        <input type="text" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image', $product->image) }}" placeholder="Ścieżka do pliku..." id="formProductImage" />
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="modal-footer d-flex">
                        <a type="button" class="btn btn-secondary" href="{{route('edit.index')}}">Zamknij</a>
                        <button type="submit" class="btn btn-primary">Zapisz przedmiot</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
