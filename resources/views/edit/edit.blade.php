@extends('layouts.app')
@push('header')
    @vite('resources/sass/edit.scss')
@endpush
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 mb-lg-5">
                <div class="overflow-hidden card table-nowrap table-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Produkty</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>Nazwa</th>
                                <th>ID</th>
                                <th>Cena</th>
                                <th class="text-end">Akcja</th>
                            </tr>
                            </thead>
                            <tbody id="products">
                            @foreach($paginator as $product)

                                <tr class="align-middle">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($product->image)
                                                <img class="thumbnail me-3 rounded flex-shrink-0" src="{{$product->image}}" alt="Product">
                                            @else
                                                <img class="thumbnail me-3 rounded flex-shrink-0" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="Product">
                                            @endif
                                            <div>
                                                <div class="h6 mb-0 lh-1">{{$product->name}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$product->id}}</td>
                                    <td><span class="d-inline-block align-middle">{{$product->realPrice()}} zł</span></td>
                                    <td class="text-end">
                                        <div class="drodown">
                                            <a data-bs-toggle="dropdown" href="#" class="btn p-1" aria-expanded="false">
                                                <i class="fas fa-bars" aria-hidden= "true"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <a class="dropdown-item justify-content-between">
                                                    <i class="fas fa-pen"></i>
                                                    <span>Edytuj przedmiot</span>
                                                </a>

                                                <a class="dropdown-item justify-content-between dropdown-red">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Usuń przedmiot</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        {{ $paginator->links('pagination.default') }}
                        <a class="btn btn-primary" href="{{route('edit.add.index')}}">
                            Dodaj przedmiot
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
