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
                <h1> Categories</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="/admin/category/add"><button class="btn btn-primary">Add Category</button></a>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Other Details</th>
                    <th scope="col" style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th  class="align-middle"scope="row">{{ 'C' .$category['category_id'] }}</th>
                        <td class="align-middle">{{ $category['category_name'] }}</td>
                        <td class="align-middle">{{ $category['category_description'] == null ? 'N/A' : $category['category_description'] }}</td>
                        <td class="align-middle">{{ $category['category_other_details'] == null ? 'N/A' : $category['category_description'] }}</td>
                        
                        <td class="align-middle" style="text-align: center">
                            <a href="/admin/category/edit/{{ $category['supplier_id'] }}"><button class="btn btn-warning"><i class="bi-pencil"></i></button></a>
                            <a href="/admin/category/delete/{{ $category['supplier_id'] }}"><button class="btn btn-danger"><i class="bi-trash"></i></button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
