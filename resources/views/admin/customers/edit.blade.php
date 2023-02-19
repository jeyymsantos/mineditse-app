@extends('layouts.master')

@section('title')
    <title> Admin | Edit Customer </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/customers/edit/{{ $user->cust_id }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Edit Customer</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Update</button></a>
                    <a href="/admin/customers/"><span class="btn btn-warning">Cancel</span></a>
                </div>
            </div>

            <div class="mb-3 ">
                <label for="first_name" class="form-label row ms-1">First
                    Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" maxlength="50" required
                    placeholder="First Name" value="{{ $user->first_name }}">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label row ms-1">Last
                    Name</label>
                <input type="text" class="form-control" id="last_name" maxlength="50" required name="last_name"
                    placeholder="Last Name" value="{{ $user->last_name }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label row ms-1">Phone
                    Number</label>
                <input type="text" class="form-control" id="phone" required maxlength="11" name="phone_number"
                    placeholder="Phone Number" value="{{ $user->phone_number }}">
            </div>

            <div class="mb-3">
                <label for="street" class="form-label row ms-1">Street</label>
                <input type="text" class="form-control" id="street" required maxlength="50" name="street"
                    placeholder="Street" value="{{ $user->cust_street }}">
            </div>

            <div class="mb-3">
                <label for="barangay" class="form-label row ms-1">Barangay</label>
                <input type="text" class="form-control" id="barangay" required maxlength="50" name="barangay"
                    placeholder="Barangay" value="{{ $user->cust_barangay }}">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label row ms-1">City</label>
                <input type="text" class="form-control" id="city" required maxlength="50" name="city"
                    placeholder="City" value="{{ $user->cust_city }}">
            </div>

            <div class="mb-3">
                <label for="province" class="form-label row ms-1">Province</label>
                <input type="text" class="form-control" id="province" required maxlength="50" name="province"
                    placeholder="Province" value="{{ $user->cust_province }}">
            </div>

        </form>

    </div>
@endsection
