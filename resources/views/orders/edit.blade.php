@extends('layouts.master')

@section('title')
    <title> Update Invoice </title>
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

        <div class="row">

            <div class="col-md-6">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h3 class="m-0 font-weight-bold text-primary">Invoice Details Preview</h6>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                                <a href="/admin/orders/">
                                    <button class="btn btn-secondary me-2">Back</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <p class="fs-2 fw-bold text-primary text-end text-uppercase">{{ $order->order_method }} </p>
                        </div>

                        <div class="row mb-3">
                            <p class="m-0 col-md-6"> Transaction ID:
                                <b>ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}</b>
                            </p>
                            <p class="m-0 col-md-6"> Customer Name: <b>{{ $order->name }}</b></p>
                            <p class="m-0 col-md-6"> Customer Email: <b>{{ $order->email }}</b></p>
                            <p class="m-0 col-md-6"> Customer Phone: <b>{{ $order->phone_number }}</b></p>

                        </div>

                        <div class="row mb-3">
                            <p class="m-0 col-md-6"> Invoice Date: <b>
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_date)->format('F d, Y, H:ia') }}
                                </b></p>
                            <p class="m-0 col-md-6"> Processed by: <b>{{ $staff->name }}</b></p>
                            <p class="m-0 col-md-6"> Address:
                                <b>{{ $order->cust_street . ', ' . $order->cust_barangay . ', ' . $order->cust_city . ', ' . $order->cust_province }}</b>
                            </p>
                            <p class="m-0 col-md-6"> Payment Method: <b> {{ $order->payment_method }}</b></p>
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
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <form action="/admin/orders/submit" method="POST" class="col-md-6">
                {{-- <form action="" method="" class="row"> --}}
                @csrf
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h3 class="m-0 font-weight-bold text-primary">Edit Invoice Methods</h6>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                                <button type="submit" href="/admin/order/update/{{ $order->order_id }}" class="btn btn-primary me-2">Update
                                    </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="/admin/products/add" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Payment Method --}}
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-select" id="payment_method" name="payment_method" required
                                    aria-label="Default select example">
                                    <option value="Cash" {{ $order->payment_method == 'Cash' ? 'Selected' : '' }}> Cash
                                    </option>
                                    <option value="Gcash" {{ $order->payment_method == 'Gcash' ? 'Selected' : '' }}>
                                        Gcash </option>
                                </select>
                            </div>

                            {{-- Order Method --}}
                            <div class="mb-3">
                                <label for="order_method" class="form-label">Order Method</label>
                                <select class="form-select" id="order_method" name="order_method" required
                                    aria-label="Default select example">

                                    @if ($order->order_method == 'Pick-Up')
                                        <option value="Pick-Up" selected> Pick-Up </option>
                                        <option value="Delivery"> Delivery </option>
                                        <option value="Meet-Up"> Meet-Up </option>
                                    @elseif($order->order_method == 'Delivery')
                                        <option value="Pick-Up"> Pick-Up </option>
                                        <option value="Delivery" selected> Delivery </option>
                                        <option value="Meet-Up"> Meet-Up </option>
                                    @else
                                        <option value="Pick-Up"> Pick-Up </option>
                                        <option value="Delivery"> Delivery </option>
                                        <option value="Meet-Up" selected> Meet-Up </option>
                                    @endif


                                </select>
                            </div>

                            {{-- Product Price --}}
                            <div class="mb-3">
                                <label for="shipping_fee" class="form-label">Shipping Fee</label>
                                <input type="number" name="shipping_fee" value="{{ $order->order_shipping_fee }}" class="form-control"
                                    id="shipping_fee" placeholder="##.##" required {{ $order->order_method == "Pick-Up" ? "readonly" : ""}}>
                            </div>

                            {{-- Product Remarks --}}
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Additional Remarks</label>
                                <textarea class="form-control" name="remarks" maxlength="255" id="remarks" rows="3"
                                    placeholder="Enter some remarks">{{ $order->order_details }}</textarea>
                            </div>

                        </form>
                    </div>
                </div>


            </form>
        </div>

    </div>

    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');

            $('#name').change(function() {
                var id = $(this).val();

                $.ajax({
                    url: '/admin/customer/address/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {

                        if (response['data'].length > 0) {
                            var address = response['data'][0].cust_street + ", " +
                                response['data'][0].cust_barangay + ", " +
                                response['data'][0].cust_city + ", " +
                                response['data'][0].cust_province;
                            $("#address").val(address);
                        } else {
                            $("#address").val("Select a customer to generate address");
                        }
                    }
                });

            });

            $('#name').select2();

            $('#order_method').change(function() {
                var method = $(this).val();
                if (method === "Delivery") {
                    $('#shipping_fee').prop('readonly', false);
                    $('#shipping_fee').prop('required', true);
                    $('#shipping_fee').val('');
                } else if (method === "Meet-Up") {
                    $('#shipping_fee').prop('readonly', false);
                    $('#shipping_fee').prop('required', true);
                    $('#shipping_fee').val('');
                } else {
                    $('#shipping_fee').prop('readonly', true);
                    $('#shipping_fee').prop('required', false);
                    $('#shipping_fee').val('0');
                }
            });

        });
    </script>
@endsection
