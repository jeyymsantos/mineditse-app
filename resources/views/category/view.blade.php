@extends('layouts.master')

@section('title')
    <title> Categories </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
    <div class="container table-responsive">

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
                        <h3 class="m-0 font-weight-bold text-primary">Categories</h3>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end mb-3">
                        <a href="/admin/category/add"><button class="btn btn-primary">Add Category</button></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                    <th class="align-middle"scope="row">{{ $category->category_id }}</th>
                                    <td class="align-middle">{{ $category->category_name }}</td>
                                    <td class="align-middle">
                                        {{ $category->category_description == null ? 'N/A' : $category->category_description }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $category->category_other_details == null ? 'N/A' : $category->category_other_details }}
                                    </td>

                                    <td class="align-middle" style="text-align: center">
                                        <a href="/admin/category/edit/{{ $category->category_id }}"><button
                                                class="btn btn-warning"><i class="bi-pencil"
                                                    title="Edit Category"></i></button></a>
                                        <a href="/admin/category/delete/{{ $category->category_id }}"><button
                                                class="btn btn-danger" title="Delete Category"><i
                                                    class="bi-trash"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
