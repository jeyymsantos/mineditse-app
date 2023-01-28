@extends('layouts.master')

@section('title')
    <title> Products </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
            <div class="row">
                <div class="col-6">
                    <h1> View Product</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="/admin/update/{{ $product->prod_id }}" class="me-1"><span class="btn btn-warning">
                        <i class="bi-pencil"></i></button></a>
                    <a href="/admin/products/" class="me-1"><span class="btn btn-danger">
                        <i class="bi-trash"></i></button></a>
                    <a href="/admin/products/"><span class="btn btn-primary">Back</span></a>
                </div>
            </div>

            {{-- Product QR Code  && Product Image --}}
            <div class="mb-3 row">
                <div class="col-sm-6 mb-3">
                    <label for="formFile" class="form-label">Product Image</label>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <img id="prod_img_tag" class="img-responsive" src="{{ $product->prod_img_path }}" width="215px" />
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <input id="prod_img" class="form-control" name="photo" type="file" accept="image/*"
                            id="formFile">
                    </div>
                </div>

                <div class="col-sm-6 mb-3">
                    <label for="qrcode" class="form-label">Product QR Code</label>
                    <input type="text" name="id" hidden value="{{ $product->prod_qr_code }}"
                        class="form-control mb-3" id="qrcode" placeholder="Mine Ditse" required>
                    {!! DNS2D::getBarcodeHTML($product->prod_qr_code, 'QRCODE', 10, 10) !!}
                    <span for="qrcode" class="form-control mt-3">{{ $product->prod_qr_code }}</span>
                </div>
            </div>

            {{-- Product Activation --}}
            <div class="mb-3">
                <label for="activation" class="form-label">Product Activation

                    <span> (Current:       
                        <span class="{{ $product->prod_status == 'Available' ? 'text-success' : 'text-warning'}}">{{$product->prod_status}}</span>)</span>

                </label>
                @if ($product->prod_status == 'Sold')
                    <span for="qrcode" class="form-control bg-primary text-light"> Sold </span>
                @else
                    <select class="form-select" id="activation" name="activation" required
                        aria-label="Default select example">
                        <option value="Available" {{ $product->prod_status == 'Available' ? 'selected' : '' }}> Available
                        </option>
                        <option value="Pending" {{ $product->prod_status == 'Pending' ? 'selected' : '' }}> Pending
                        </option>
                    </select>
                @endif
                </select>
            </div>

            {{-- Product Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Mine Ditse"
                    value="{{ $product->prod_name }}" required>
            </div>

            {{-- Product Bale --}}
            <div class="mb-3">
                <label for="bale" class="form-label">Product Bale</label>
                
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
