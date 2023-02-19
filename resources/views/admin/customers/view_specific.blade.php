@extends('layouts.master')

@section('title')
    <title> View Customer </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">

        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h3 class="font-weight-bold text-primary"> View Customer</h3>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">

                        <a href="/admin/customers/"><span class="btn btn-primary">Back</span></a>
                    </div>
                </div>
            </div>

            <div class="card-body row">
                <div class="col-md-12 col-lg-9 mt-1">
                    <div class="row">
                        <div class="col-lg-9 col-md-12">
                            <h1 class="font-weight-bold text-primary text-uppercase my-0">
                                {{ $user->first_name . ' ' . $user->last_name }}</h1>

                            @if ($user->cust_type == 'NEW')
                                <h4 class="text-success font-weight-bold"> {{ $user->cust_type }} </h4>
                            @elseif ($user->cust_type == 'SUKI')
                                <h4 class="text-warning font-weight-bold"> {{ $user->cust_type }} </h4>
                            @else
                                <h4 class="text-warning font-weight-bold"> {{ $user->cust_type }} </h4>
                            @endif

                        </div>

                    </div>

                    <div class="row">
                        <p class="text-dark fs-5 my-0 mt-3">Registered Since</p>
                        <p style="text-align: justify">
                            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('F d, Y, h:i A') }}
                        </p>
                    </div>

                    <div class="row">
                        <p class="text-dark fs-5 my-0">Phone Number</p>
                        <p style="text-align: justify">
                            {{ $user->phone_number }}
                        </p>
                    </div>

                    <div class="row">
                        <p class="text-dark fs-5 my-0">Address</p>
                        <p style="text-align: justify">
                            {{ $user->cust_street . ', ' . $user->cust_barangay . ', ' . $user->cust_city . ', ' . $user->cust_province }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 mb-lg-0 h-100">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <h5 class="mb-0 text-primary"><b>Transaction History</b></h5>
                            </li>

                            @if ($orders->count() == 0)
                            <li class="list-group-item d-flex align-items-center p-3">
                                No orders/transactions found.
                            </li>
                            @endif
                            
                            @foreach ($orders as $order)
                                <li class="list-group-item d-flex align-items-center p-3">

                                    @if ($order->payment_status == 'Received')
                                        <a href="/admin/orders/receipt/{{ $order->order_id }}/generate"><button
                                                class="btn btn-outline-primary me-1"><i
                                                    class="fas fa-search fa-sm"></i></button></a>
                                    @else
                                        <a href="/admin/orders/invoice/{{ $order->order_id }}/generate"><button
                                                class="btn btn-outline-primary me-1"><i
                                                    class="fas fa-search fa-sm"></i></button></a>
                                    @endif

                                    <p class="mb-0 ms-2">
                                        ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}
                                        |
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_date)->format('F d, Y') }}
                                        •
                                        <span
                                            class="@if ($order->order_status == 'Cancelled') text-danger
                                            @elseif ($order->order_status == 'Completed') text-success
                                            @else text-warning @endif">
                                            {{ $order->order_status }}
                                        </span>
                                    </p>

                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#prod_img_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#prod_img").change(function() {
            readURL(this);
        });
    </script>
@endsection
