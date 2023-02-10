@extends('layouts.master')

@section('title')
    <title> Products </title>
@endsection

@section('custom_css')
@endsection

@section('content')
    <div class="container-fluid">
        @if (session()->has('error_title'))
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ session()->get('error_title') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ session()->get('error_msg') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I understand</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('successfull'))
            <div class="row my-2 text-success">
                <h3> {{ session()->get('successfull') }} </h3>
            </div>
        @endif

        <div class="card shadow mb-4 border-left-primary">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h3 class="m-0 font-weight-bold text-primary">View All Products</h6>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end mb-3">
                        <a href="/admin/products/archieve"><button class="btn btn-secondary me-2">Archive</button></a>
                        <a href="/admin/products/add"><button class="btn btn-primary">Add Product</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">QR Code</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Bale</th>
                                <th scope="col">Category</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="text-align: center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="align-middle" scope="row">
                                        {{ $i++ }}
                                    </td>
                                    <td class="align-middle" scope="row">
                                        {!! DNS2D::getBarcodeHTML($product->prod_qr_code, 'QRCODE', 5, 5) !!}
                                        <span style="display: none">({{ $product->prod_qr_code }})</span>
                                    </td>
                                    <td class="align-middle">
                                        {{-- <img src="{{ asset($product->prod_img_path) }}" width="100px" alt=""> --}}
                                        <img src="{{ asset($product->prod_img_path) }}" width="100px">
                                    </td>
                                    <td class="align-middle">{{ $product->prod_name }}</td>
                                    <td class="align-middle">B{{ $product->bale_id }}</td>
                                    <td class="align-middle">{{ $product->category_name }}</td>
                                    <td class="align-middle">{{ $product->supplier_name }}</td>
                                    <td class="align-middle">
                                        ₱{{ number_format($product->prod_price, 2) . '/' . $product->prod_unit }}</td>
                                    <td class="align-middle">

                                        @if ($product->prod_status == 'Pending')
                                            <span class="bg-secondary text-light p-2 px-2 rounded"> Pending </span>
                                        @elseif ($product->prod_status == 'Available')
                                            <span class="bg-success text-light p-2 rounded"> Available </span>
                                        @else
                                            <span class="bg-primary text-light p-2 px-4 rounded"> Sold </span>
                                        @endif
                                    </td>

                                    <td class="align-middle" style="text-align: center">
                                        <a href="/admin/products/view/{{ $product->prod_id }}"><button
                                                class="btn btn-success"><i class="bi-search" title="View Product"></i></button></a>
                                        <a href="/admin/products/edit/{{ $product->prod_id }}"><button
                                                class="btn btn-warning text-dark"><i class="bi-pencil" title="Edit Product"></i></button></a>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $product->prod_id }}" title="Delete Product">
                                            <i class="bi-trash"></i>
                                        </button>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $product->prod_id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you
                                                        want to
                                                        delete product?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    You are about to delete "{{ $product->prod_name }}". Are you sure you
                                                    wish
                                                    to
                                                    proceed?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <a href="/admin/products/delete/{{ $product->prod_id }}"><button
                                                            class="btn btn-danger">Delete</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
