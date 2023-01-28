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
                        <a href="/admin/products/" class="me-1"><span class="btn btn-danger">
                                <i class="bi-trash"></i></button></a>
                        <a href="/admin/products/"><span class="btn btn-primary">Back</span></a>
                    </div>
                </div>
            </div>

            <div class="card-body row">

                <div class="col-md-12 col-lg-3">
                    <img id="prod_img_tag" class="img-fluid" src="{{ $product->prod_img_path }}" />
                </div>

                <div class="col-md-12 col-lg-9 mt-1">
                    <div class="row">
                        <div class="col-lg-10 col-md-12">
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

                        <div class="col-lg-2 col-md-12">
                            {!! DNS2D::getBarcodeSVG($product->prod_qr_code, 'QRCODE', 8, 8) !!} --}}
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

                </div>



            </div>
        </div>

        {{-- Product QR Code  && Product Image --}}
        <div class="mb-3 row">
            <div class="col-sm-6 mb-3">
                <label for="qrcode" class="form-label">Product QR Code</label>
                <input type="text" name="id" hidden value="{{ $product->prod_qr_code }}" class="form-control mb-3"
                    id="qrcode" placeholder="Mine Ditse" required>
                {!! DNS2D::getBarcodeHTML($product->prod_qr_code, 'QRCODE', 10, 10) !!}
                <span for="qrcode" class="form-control mt-3">{{ $product->prod_qr_code }}</span>
            </div>
        </div>

        {{-- Product Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Product Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"
                placeholder="Some description about the category">{{ $product->prod_desc }}</textarea>
        </div>

        {{-- Product Unit --}}
        <div class="mb-3">
            <label for="unit" class="form-label">Product Unit</label>
            <select class="form-select" id="unit" name="unit" required aria-label="Default select example">
                <option value="pc" {{ $product->prod_unit = 'pc' ? 'selected' : '' }}> pc </option>
                <option value="box"{{ $product->prod_unit = 'box' ? 'selected' : '' }}> box </option>
            </select>
        </div>

        {{-- Product Price --}}
        <div class="mb-3">
            <label for="price" class="form-label">Product Price</label>
            <input type="number" name="price" step=".01" class="form-control" id="price" placeholder="##.##"
                value="{{ $product->prod_price }}" required>
        </div>

        {{-- Product Other Details --}}
        <div class="mb-3">
            <label for="other" class="form-label">Other Details</label>
            <textarea class="form-control" name="other" id="other" rows="3"
                placeholder="Additional details about the category">{{ $product->prod_other_details }}</textarea>
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
