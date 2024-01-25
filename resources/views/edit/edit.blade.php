@extends('layouts.app')
@push('header')
    @vite('resources/sass/edit.scss')
    <script type="module">
        let modal = new bootstrap.Modal(document.getElementById('confirmModal'))

        function removeProduct(id) {
            $('#formProductId').attr('value', id);
            modal.show();
        }

        window.removeProduct = removeProduct;
    </script>
@endpush
@section('content')

    <div id="confirmModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Potwierdź</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Czy napewno chcesz usunąć ten przedmiot</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">X</button>
                    <form method="post" action="{{route('edit.remove')}}" class="form">
                        @csrf
                        <input id="formProductId" type="hidden" name="id" autocomplete="off" value="">
                        <button type="submit" class="btn btn-primary">Potwierdź</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif
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
                                                <img class="thumbnail me-3 rounded flex-shrink-0"
                                                     src="{{$product->image->url()}}" alt="Product">
                                            @else
                                                <img class="thumbnail me-3 rounded flex-shrink-0"
                                                     src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                                                     alt="Product">
                                            @endif
                                            <div>
                                                <div class="h6 mb-0 lh-1">{{$product->name}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        <span class="d-inline-block align-middle">{{$product->calculatedPrice()}} zł</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="d-inline-block align-middle">
                                            <a href="{{route('edit.update.index', $product->id)}}"
                                               class="btn btn-primary justify-content-between me-2">
                                                <i class="fas fa-pen"></i>
{{--                                                <span> Edytuj przedmiot</span>--}}
                                            </a>
                                            <button onclick="removeProduct('{{$product->id}}')"
                                                    class="btn btn-danger justify-content-between">
                                                <i class="fas fa-trash"></i>
{{--                                                <span> Usuń przedmiot</span>--}}
                                            </button>
                                        </span>
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
