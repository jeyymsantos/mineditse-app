@extends('layouts.master')

@section('title')
    <title> Add Staff </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/staffs/add" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Add Staff</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Save</button></a>
                    <a href="/admin/staffs/"><span class="btn btn-warning">Cancel</span></a>
                </div>
            </div>


            {{-- First Name --}}
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" maxlength="50" class="form-control" id="first_name"
                    placeholder="First Name" required>
            </div>

            {{-- Last Name --}}
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" maxlength="50" class="form-control" id="last_name"
                    placeholder="Last Name" required>
            </div>

            {{-- Phone Number --}}
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" maxlength="11" minlength="11" class="form-control" id="phone_number"
                    placeholder="Phone Number" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" maxlength="50" class="form-control" id="email"
                    placeholder="Email" required>
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" maxlength="50" minlength="8" class="form-control" id="password"
                    placeholder="Password" required>
            </div>

        </form>

    </div>
@endsection
