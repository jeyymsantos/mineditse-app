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
                                    <b class="text-primary"> {{ $user->first_name . ' ' . $user->last_name }}</b> |
                                    <i>{{ $user->cust_type }}</i>
                                </h5>
                                <p class="text-muted m-0 mb-2">Customer since
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('F d, Y') }}
                                </p>
                                <div class="d-flex justify-content-center mb-2">

                                    {{-- EDIT PROFILE BUTTON --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        Edit Profile
                                    </button>

                                    <form method="POST" action="/customer/profile/edit">
                                        @csrf
                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="mb-3 ">
                                                                <label for="first_name" class="form-label row ms-1">First
                                                                    Name</label>
                                                                <input type="text" class="form-control" name="first_name"
                                                                    id="first_name" maxlength="50" required
                                                                    placeholder="First Name"
                                                                    value="{{ Auth::user()->first_name }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="last_name" class="form-label row ms-1">Last
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="last_name"
                                                                    maxlength="50" required name="last_name"
                                                                    placeholder="Last Name"
                                                                    value="{{ Auth::user()->last_name }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label row ms-1">Phone
                                                                    Number</label>
                                                                <input type="text" class="form-control" id="phone"
                                                                    required maxlength="11" name="phone_number"
                                                                    placeholder="Phone Number"
                                                                    value="{{ Auth::user()->phone_number }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="street"
                                                                    class="form-label row ms-1">Street</label>
                                                                <input type="text" class="form-control" id="street"
                                                                    required maxlength="50" name="street"
                                                                    placeholder="Street" value="{{ $user->cust_street }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="barangay"
                                                                    class="form-label row ms-1">Barangay</label>
                                                                <input type="text" class="form-control" id="barangay"
                                                                    required maxlength="50" name="barangay"
                                                                    placeholder="Barangay"
                                                                    value="{{ $user->cust_barangay }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="city"
                                                                    class="form-label row ms-1">City</label>
                                                                <input type="text" class="form-control" id="city"
                                                                    required maxlength="50" name="city"
                                                                    placeholder="City" value="{{ $user->cust_city }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="province"
                                                                    class="form-label row ms-1">Province</label>
                                                                <input type="text" class="form-control" id="province"
                                                                    required maxlength="50" name="province"
                                                                    placeholder="Province"
                                                                    value="{{ $user->cust_province }}">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    {{-- DEACTIVATE BUTTON --}}

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-danger ms-1" data-bs-toggle="modal"
                                        data-bs-target="#deactivationModal">
                                        Deactivate
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deactivationModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Account
                                                        Deactivation
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="text-align:justify">Are you sure you want to deactivate? You
                                                        will need to ask for Mine Ditse to reactivate your account once you
                                                        decided to use it again. <br><br>Once you proceed, you will
                                                        automatically be logged out.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <a href="/customer/deactivate"><button type="button"
                                                            class="btn btn-outline-danger">Confirm
                                                            Deactivation</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4 mb-lg-0 h-100">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <h5 class="mb-0 text-primary"><b>Transaction History</b></h5>
                                        </li>

                                        @foreach ($orders as $order)
                                            <li class="list-group-item d-flex align-items-center p-3">

                                                <a href="/customer/orders/invoice/{{ $order->order_id }}/view"><button
                                                        class="btn btn-outline-primary me-1"><i
                                                            class="fas fa-search fa-sm"></i></button></a>

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
