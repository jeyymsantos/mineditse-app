@extends('layouts.master')

@section('title')
    <title> Bales </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container table-responsive">
    
        <div class="row">
            <div class="col-6">
                <h1> Bales</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="/admin/bales/add"><button class="btn btn-primary">Add Bale</button></a>
            </div>
        </div>

        <table class="table table-striped table-hover" >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Description</th>
                    <th scope="col">Bale Date</th>
                    <th scope="col" style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bales as $bale)
                    <tr>
                        <th class="align-middle" scope="row">  {{ 'B' . $bale->bale_id }} </th>
                        <td class="align-middle">{{ $bale->category_name }}</td>
                        <td class="align-middle">{{ $bale->supplier_name }}</td>
                        <td class="align-middle">₱{{ number_format($bale->bale_price, 2) }}</td>
                        <td class="align-middle">{{ $bale->bale_quantity }}</td>
                        <td class="align-middle">{{ $bale->bale_description == null ? 'N/A' : $bale->bale_description }}</td>
                        <td class="align-middle">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bale->bale_order_date)->format('F d, Y') }}</td>

                        <td class="align-middle" style="text-align: center">
                            <a href="/admin/suppliers/edit/{{ $bale->bale_id }}"><button class="btn btn-warning"><i class="bi-pencil"></i></button></a>
                            <a href="/admin/suppliers/delete/{{ $bale->bale_id }}"><button class="btn btn-danger"><i class="bi-trash"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
