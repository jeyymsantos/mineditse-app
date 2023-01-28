@extends('layouts.master')

@section('title')
    <title> Products </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/products/edit/{{ $product->prod_id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Edit Product</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Update</button></a>
                    <a href="/admin/products/"><span class="btn btn-warning">Cancel</span></a>
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
                <label for="activation" class="form-label">Product Activation</label>
                <button> </button>
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
                <select class="form-select" id="bale" name="bale" required aria-label="Default select example">
                    @if (count($bales) > 0)
                        @foreach ($bales as $bale)
                            <option {{ $product->bale_id == $bale->bale_id ? 'selected' : '' }}
                                value="{{ $bale->bale_id }}">
                                {{ 'B' . $bale->bale_id . ' (' . $bale->category_name . ')' }}</option>
                        @endforeach
                    @else
                        <option value="" disabled selected> NO BALE FOUND </option>
                    @endif
                </select>
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

        </form>

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
