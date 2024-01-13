@extends('layouts.app')
@section('content')

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
                        <h5 class="mb-0">Zamówienia</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Produkty</th>
                                <th>Cena</th>
                            </tr>
                            </thead>
                            <tbody id="products">
                            @foreach($orderPaginate as $order)

                                <tr class="align-middle">
                                    <td><span class="d-inline-block align-middle">{{$order->id}}</span></td>
                                    <td><span class="d-inline-block align-middle">{{$order->status}}</span></td>
                                    <td><span class="d-inline-block align-middle">{{$order->created_at}}</span></td>
                                    <td>
                                        <span class="d-inline-block align-middle">{{$order->productsMessage()}}</span>
                                    </td>
                                    <td>
                                        <span class="d-inline-block align-middle">{{$order->productCostSum()}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        {{ $orderPaginate->links('pagination.default') }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
