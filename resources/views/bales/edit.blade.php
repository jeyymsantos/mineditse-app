@extends('layouts.master')

@section('title')
    <title> Edit Bale </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/bales/edit/{{ $bale['bale_id'] }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Edit Bale</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Update</button></a>
                    <a href="/admin/bales/"><span class="btn btn-warning">Cancel</span></a>
                </div>
            </div>

            {{-- Bale ID --}}
            <div class="mb-3">
                <label for="id" class="form-label">Bale ID</label>
                <input type="text" name="id" class="form-control" id="id" value="{{ $bale['bale_id'] }}" maxlength="3"
                    disabled>
            </div>

             {{-- Bale Category --}}
             <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required aria-label="Default select example">
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <option value="{{ $category['category_id'] }}" {{ $category['category_id'] == $bale['category_id'] ? 'selected' : '' }}>
                                {{ $category['category_name'] }}
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled selected> NO CATEGORY FOUND </option>
                    @endif
                </select>
            </div>

            {{-- Bale Supplier --}}
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <select class="form-select" id="supplier" name="supplier" required aria-label="Default select example">
                    @if (count($suppliers) > 0)
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier['supplier_id'] }}" {{ $supplier['supplier_id'] == $bale['supplier_id'] ? 'selected' : '' }}>
                                {{ $supplier['supplier_name'] }}</option>
                        @endforeach
                    @else
                        <option value="" disabled selected> NO SUPPLIER FOUND </option>
                    @endif
                </select>
            </div>

            {{-- Bale Price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Bale Price</label>
                <input type="number" name="price" step=".01" class="form-control" id="price" placeholder="##.##" required value="{{ $bale['bale_price'] }}">
            </div>

            {{-- Bale Quantity --}}
            <div class="mb-3">
                <label for="quantity" class="form-label">Bale Quantity</label>
                <input type="number" name="quantity" class="form-control" id="quantity" placeholder="#" required value="{{ $bale['bale_quantity'] }}">
            </div>

            {{-- Bale Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Bale Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"
                    placeholder="Something about the bale">{{ $bale['bale_description'] }}</textarea>
            </div>

            {{-- Bale Order Date --}}
            <div class="mb-3">
                <label for="date" class="form-label">Bale Order Date</label>
                <input class="form-control" name="date" id="date" type="date" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bale['bale_order_date'])->format('Y-m-d') }}" required/>
            </div>

        </form>

    </div>
@endsection
