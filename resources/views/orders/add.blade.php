@extends('layouts.master')

@section('title')
    <title> Add Order </title>
@endsection

@section('custom_css')
@endsection

@section('content')
    <div class="container-fluid">
        @if (session()->has('error_title'))
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ session()->get('error_title') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ session()->get('error_msg') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I understand</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('successfull'))
            <div class="row my-2 text-success">
                <h3> {{ session()->get('successfull') }} </h3>
            </div>
        @endif

        <!-- Modal for Cart -->
        <div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="submitModalLabel">View Cart</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">QR Code</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $find = 0;
                                        @endphp
                                        <tr>
                                            <td class="align-middle" scope="row">
                                                {{ $i++ }}
                                            </td>
                                            <td class="align-middle" scope="row">
                                                {!! DNS2D::getBarcodeHTML($cart->prod_qr_code, 'QRCODE', 5, 5) !!}
                                            </td>
                                            <td class="align-middle">
                                                {{-- <img src="{{ asset($product->prod_img_path) }}" width="100px" alt=""> --}}
                                                <img src="{{ asset($cart->prod_img_path) }}" width="100px">
                                            </td>
                                            <td class="align-middle">{{ $cart->prod_name }}</td>
                                            <td class="align-middle">
                                                ₱{{ number_format($cart->prod_price, 2) }}</td>
                                            @php
                                                $total += $cart->prod_price;
                                            @endphp

                                            <td class="align-middle" style="text-align: center">
                                                @foreach ($products as $product)
                                                    @if ($cart->prod_qr_code == $product->prod_qr_code)
                                                        @php
                                                            $find = 1;
                                                        @endphp
                                                    @endif
                                                @endforeach

                                                @if ($find == 1)
                                                    {{-- Button --}}
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $cart->prod_id }}">
                                                        <i class="bi-trash"></i>
                                                    </button>
                                                @else
                                                    <a href="/admin/orders/add/{{ $cart->prod_id }}"><button
                                                            class="btn btn-primary"><i class="bi-cart"></i></button></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        @if ($total == 0)
                                            <td colspan="6" style="text-align: center"
                                                class="fs-3 font-weight-bold text-dark"> No Products
                                                Found </td>
                                        @else
                                            <td colspan="4" style="text-align: end" class="fs-3 text-dark"> Grand Total
                                            </td>
                                            <td colspan="2" class="font-weight-bold fs-3  text-dark">
                                                ₱{{ number_format($total, 2) }}</td>
                                        @endif

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        @if ($total != 0)
                            <a href="/admin/orders/cart"><button type="button"
                                    class="btn btn-primary">Checkout</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 border-left-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12 ">
                        <h3 class="m-0 font-weight-bold text-primary">Add Order Transactions</h6>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                        <a href="/admin/orders/"><button class="btn btn-secondary me-2">Back</button></a>
                        <a><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#submitModal">
                                View Cart ({{ $carts->count() }})
                            </button></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">QR Code</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Bale</th>
                                <th scope="col">Category</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Price</th>
                                <th scope="col" style="text-align: center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                @php
                                    $find = 0;
                                @endphp
                                <tr>
                                    <td class="align-middle" scope="row">
                                        {{ $i++ }}
                                    </td>
                                    <td class="align-middle" scope="row">
                                        {!! DNS2D::getBarcodeHTML($product->prod_qr_code, 'QRCODE', 5, 5) !!}
                                        <span style="display: none">({{ $product->prod_qr_code }})</span>
                                    </td>
                                    <td class="align-middle">
                                        {{-- <img src="{{ asset($product->prod_img_path) }}" width="100px" alt=""> --}}
                                        <img src="{{ asset($product->prod_img_path) }}" width="100px">
                                    </td>
                                    <td class="align-middle">{{ $product->prod_name }}</td>
                                    <td class="align-middle">B{{ $product->bale_id }}</td>
                                    <td class="align-middle">{{ $product->category_name }}</td>
                                    <td class="align-middle">{{ $product->supplier_name }}</td>
                                    <td class="align-middle">
                                        ₱{{ number_format($product->prod_price, 2) . '/' . $product->prod_unit }}</td>

                                    <td class="align-middle" style="text-align: center">
                                        @foreach ($carts as $cart)
                                            @if ($product->prod_qr_code == $cart->prod_qr_code)
                                                @php
                                                    $find = 1;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if ($find == 1)
                                            {{-- Button --}}
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $product->prod_id }}">
                                                <i class="bi-trash"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $product->prod_id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you
                                                                sure
                                                                you
                                                                want to
                                                                remove from cart?</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="text-align: left">You are about to remove
                                                                "{{ $product->prod_name }}" from your
                                                                cart. Are you sure you wish to proceed?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <a href="/admin/orders/remove/{{ $product->prod_id }}"><button
                                                                    class="btn btn-danger"><i class="bi-trash"></i>
                                                                    Confirm</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <a href="/admin/orders/add/{{ $product->prod_id }}"><button
                                                    class="btn btn-primary"><i class="bi-cart"></i></button></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
