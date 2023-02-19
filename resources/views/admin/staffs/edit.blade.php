@extends('layouts.master')

@section('title')
    <title> Admin | Edit Staff </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/staffs/edit/{{ $user->staff_id }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Edit Staff</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Update</button></a>
                    <a href="/admin/staffs/"><span class="btn btn-warning">Cancel</span></a>
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

           {{-- Hired Date --}}
           <div class="mb-3">
            <label for="date" class="form-label">Hired Date</label>
            <input class="form-control" name="date" id="date" type="date" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->staff_hired_date)->format('Y-m-d') }}" required/>
        </div>

        </form>

    </div>
@endsection
