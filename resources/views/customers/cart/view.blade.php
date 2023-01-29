@extends('layouts.customer')

@section('title')
    <title> Users Home Page </title>
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

        @php
            $total = 0;
        @endphp

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
                    <table id="" class="display table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">QR Code</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
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
                                            @if ($product->prod_qr_code == $cart->prod_qr_code)
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

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $cart->prod_id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you
                                                                sure
                                                                you
                                                                want to
                                                                remove from cart?</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="text-align: left">You are about to remove
                                                                "{{ $cart->prod_name }}" from your
                                                                cart. Are you sure you wish to proceed?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <a href="/customer/orders/remove/{{ $cart->prod_id }}"><button
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
                        <tfoot>
                            <tr>
                                <td colspan="5" style="text-align: end" class="fs-3 text-dark"> Grand Total </td>
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

    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
