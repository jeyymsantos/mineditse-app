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
                    <th scope="col">Remarks</th>
                    <th scope="col">Registered Date</th>
                    <th scope="col" style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <th class="align-middle" scope="row">{{ 'S' .$supplier->supplier_id }}</th>
                        <td class="align-middle">{{ $supplier['supplier_name'] }}</td>
                        <td class="align-middle">{{ $supplier['supplier_address'] == null ? 'N/A' : $supplier['supplier_address'] }}</td>
                        <td class="align-middle">{{ $supplier['supplier_phone'] }}</td>
                        <td class="align-middle">{{ $supplier['supplier_other_details'] == null ? 'N/A' : $supplier['supplier_other_details'] }}</td>
                        <td class="align-middle">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $supplier['supplier_registered_date'])->format('F d, Y') }}</td>

                        <td class="align-middle" style="text-align: center">
                            <a href="/admin/suppliers/edit/{{ $supplier['supplier_id'] }}"><button class="btn btn-warning"><i class="bi-pencil"></i></button></a>
                            <a href="/admin/suppliers/delete/{{ $supplier['supplier_id'] }}"><button class="btn btn-danger"><i class="bi-trash"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
