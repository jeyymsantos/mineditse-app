@extends('layouts.master')

@section('title')
    <title> Orders </title>
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
                        <h3 class="m-0 font-weight-bold text-primary">View Order Details</h6>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                        <a href="/admin/orders/"><button class="btn btn-secondary me-2">Back</button></a>
                        <a href="#"><button class="btn btn-primary">Print Order</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <p class="m-0"> Transaction ID: <b>ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}</b></p>
                    <p class="m-0"> Customer Name: <b>{{ $order->name }}</b></p>
                    <p class="m-0"> Customer Email: <b>{{ $order->email }}</b></p>
                </div>

                <hr />

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product QR</th>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Bale (Category)</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="align-middle">{{ $i++ }} </td>
                                    <td class="align-middle">
                                        {!! DNS2D::getBarcodeHTML($order->prod_qr_code, 'QRCODE', 5, 5) !!}
                                        <span style="display: none">({{ $order->prod_qr_code }})</span>
                                    </td>
                                    <td class="align-middle">
                                        <img src="{{ asset($order->prod_img_path) }}" width="100px">
                                    </td>
                                    <td class="align-middle">{{ $order->prod_name }}</td>
                                    <td class="align-middle">
                                        {{ 'B' . $order->bale_id . ' (' . $order->category_name . ')' }}
                                    </td>
                                    <td class="align-middle">
                                        ₱{{ number_format($order->prod_price, 2) }}
                                    </td>
                                    @php
                                        $total += $order->prod_price;
                                    @endphp
                                </tr>
                            @endforeach

                            <tfoot>
                                <td colspan="5" style="text-align: end" class="text-dark"> Change </td>
                                <td class="font-weight-bold text-dark">
                                    ₱{{ number_format(($order->payment_cash-$total), 2) }}
                                    <input type="hidden" name="total" value="">
                                </td>
                            </tfoot>

                            <tfoot>
                                <td colspan="5" style="text-align: end" class="fs-3 text-dark"> Grand Total </td>
                                <td class="font-weight-bold fs-3  text-dark">
                                    ₱{{ number_format($total, 2) }}
                                    <input type="hidden" name="total" value="{{ $total }}">
                                </td>
                            </tfoot>
                            
                            <tfoot>
                                <td colspan="5" style="text-align: end" class="text-dark"> Cash </td>
                                <td class="font-weight-bold text-dark">
                                    ₱{{ number_format($order->payment_cash, 2) }}
                                    {{-- <input type="hidden" name="total" value="{{ $order->order_cash }}"> --}}
                                </td>
                            </tfoot>

                                                      
                            
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
