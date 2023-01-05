@extends('layouts.app')

@section('title')
    <title> Suppliers </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
    
        <div class="row">
            <div class="col-6">
                <h1> Suppliers</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="/admin/suppliers/add"><button class="btn btn-primary">Add Supplier</button></a>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Registered Date</th>
                    <th scope="col" style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <th scope="row">{{ $supplier->supplier_id }}</th>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->supplier_address == null ? 'N/A' : $supplier->supplier_address }}</td>
                        <td>{{ $supplier->supplier_phone }}</td>
                        <td>{{ $supplier->supplier_email == null ? 'N/A' : $supplier->supplier_email }}</td>
                        <td>{{ $supplier->supplier_other_details == null ? 'N/A' : $supplier->supplier_other_details }}</td>
                        <td>{{ $supplier->supplier_registered_date }}</td>
                        <td style="text-align: center">
                            <button class="btn btn-warning"><i class="bi-pencil"></i></button>
                            <button class="btn btn-danger"><i class="bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
