@extends('layouts.master')

@section('title')
    <title> Order Invoice </title>
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
        {{-- <form action="" method="" class="row"> --}}
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
                                        <td colspan="2" style="text-align: end" class="text-dark"> Order Total </td>
                                        <td class="font-weight-bold text-dark">
                                            <span id="order_total">₱{{ number_format($total, 2) }}</span>
                                            <input type="hidden" name="order_total" value="{{ $total }}">
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
                                <h3 class="m-0 font-weight-bold text-primary">Generate Order Invoice</h6>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                                <button type="submit" href="/admin/orders/add" class="btn btn-primary me-2">Generate
                                    Invoice</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                            {{-- Customer Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Name</label>
                                <select class="form-select" id="name" name="id" required
                                    aria-label="Default select example">

                                    <option value="false" selected> Select a Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->cust_id }}"> {{ $customer->first_name." ".$customer->last_name }}
                                            ({{ $customer->email }})
                                        </option>
                                    @endforeach


                                </select>
                            </div>

                            {{-- Customer Address --}}
                            <div class="mb-3">
                                <label for="address" class="form-label">Customer Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="Address" readonly required value="Select a customer to generate address">
                            </div>

                            {{-- Payment Method --}}
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-select" id="payment_method" name="payment_method" required
                                    aria-label="Default select example">
                                    <option value="Cash" selected> Cash </option>
                                    <option value="Gcash"> Gcash </option>
                                </select>
                            </div>

                            {{-- Order Method --}}
                            <div class="mb-3">
                                <label for="order_method" class="form-label">Order Method</label>
                                <select class="form-select" id="order_method" name="order_method" required
                                    aria-label="Default select example">
                                    <option value="Pick-Up" selected> Pick-Up </option>
                                    <option value="Delivery"> Delivery </option>
                                    <option value="Meet-Up"> Meet-Up </option>
                                </select>
                            </div>

                            {{-- Product Price --}}
                            <div class="mb-3">
                                <label for="shipping_fee" class="form-label">Shipping Fee</label>
                                <input type="number" name="shipping_fee"
                                    value="0"
                                    class="form-control" id="shipping_fee" placeholder="##.##" required readonly>
                            </div>

                            {{-- Product Remarks --}}
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Additional Remarks</label>
                                <textarea class="form-control" name="remarks" maxlength="255" id="remarks" rows="3"
                                    placeholder="Enter some remarks"></textarea>
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
