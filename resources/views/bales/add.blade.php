@extends('layouts.app')

@section('title')
    <title> Bales </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/bales/add" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Add Bale</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Save</button></a>
                    <a href="/admin/bales/"><span class="btn btn-warning">Cancel</span></a>
                </div>
            </div>

            {{-- Bale ID --}}
            <div class="mb-3">
                <label for="id" class="form-label">Bale ID</label>
                <input type="text" name="id" class="form-control" id="id" placeholder="B01, B02, B03" maxlength="3"
                    required>
            </div>

            {{-- Bale Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Bale Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Juan Dela Cruz"
                    required>
            </div>

            {{-- Bale Supplier --}}
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <select class="form-select" id="supplier" name="supplier" required aria-label="Default select example">

                    @if (count($suppliers) > 0)
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier['supplier_id'] }}">
                                {{ $supplier['supplier_id'] . ' : ' . $supplier['supplier_name'] }}</option>
                        @endforeach
                    @else
                        <option value="" disabled selected> NO SUPPLIERS FOUND </option>
                    @endif

                </select>

            </div>

            {{-- Bale Address --}}
            <div class="mb-3">
                <label for="description" class="form-label">Bale Description</label>
                <textarea class="form-control" name="description" id="address" rows="3"
                    placeholder="Something about the bale"></textarea>
            </div>

            {{-- Bale Order Date --}}
            <div class="mb-3">
                <label for="date" class="form-label">Bale Order Date</label>
                <input class="form-control" name="date" id="date" type="date" required></input>
            </div>

        </form>

    </div>
@endsection
