@extends('layouts.master')

@section('title')
    <title> Bales </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="/admin/category/add" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1> Add Category</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Save</button></a>
                    <a href="/admin/category/"><span class="btn btn-warning">Cancel</span></a>
                </div>
            </div>

            {{-- Category Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Tshirts, Bags, etc."
                    required>
            </div>

            {{-- Category Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Category Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"
                    placeholder="Some description about the category"></textarea>
            </div>

            {{-- Category Other Details --}}
            <div class="mb-3">
                <label for="other" class="form-label">Other Details</label>
                <textarea class="form-control" name="other" id="other" rows="3"
                    placeholder="Additional details about the category"></textarea>
            </div>

        </form>

    </div>
@endsection
