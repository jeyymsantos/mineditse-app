@extends('layouts.master')

@section('title')
    <title> Customers </title>
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
                        <h3 class="m-0 font-weight-bold text-primary">View Active Customers</h3>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-md-end mb-3">
                        <a href="/admin/customers/archive"><button class="btn btn-primary me-2">Deactivated
                                Accounts</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center">#</th>
                                <th scope="col">Name (Email)</th>
                                <th scope="col">Registered Date</th>
                                <th scope="col" style="text-align: center">Status</th>
                                <th scope="col" style="text-align: center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="align-middle" scope="row" style="text-align: center">
                                        {{ $i++ }}
                                    </td>

                                    <td class="align-middle">
                                        {{ $customer->first_name . ' ' . $customer->last_name . ' (' . $customer->email . ')' }}
                                    </td>
                                    <td class="align-middle">
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $customer->created_at)->format('F d, Y, h:i A') }}
                                    </td>

                                    @if ($customer->cust_type == 'NEW')
                                        <td class="align-middle text-primary fw-bold" style="text-align: center">
                                            {{ $customer->cust_type }}</td>
                                    @elseif ($customer->cust_type == 'SUKI')
                                        <td class="align-middle text-secondary fw-bold" style="text-align: center">
                                            {{ $customer->cust_type }}</td>
                                    @else
                                        <td class="align-middle text-warning fw-bold" style="text-align: center">
                                            {{ $customer->cust_type }}</td>
                                    @endif


                                    <td class="align-middle" style="text-align: center">
                                        <a href="/admin/customers/view/{{ $customer->cust_id }}"><button
                                                class="btn btn-success"><i class="bi-search"
                                                    title="View Customer"></i></button></a>
                                        <a href="/admin/customers/edit/{{ $customer->cust_id }}"><button
                                                class="btn btn-warning text-dark"><i class="bi-pencil"
                                                    title="Edit Customer"></i></button></a>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $customer->cust_id }}" title="Deactivate Customer">
                                            <i class="bi-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $customer->cust_id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you
                                                            want to
                                                            deactivate customer?</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: justify">
                                                        You are about to deactivate "{{ $customer->first_name." ".$customer->last_name }}". Are you sure
                                                        you
                                                        wish
                                                        to
                                                        proceed?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <a href="/admin/customers/deactivate/{{ $customer->cust_id }}"><button
                                                                class="btn btn-danger">Deactivate</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

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
