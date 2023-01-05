@extends('layouts.app')

@section('title')
    <title> Bales </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container">
    
        <div class="row">
            <div class="col-6">
                <h1> Bales</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="/admin/bales/add"><button class="btn btn-primary">Add Bale</button></a>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Description</th>
                    <th scope="col">Order Date</th>
                    <th scope="col" style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bales as $bale)
                    <tr>
                        <th scope="row">{{ $bale->bale_id }}</th>
                        <td>{{ $bale['bale_name'] }}</td>
                        <td>{{ $bale['supplier_id'] }}</td>
                        <td>{{ $bale['bale_description'] == null ? 'N/A' : $bale['bale_description'] }}</td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bale['bale_order_date'])->format('F d, Y') }}</td>

                        <td style="text-align: center">
                            <a href="/admin/suppliers/edit/{{ $bale['supplier_id'] }}"><button class="btn btn-warning"><i class="bi-pencil"></i></button></a>
                            <a href="/admin/suppliers/delete/{{ $bale['supplier_id'] }}"><button class="btn btn-danger"><i class="bi-trash"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
