@extends('layouts.master')

@section('title')
    <title> Suppliers </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/suppliers/add" method="POST">
        @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Add Supplier</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Save</button></a>
                    <a href="/admin/suppliers/"><span class="btn btn-warning">Cancel</span></a>
                </div>
            </div>

            {{-- Supplier Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Supplier Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Uniqlo" required>
            </div>
            
            {{-- Supplier Address --}}
            <div class="mb-3">
                <label for="address" class="form-label">Supplier Address</label>
                <textarea class="form-control" name="address" id="address" rows="2" placeholder="Brgy. Poblacion, Baliwag, Bulacan"></textarea>
            </div>

            {{-- Supplier Phone --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Supplier Phone</label>
                <input class="form-control" name="phone" id="phone" type="text" placeholder="09123456789" maxLength="11" required></input>
            </div>

            {{-- Supplier Other Details --}}
            <div class="mb-3">
                <label for="remarks" class="form-label">Supplier Other Details</label>
                <textarea class="form-control" name="remarks" id="remarks" rows="3" placeholder="Additional Details about the supplier."></textarea>
            </div>

            {{-- Supplier Registered Date --}}
            <div class="mb-3">
                <label for="date" class="form-label">Supplier Registered Date</label>
                <input class="form-control" name="date" id="date" type="date" required></input>
            </div>
        </form>

    </div>
@endsection
