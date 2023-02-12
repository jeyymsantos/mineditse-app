@extends('layouts.customer')

@section('title')
    <title> Customer | Profile Page </title>
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
            <div class="container">
                <div class="row my-2 text-success container">
                    <h3> {{ session()->get('successfull') }} </h3>
                </div>
            </div>
        @endif

        <section>
            <div class="container py-5">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ asset('backend/img/undraw_profile.svg') }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="mt-3 mb-1">
                                    <b class="text-primary"> {{ $user->name }}</b> |
                                    <i>{{ $user->cust_type }}</i>
                                </h5>
                                <p class="text-muted m-0 mb-2">Customer since
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('F d, Y') }}
                                </p>
                                <div class="d-flex justify-content-center mb-2">
                                    <button type="button" class="btn btn-primary">Edit Profile</button>
                                    <button type="button" class="btn btn-outline-danger ms-1">Deactivate</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 h-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="mb-0 text-primary"><b>Profile Details</b></h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->name }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->phone_number }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Type</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->cust_type }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                {{ $user->cust_street . ', ' . $user->cust_barangay . ', ' . $user->cust_city . ', ' . $user->cust_province }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-4 mb-lg-0 h-100">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <h5 class="mb-0 text-primary"><b>Latest Transactions</b></h5>
                                        </li>

                                        @foreach ($orders as $order)
                                            <li class="list-group-item d-flex align-items-center p-3">

                                                <button class="btn btn-outline-primary me-1"><i
                                                        class="fas fa-search fa-sm"></i></button>

                                                @if ($order->order_status == 'Cancelled' || $order->order_status == 'Completed')
                                                    <button style="visibility: hidden"
                                                        class="btn btn-outline-success me-2"><i
                                                            class="fas fa-check fa-sm"></i></button>
                                                @else
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-outline-success me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal{{ $order->order_id }}">
                                                        <i class="fas fa-check fa-sm"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="confirmModal{{ $order->order_id }}"
                                                        tabindex="-1" aria-labelledby="confirmModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="confirmModalLabel">
                                                                        Confirm Received Order</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to confirm received status of
                                                                    ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}?
                                                                    This will now place your order as completed
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <a
                                                                        href="/customer/order/confirm/{{ $order->order_id }}"><button
                                                                            type="button"
                                                                            class="btn btn-primary">Confirm</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif


                                                <p class="mb-0">
                                                    ORD-0{{ $order->order_id }}-0{{ $order->cust_id }}
                                                    |
                                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_date)->format('F d, Y') }}
                                                    •
                                                    <span
                                                        class="@if ($order->order_status == 'Cancelled') text-danger
                                                        @elseif ($order->order_status == 'Completed') text-success
                                                        @else text-warning @endif">
                                                        {{ $order->order_status }}
                                                    </span>
                                                </p>

                                            </li>
                                        @endforeach

                                        <li class="list-group-item d-flex justify-content-center align-items-center p-3">
                                            <button class="btn btn-primary"><i class="fas fa-search fa-sm"></i> View All
                                                Transactions</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        </section>
    </div>

    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
