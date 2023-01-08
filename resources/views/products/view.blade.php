@extends('layouts.master')

@section('title')
    <title> Suppliers </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    @endsection

@section('content')
    <div class="container table-responsive">
    
        <div class="row">
            <div class="col-6">
                <h1> Products </h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="/admin/products/add"><button class="btn btn-primary">Add Product</button></a>
            </div>
        </div>

        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Bale</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Last Updated</th>
                    <th scope="col" style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th class="align-middle" scope="row">{{ 'P' . $product->prod_id }}</th>
                        <td class="align-middle">
                            <img src="{{ asset($product->prod_img_path) }}" width="100px" alt="">
                        </td>
                        <td class="align-middle">{{ $product->prod_name }}</td>
                        <td class="align-middle">B{{ $product->bale_id }}</td>
                        <td class="align-middle">{{ $product->prod_unit }}</td>
                        <td class="align-middle">₱{{ number_format($product->prod_price, 2) }}</td>
                        <td class="align-middle">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->prod_last_updated)->format('F d, Y') }}</td>

                        <td class="align-middle" style="text-align: center">
                            <a href="/admin/suppliers/edit/{{ $product->prod_id }}"><button class="btn btn-warning"><i class="bi-pencil"></i></button></a>
                            <a href="/admin/suppliers/delete/{{ $product->prod_id }}"><button class="btn btn-danger"><i class="bi-trash"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
