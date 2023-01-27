@extends('layouts.master')

@section('title')
    <title> Bales </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/products/add" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Add Productdsadas</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Save</button></a>
                    <a href="/admin/products/"><span class="btn btn-warning">Cancel</span></a>
                </div>
            </div>

            <div class="mb-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Product QR Code</label>
                    <input type="text" name="id" disabled value="{{  $unique }}" class="form-control mb-3" id="name" placeholder="Mine Ditse" required>
                    {!! DNS2D::getBarcodeHTML( $unique , 'QRCODE', 5, 5) !!}
                </div>

            </div>

            {{-- Product Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Mine Ditse" required>
            </div>

            {{-- Product Bale --}}
            <div class="mb-3">
                <label for="bale" class="form-label">Product Bale</label>
                <select class="form-select" id="bale" name="bale" required aria-label="Default select example">
                    @if (count($bales) > 0)
                        @foreach ($bales as $bale)
                            <option value="{{ $bale->bale_id }}">
                                {{ 'B' . $bale->bale_id . ' (' . $bale->category_name . ')' }}</option>
                        @endforeach
                    @else
                        <option value="" disabled selected> NO BALE FOUND </option>
                    @endif
                </select>
            </div>

            {{-- Product Image --}}
            <div class="mb-3">
                <label for="formFile" class="form-label">Product Image</label>
                <input class="form-control" name="photo" type="file" accept="image/*" id="formFile">
            </div>

            {{-- Product Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Product Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"
                    placeholder="Some description about the category"></textarea>
            </div>

            {{-- Product Unit --}}
            <div class="mb-3">
                <label for="unit" class="form-label">Product Unit</label>
                <select class="form-select" id="unit" name="unit" required aria-label="Default select example">
                    <option value="pc" selected> pc </option>
                    <option value="pc"> box </option>
                </select>
            </div>

            {{-- Product Price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="number" name="price" step=".01" class="form-control" id="price" placeholder="##.##"
                    required>
            </div>

            {{-- Product Other Details --}}
            <div class="mb-3">
                <label for="other" class="form-label">Other Details</label>
                <textarea class="form-control" name="other" id="other" rows="3"
                    placeholder="Additional details about the category"></textarea>
            </div>

        </form>

    </div>
@endsection
