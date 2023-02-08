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
                                                <span style="display: none">({{ $cart->prod_qr_code }})</span></td>
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

            <div class="col-6">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h3 class="m-0 font-weight-bold text-primary">Select Customer</h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="display table table-bordered" width="100%" cellspacing="0">
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
                                            <td style="text-align: center">

                                                {{-- Button --}}
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#cartModal{{ $customer->cust_id }}">
                                                    <i class="bi bi-bag-check-fill"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="cartModal{{ $customer->cust_id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you
                                                                    sure
                                                                    you
                                                                    want to
                                                                    checkout?</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p style="text-align: left">You are about to confirm order
                                                                    for
                                                                    {{ $customer->name }}'s
                                                                    cart. Are you sure you wish to proceed?</p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-success"><i
                                                                        class="bi-check-circle-fill"></i>
                                                                    Confirm</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
