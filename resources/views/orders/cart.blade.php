@extends('layouts.master')

@section('title')
    <title> View Cart </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
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

        <div class="card shadow mb-4 border-left-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h3 class="m-0 font-weight-bold text-primary">View Cart Items</h6>
                    </div>

                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                        <a href="/admin/orders/add"><button class="btn btn-secondary me-2">Back</button></a>
                        <a href="/admin/orders/submit"><button class="btn btn-primary">
                                Submit Order
                            </button></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-8 col-sm-12 mb-3 ">
                        <form>
                            <div class="row">
                                <div class="col-lg-4 col-md-10 col-sm-12 mb-2">
                                    <input type="text" class="form-control" name="search" value="{{ $search }}"
                                        placeholder="Search here">
                                </div>
                                <div class="col-lg-6 col-md-2 col-sm-12">
                                    <button class="btn btn-success">Seach</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                @php
                                    $find = 0;
                                @endphp
                                <tr>
                                    <td class="align-middle" scope="row">
                                        {{ $i++ }}
                                    </td>
                                    <td class="align-middle" scope="row">
                                        {{ $customer->name }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $customer->email }}
                                    </td>
                                    <td class="align-middle">{{ $customer->cust_type }}</td>
                                    <td class="align-middle"></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row mx-3">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 border-left-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h3 class="m-0 font-weight-bold text-primary">Cart Items</h6>
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
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
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

                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" style="text-align: end" class="fs-3 text-dark"> Grand Total </td>
                                <td class="font-weight-bold fs-3  text-dark">
                                    ₱{{ number_format($total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mx-3">
                {{ $carts->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
            ('#dataTable').DataTable();
        });
    </script>
@endsection
