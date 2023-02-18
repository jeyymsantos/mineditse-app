@extends('layouts.master')

@section('title')
    <title> Orders | Receipt ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}</title>
@endsection

@section('custom_css')
@endsection

@section('content')
    <div class="container">
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

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h3 class="m-0 font-weight-bold text-primary">Receipt Details Preview</h6>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">

                                @if ($order->order_status != 'Cancelled')
                                    <a href="/admin/orders/receipts">
                                        <button class="btn btn-secondary me-2">Back</button>
                                    </a>

                                    <a href="/admin/orders/receipt/{{ $order->order_id }}/view" target="_blank">
                                        <button class="btn btn-warning me-2"><i class="bi bi-folder2-open me-2"></i>View
                                            Receipt</button>
                                    </a>

                                    <a href="/admin/orders/receipt/{{ $order->order_id }}/generate">
                                        <button class="btn btn-primary me-2"><i class="bi bi-download me-2"></i>Download
                                            Receipt</button>
                                    </a>
                                @else
                                    <a href="/admin/orders/cancelled">
                                        <button class="btn btn-secondary me-2">Back</button>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if ($order->order_status == 'Cancelled')
                                <p class="fs-2 fw-bold text-danger text-end text-uppercase">{{ $order->order_status }} </p>
                            @else
                                <p class="fs-2 fw-bold text-primary text-end text-uppercase">{{ $order->order_method }} </p>
                            @endif

                        </div>

                        <div class="row mb-3">
                            <p class="m-0 col-md-6"> Transaction ID:
                                <b>ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}</b>
                            </p>
                            <p class="m-0 col-md-6"> Customer Name: <b>{{ $order->first_name." ".$order->last_name }}</b></p>
                            <p class="m-0 col-md-6"> Customer Email: <b>{{ $order->email }}</b></p>
                            <p class="m-0 col-md-6"> Customer Phone: <b>{{ $order->phone_number }}</b></p>
                        </div>

                        <div class="row mb-3">
                            <p class="m-0 col-md-6"> Invoice Date: <b>
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_date)->format('F d, Y, H:ia') }}
                                </b></p>
                            <p class="m-0 col-md-6"> Processed by: <b>{{ $staff->first_name." ".$staff->last_name }}</b></p>
                            <p class="m-0 col-md-6"> Address:
                                <b>{{ $order->cust_street . ', ' . $order->cust_barangay . ', ' . $order->cust_city . ', ' . $order->cust_province }}</b>
                            </p>
                            <p class="m-0 col-md-6"> Payment Method: <b> {{ $order->payment_method }}</b></p>
                        </div>

                        <div class="row mb-3">
                            <p class="m-0 col-md-6"> Payment Date: <b>
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->payment_date)->format('F d, Y, H:ia') }}
                                </b></p>
                            <p class="m-0 col-md-6"> Payment Status: <b class="text-success"> {{ $order->payment_status }}</b></p>
                        </div>

                        <div class="table-responsive">
                            <table id="" class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="align-middle" scope="row">
                                                {{ $i++ }}
                                            </td>
                                            <td class="align-middle">{{ $cart->prod_name }}
                                                <span style="display: none">({{ $cart->prod_qr_code }})</span>
                                            </td>
                                            <td class="align-middle">₱{{ number_format($cart->prod_price, 2) }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: end" class="text-dark"> Order Total </td>
                                        <td class="font-weight-bold text-dark">
                                            <span id="order_total">₱{{ number_format($order->order_total, 2) }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: end" class="text-dark"> Shipping Fee </td>
                                        <td class="font-weight-bold text-dark">
                                            <span
                                                id="order_total">₱{{ number_format($order->order_shipping_fee, 2) }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: end" class="text-dark fs-3"> Grand Total </td>
                                        <td class="font-weight-bold text-dark fs-3">
                                            <span
                                                id="order_total">₱{{ number_format($order->order_shipping_fee + $order->order_total, 2) }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: end" class="text-dark"> Cash </td>
                                        <td class="font-weight-bold text-dark">
                                            <span id="order_total">₱{{ number_format($order->payment_cash, 2) }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: end" class="text-dark"> Change </td>
                                        <td class="font-weight-bold text-dark">
                                            <span
                                                id="order_total">₱{{ number_format($order->payment_cash - $order->order_total, 2) }}</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#exampleModal").modal('show');
            });
        </script>
    @endsection
