@extends('layouts.master')

@section('title')
    <title> View Cart </title>
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


        <form action="/admin/orders/submit" method="POST" class="row">
            @csrf
            @php
                $total = 0;
            @endphp

            <div class="col-md-6">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h3 class="m-0 font-weight-bold text-primary">Generated Orders</h6>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                                <a href="/admin/orders/add" class="btn btn-secondary me-2">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $find = 0;
                                        @endphp
                                        <tr>
                                            <td class="align-middle" scope="row">
                                                {{ $i++ }}
                                            </td>
                                            <td class="align-middle">{{ $cart->prod_name }}
                                                <span style="display: none">({{ $cart->prod_qr_code }})</span>
                                            </td>
                                            <td class="align-middle">
                                                ₱{{ number_format($cart->prod_price, 2) }}</td>
                                            @php
                                                $total += $cart->prod_price;
                                            @endphp

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: end" class="fs-3 text-dark"> Grand Total </td>
                                        <td class="font-weight-bold fs-3  text-dark">
                                            ₱{{ number_format($total, 2) }}
                                            <input type="hidden" name="total" value="{{ $total }}">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h3 class="m-0 font-weight-bold text-primary">Transaction Details</h6>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                                <a href="/admin/orders/add" class="btn btn-success me-2">Place Order</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="/admin/products/add" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Customer Name --}}
                            <div class="mb-3">
                                <label for="unit" class="form-label">Customer Name</label>
                                <select class="form-select" id="unit" name="unit" required
                                    aria-label="Default select example">
                                    <option value="pc" selected> Customer Name </option>
                                    <option value="box"> box </option>
                                </select>
                            </div>

                            {{-- Order Method --}}
                            <div class="mb-3">
                                <label for="order_method" class="form-label">Order Method</label>
                                <select class="form-select" id="unit" name="order_method" required
                                    aria-label="Default select example">
                                    <option value="Pick-Up" selected> Pick-Up </option>
                                    <option value="Delivery"> Delivery </option>
                                    <option value="Meet-Up"> Meet-Up </option>
                                </select>
                            </div>

                            {{-- Payment Method --}}
                            <div class="mb-3">
                                <label for="order_method" class="form-label">Payment Method</label>
                                <select class="form-select" id="unit" name="order_method" required
                                    aria-label="Default select example">
                                    <option value="Pick-Up" selected> Cash </option>
                                    <option value="Delivery"> Gcash/Card </option>

                                </select>
                            </div>

                            {{-- Product Price --}}
                            <div class="mb-3">
                                <label for="price" class="form-label">Shipping Fee</label>
                                <input type="number" name="price" step=".01" class="form-control" id="price"
                                    placeholder="##.##" required>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </form>


    </div>

    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
