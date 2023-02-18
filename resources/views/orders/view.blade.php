@extends('layouts.master')

@section('title')
    <title> Order Invoices | Pending </title>
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

        <div class="card shadow mb-4 border-left-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h3 class="m-0 font-weight-bold text-primary">View Order Invoices</h6>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                        <a href="/admin/orders/add"><button class="btn btn-primary">Add Invoice</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Order Total</th>
                                <th scope="col">Order Method</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Order Status</th>
                                <th scope="col" style="text-align: center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $i++ }} </td>
                                    <td class="text-center"> ORD-0{{ $order->order_id }}-0{{ $order->cust_id }} </td>
                                    <td class="text-center">{{ $order->first_name." ".$order->last_name }}</td>
                                    <td class="text-center">
                                        ₱{{ number_format($order->order_total + $order->order_shipping_fee, 2) }}</td>

                                    <td class="text-center">{{ $order->order_method }}</td>
                                    <td class="text-center">{{ $order->payment_method }}</td>

                                    {{-- Payment Status --}}
                                    @if ($order->payment_status == 'Received')
                                        <td class="text-center text-success fw-bold">{{ $order->payment_status }}</td>
                                    @else
                                        <td class="text-center text-danger fw-bold">{{ $order->payment_status }}</td>
                                    @endif

                                    {{-- Order Status --}}
                                    @if ($order->order_status == 'Completed')
                                        <td class="text-center text-success fw-bold">{{ $order->order_status }}</td>
                                    @elseif($order->order_status == 'In-Transit')
                                        <td class="text-center text-primary fw-bold">{{ $order->order_status }}</td>
                                    @else
                                        <td class="text-center text-warning fw-bold">{{ $order->order_status }}</td>
                                    @endif


                                    <td class="align-middle" style="text-align: center">

                                        @if ($order->order_status == 'Completed')
                                            <a href="/admin/orders/receipt/{{ $order->order_id }}"
                                                style="text-decoration: none;">
                                                <button class="btn btn-primary">
                                                    <i class="bi-search"></i>
                                                </button>
                                            </a>
                                        @else
                                            @if ($order->payment_status != 'Received')
                                                <a href="/admin/orders/invoice/{{ $order->order_id }}"
                                                    style="text-decoration: none;">
                                                    <button class="btn btn-primary">
                                                        <i class="bi-search"></i>
                                                    </button>
                                                </a>

                                                <a href="/admin/orders/payment/{{ $order->order_id }}"
                                                    style="text-decoration: none;">
                                                    <button class="btn btn-success text-dark"><i class="bi-cash"></i></button>
                                                </a>
                                            @else
                                                <a href="/admin/orders/receipt/{{ $order->order_id }}"
                                                    style="text-decoration: none;">
                                                    <button class="btn btn-primary">
                                                        <i class="bi-search"></i>
                                                    </button>
                                                </a>
                                            @endif
                                            <a href="/admin/orders/edit/{{ $order->order_id }}"><button
                                                    class="btn btn-warning text-dark"><i class="bi-pencil"></i></button></a>
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

    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
