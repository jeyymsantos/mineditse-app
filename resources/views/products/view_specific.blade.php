@extends('layouts.master')

@section('title')
    <title> Products </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h3 class="font-weight-bold text-primary"> View Product</h3>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end">
                        <a href="/admin/products/edit/{{ $product->prod_id }}" class="me-1"><span class="btn btn-warning">
                                <i class="bi-pencil text-dark"></i></button></a>

                        <!-- Button trigger modal -->
                        <a class="me-1"><button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                <i class="bi-trash"></i>
                            </button></a>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you
                                            want to
                                            delete product?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        You are about to delete "{{ $product->prod_name }}". Are you sure you
                                        wish
                                        to
                                        proceed?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <a href="/admin/products/delete/{{ $product->prod_id }}"><button
                                                class="btn btn-danger">Delete</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="/admin/products/"><span class="btn btn-primary">Back</span></a>
                    </div>
                </div>
            </div>

            <div class="card-body row">

                <div class="col-lg-3 col-md-12 ">
                    <img id="prod_img_tag" class="img-fluid" src="{{ $product->prod_img_path }}" />
                </div>

                <div class="col-md-12 col-lg-9 mt-1">
                    <div class="row">
                        <div class="col-lg-9 col-md-12">
                            <h1 class="font-weight-bold text-primary text-uppercase my-0">{{ $product->prod_name }}</h1>
                            @if ($product->prod_status == 'Available')
                                <h4 class="text-success font-weight-bold"> {{ $product->prod_status }} </h4>
                            @elseif ($product->prod_status == 'Pending')
                                <h4 class="text-warning font-weight-bold"> {{ $product->prod_status }} </h4>
                            @else
                                <h4 class="text-primary font-weight-bold"> {{ $product->prod_status }} </h4>
                            @endif

                            <h3 class="text-dark mt-3 my-0">
                                {{ 'Bale ' . $product->bale_id . ' - ' . $product->category_name }}
                            </h3>
                            <h1 class="font-weight-bold text-primary">
                                ₱{{ number_format($product->prod_price, 2) . '/' . $product->prod_unit }}</h1>

                        </div>

                        <div class="col-lg-3 col-md-12">
                            {!! DNS2D::getBarcodeHTML($product->prod_qr_code, 'QRCODE', 8, 8) !!}
                        </div>

                    </div>

                    <div class="row">
                        <p class="text-dark fs-5 my-0 mt-3">Product Description</p>
                        @if ($product->prod_desc == '')
                            <p> No available description </p>
                        @else
                            <p style="text-align: justify"> {{ $product->prod_desc }}</p>
                        @endif
                    </div>

                    <div class="row">
                        <p class="text-dark fs-5 my-0 mt-3">Other Details</p>
                        @if ($product->prod_other_details == '')
                            <p> No other details available </p>
                        @else
                            <p style="text-align: justify"> {{ $product->prod_other_details }}</p>
                        @endif
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
